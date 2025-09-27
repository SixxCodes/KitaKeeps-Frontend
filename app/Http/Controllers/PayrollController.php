<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class PayrollController extends Controller
{
    public function paySalary(Employee $employee)
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek   = now()->endOfWeek();

        // Get the total salary for this week
        $attendances = $employee->attendance()
            ->whereBetween('att_date', [$startOfWeek, $endOfWeek])
            ->where('status', 'Present')
            ->get();

        $totalSalary = $attendances->sum('daily_rate');

        // Optionally, save to payroll table
        \App\Models\Payroll::create([
            'employee_id' => $employee->employee_id,
            'period_start' => $startOfWeek,
            'period_end'   => $endOfWeek,
            'gross_pay'    => $totalSalary,
            'deductions'   => 0, // add logic if needed
            'net_pay'      => $totalSalary,
        ]);

        // Delete or reset attendance for this week
        Attendance::where('employee_id', $employee->employee_id)
            ->whereBetween('att_date', [$startOfWeek, $endOfWeek])
            ->delete();

        return back()->with('success', 'Salary has been paid!');
    }
}
