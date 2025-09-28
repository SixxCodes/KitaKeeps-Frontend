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

        // === Branch ID logic ===
        $branchId = session('current_branch_id');

        if (!$branchId) {
            $branchId = auth()->user()->branches->sortBy('branch_id')->first()->branch_id ?? null;
            session(['current_branch_id' => $branchId]);
        }

        if (!$branchId) {
            return back()->with('error', 'No active branch selected.');
        }
        // ======================

        // Get all employees for this branch (so we can mark absent if not checked)
        $employees = Employee::where('branch_id', $branchId)->get();

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

        // === Branch ID logic ===
        $branchId = session('current_branch_id');

        if (!$branchId) {
            $branchId = auth()->user()->branches->sortBy('branch_id')->first()->branch_id ?? null;
            session(['current_branch_id' => $branchId]);
        }

        if (!$branchId) {
            return back()->with('error', 'No active branch selected.');
        }
        // ======================

        // Then use $branchId instead of session('current_branch_id')
        $employees = Employee::where('branch_id', $branchId)
            ->with('todayAttendance')
            ->paginate($request->per_page ?? 5);

        return view('attendance.index', compact('employees'));
    }
}
