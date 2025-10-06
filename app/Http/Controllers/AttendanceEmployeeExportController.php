<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use App\Models\Employee;
use App\Models\Attendance;

class AttendanceEmployeeExportController extends Controller
{

    public function export()
    {
        $branchId = session('current_branch_id') 
                    ?? auth()->user()->branches->sortBy('branch_id')->first()->branch_id;

        $employees = Employee::with(['person', 'attendance' => function($q) {
            $q->whereBetween('att_date', [now()->startOfWeek(), now()->endOfWeek()]);
        }])
        ->where('branch_id', $branchId)
        ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // ================= Employees Sheet =================
        $sheet->setTitle('Employees');

        $headers = ['#', 'ID', 'Employee Name', 'Email', 'Username', 'Role'];
        $sheet->fromArray([$headers], null, 'A1');

        $row = 2;
        foreach ($employees as $i => $emp) {
            $sheet->fromArray([
                $i + 1,
                $emp->employee_id,
                $emp->person->firstname . ' ' . $emp->person->lastname,
                $emp->person->email,
                $emp->person->user->username ?? '-',
                $emp->position,
            ], null, "A{$row}");
            $row++;
        }

        // Style headers
        $headerStyle = $sheet->getStyle('A1:F1');
        $headerStyle->getFont()->setBold(true);
        $headerStyle->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $headerStyle->getFill()->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFDBEAFE'); // light blue
        $headerStyle->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // ================= Attendance Sheet =================
        $attendanceSheet = $spreadsheet->createSheet();
        $attendanceSheet->setTitle('Attendance');

        $attendanceHeaders = ['#', 'ID', 'Employee Name', 'Daily Rate', 'Mon','Tue','Wed','Thu','Fri','Sat','Sun','Total Salary'];
        $attendanceSheet->fromArray([$attendanceHeaders], null, 'A1');

        $row = 2;
        foreach ($employees as $i => $emp) {
            $weekDays = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
            $attStatus = [];

            foreach ($weekDays as $dayIndex => $day) {
                $att = $emp->attendance->where('att_date', now()->startOfWeek()->addDays($dayIndex))->first();
                if($att && $att->status === 'Present') $attStatus[] = 'Present';
                elseif($att && $att->status === 'Absent') $attStatus[] = 'Absent';
                else $attStatus[] = '-';
            }

            $totalSalary = $emp->attendance->where('status','Present')->count() * $emp->daily_rate;

            $attendanceSheet->fromArray(array_merge([
                $i + 1,
                $emp->employee_id,
                $emp->person->firstname . ' ' . $emp->person->lastname,
                $emp->daily_rate,
            ], $attStatus, [$totalSalary]), null, "A{$row}");

            $row++;
        }

        $attendanceHeaderStyle = $attendanceSheet->getStyle('A1:L1');
        $attendanceHeaderStyle->getFont()->setBold(true);
        $attendanceHeaderStyle->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $attendanceHeaderStyle->getFill()->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFDBEAFE');
        $attendanceHeaderStyle->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        foreach (range('A','L') as $col) {
            $attendanceSheet->getColumnDimension($col)->setAutoSize(true);
        }

        // ================= Output Excel =================
        $writer = new Xlsx($spreadsheet);
        $filename = 'employees_attendance.xlsx';

        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $filename);
    }


}