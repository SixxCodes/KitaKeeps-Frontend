<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function mark(Request $request)
    {
        $today = Carbon::today();

        // Get all employees for this branch (so we can mark absent if not checked)
        $employees = Employee::where('branch_id', session('current_branch_id'))->get();

        // IDs of employees marked present
        $presentIds = $request->input('present', []); // array of employee_ids

        foreach ($employees as $employee) {
            Attendance::updateOrCreate(
                [
                    'employee_id' => $employee->employee_id,
                    'att_date'    => $today,
                ],
                [
                    'status' => in_array($employee->employee_id, $presentIds) ? 'Present' : 'Absent',
                ]
            );
        }

        return back()->with('success', 'Attendance has been recorded!');
    }

    public function index(Request $request)
    {
        $today = Carbon::today();

        $employees = Employee::where('branch_id', session('current_branch_id'))
            ->with(['attendance' => function($query) use ($today) {
                $query->where('att_date', $today);
            }])
            ->paginate($request->per_page ?? 5);

        return view('attendance.index', compact('employees'));
    }

    public function pay(Employee $employee)
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