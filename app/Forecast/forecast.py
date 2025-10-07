import os
import pandas as pd
from prophet import Prophet

BASE_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), '..', '..'))  # points to your Laravel root

INPUT_FILE = os.path.join(BASE_DIR, 'storage', 'app', 'forecast_data.xlsx')
OUTPUT_FILE = os.path.join(BASE_DIR, 'storage', 'app', 'forecast_results.xlsx')
SUMMARY_FILE = os.path.join(BASE_DIR, 'storage', 'app', 'forecast_summary.txt')

# Load Excel
df = pd.read_excel(INPUT_FILE)

# Ensure sale_date is datetime
df['sale_date'] = pd.to_datetime(df['sale_date'])

# Make sure branch_name exists in df
if 'branch_name' not in df.columns:
    # Example: you might need to join branch names from another sheet or table
    df['branch_name'] = df['branch_id'].astype(str)  # fallback if missing

# Prepare storage for forecasts and summaries
all_forecasts = []
summary_lines = []

# Map branch_id to branch_name dynamically
branch_names = {row['branch_id']: row['branch_name'] for _, row in df[['branch_id','branch_name']].drop_duplicates().iterrows()}

# Forecast each product per branch
for (branch_id, product_name), group in df.groupby(['branch_id', 'product_name']):
    product_data = group[['sale_date', 'qty_sold']].rename(columns={'sale_date': 'ds', 'qty_sold': 'y'})

    if len(product_data) < 2:
        continue  # Not enough data to forecast

    # Forecast next 7 days using Prophet
    model = Prophet(daily_seasonality=True)
    model.fit(product_data)
    future = model.make_future_dataframe(periods=7)
    forecast = model.predict(future)[['ds', 'yhat']].tail(7)

    # Round forecast to integers, no negative values
    forecast['forecast_qty'] = forecast['yhat'].apply(lambda x: max(int(round(x)), 0))
    forecast['branch_id'] = branch_id
    forecast['branch_product_id'] = group['branch_product_id'].iloc[0]
    forecast['product_name'] = product_name

    all_forecasts.append(forecast[['branch_product_id', 'branch_id', 'product_name', 'ds', 'forecast_qty']])

    # Product-level summary
    total_forecast = forecast['forecast_qty'].sum()
    last_week_sales = product_data['y'].tail(7).sum()
    current_stock = group['stock_qty'].iloc[0]
    trend = "higher than last week" if total_forecast > last_week_sales else "lower than last week"

    summary_lines.append(
        f"This week, {product_name} at {branch_names[branch_id]} is likely to sell {total_forecast} units, which is {trend}. "
        f"Current stock is {current_stock} units. "
        f"{'Consider restocking soon.' if total_forecast > current_stock else 'Stock level seems sufficient.'}"
    )

    # Low-demand warning
    if total_forecast < 20:
        summary_lines.append(
            f"{product_name} at {branch_names[branch_id]} is predicted to have low demand this week ({total_forecast} units). You may reduce procurement accordingly."
        )

# Branch-level summaries
if all_forecasts:
    forecast_df = pd.concat(all_forecasts)
    for branch_id, group in forecast_df.groupby('branch_id'):
        total_branch_forecast = group['forecast_qty'].sum()
        top_product_row = group.sort_values('forecast_qty', ascending=False).iloc[0]
        summary_lines.append(
            f"Overall, {branch_names[branch_id]} is expected to sell {total_branch_forecast} units this week. "
            f"The top-selling product is {top_product_row['product_name']} with {top_product_row['forecast_qty']} units forecasted."
        )

# Save forecast results to Excel
if all_forecasts:
    result_df = pd.concat(all_forecasts)
    result_df.to_excel(OUTPUT_FILE, index=False)
    print(f"Forecast saved to {OUTPUT_FILE}")

# Save summary text
with open(SUMMARY_FILE, 'w') as f:
    for line in summary_lines:
        f.write(line + '\n')

print(f"Summary saved to {SUMMARY_FILE}")
