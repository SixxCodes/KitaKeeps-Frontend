<?php

namespace App\Http\Controllers;

use App\Models\BranchProduct;
use App\Models\Forecast;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForecastController extends Controller
{
    // Export all sales + stock + product + branch info
    public function exportSalesData()
    {
        $user = \App\Models\User::first(); 
        $userBranchIds = $user->branches->pluck('branch_id')->toArray();

        // Fetch branch products, sales, stock
        $salesData = DB::table('branch_product')
            ->join('product', 'branch_product.product_id', '=', 'product.product_id')
            ->leftJoin('sale_item', 'branch_product.branch_product_id', '=', 'sale_item.branch_product_id')
            ->leftJoin('sale', 'sale_item.sale_id', '=', 'sale.sale_id')
            ->whereIn('branch_product.branch_id', $userBranchIds)
            ->select(
                'branch_product.branch_product_id',
                'branch_product.branch_id',
                'branch_product.stock_qty',
                'product.product_name',
                'sale.sale_date',
                DB::raw('COALESCE(sale_item.quantity, 0) as qty_sold')
            )
            ->get();

        // Export to Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray([
            'branch_product_id', 'branch_id', 'product_name', 'sale_date', 'qty_sold', 'stock_qty'
        ], null, 'A1');

        $row = 2;
        foreach ($salesData as $data) {
            $sheet->fromArray([
                $data->branch_product_id,
                $data->branch_id,
                $data->product_name,
                $data->sale_date ? date('Y-m-d', strtotime($data->sale_date)) : null,
                $data->qty_sold,
                $data->stock_qty
            ], null, "A{$row}");
            $row++;
        }

        $filePath = storage_path('app/forecast_data.xlsx');
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        return $filePath;
    }
}
