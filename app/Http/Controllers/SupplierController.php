<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\UserBranch;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class SupplierController extends Controller
{
    // Display suppliers list (paginated, branch-aware)
    public function index(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->query('per_page', 5);
        $search = $request->query('search');

        $branchIds = $user->branches->pluck('branch_id');

        $query = Supplier::whereIn('branch_id', $branchIds);

        if ($search) {
            $query->where('supp_name', 'like', "%{$search}%")
                ->orWhere('supp_contact', 'like', "%{$search}%")
                ->orWhere('supp_address', 'like', "%{$search}%");
        }

        $suppliers = $query->paginate($perPage)->withQueryString();

        return view('modules.mySuppliers', compact('suppliers'));
    }

    // Store new supplier
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'supp_name' => 'required|string|max:255',
                'supp_contact' => 'nullable|string|max:20',
                'supp_address' => 'nullable|string|max:255',
                'supp_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);
                
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('supp_image')) {
                $imagePath = $request->file('supp_image')->store('suppliers', 'public');
            }

            $user = Auth::user();

            // Determine branch assignment
            $branchId = ($user->role === 'Owner' && $request->branch_id)
                        ? $request->branch_id       // Owner can select a branch
                        : $user->branches->first()->branch_id; // Admin/Cashier auto assigned

            Supplier::create([
                'supp_name' => $validated['supp_name'],
                'supp_contact' => $validated['supp_contact'] ?? null,
                'supp_address' => $validated['supp_address'] ?? null,
                'supp_image_path' => $imagePath,
                'branch_id' => $branchId,
            ]);

            return redirect()->back()->with('success', 'Supplier added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong, please try again.');
        }
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'supp_name' => 'required|string|max:255',
            'supp_contact' => 'nullable|string|max:20',
            'supp_email' => 'nullable|email|max:255',
            'supp_address' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('supp_image')) {
            $imagePath = $request->file('supp_image')->store('suppliers', 'public');
            $validated['supp_image_path'] = $imagePath;
        }

        $supplier->update($validated);

        return redirect()->back()->with('success', 'Supplier updated successfully!');
    }

    public function destroy(Supplier $supplier)
    {
        try {
            \DB::beginTransaction();

            // Delete related product_supplier records
            if ($supplier->supplierhasManyproduct_supplier()->exists()) {
                $supplier->supplierhasManyproduct_supplier()->delete();
            }

            // Now delete supplier
            $supplier->delete();

            \DB::commit();

            return redirect()->back()->with('success', 'Supplier deleted successfully!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete supplier: ' . $e->getMessage());
        }
    }

    public function exportSuppliers()
    {
        $userId = auth()->user()->user_id;

        // Get all branch IDs for the authenticated user
        $branchIds = UserBranch::where('user_id', $userId)->pluck('branch_id');

        // Get suppliers in those branches
        $suppliers = Supplier::whereIn('branch_id', $branchIds)
            ->with('branch') // eager load branch name
            ->get();

        // Create spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Headers
        $headers = ['ID', 'Supplier Name', 'Contact', 'Address'];
        $sheet->fromArray([$headers], NULL, 'A1');

        // Fill rows
        $row = 2;
        foreach ($suppliers as $supplier) {
            $branchName = optional($supplier->branch)?->branch_name ?? 'N/A';

            $sheet->fromArray([
                $supplier->supplier_id,
                $supplier->supp_name,
                $supplier->supp_contact ?? 'N/A',
                $supplier->supp_address ?? 'N/A',
            ], NULL, "A{$row}");
            $row++;
        }

        // Style headers
        $headerStyle = $sheet->getStyle('A1:D1');
        $headerStyle->getFont()->setBold(true);
        $headerStyle->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $headerStyle->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFE2EFDA');
        $headerStyle->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Auto widen columns
        foreach (range('A', 'D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Optional: widen address column
        $sheet->getColumnDimension('D')->setWidth(40);

        // Writer & download
        $writer = new Xlsx($spreadsheet);
        $filename = 'suppliers.xlsx';

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename);
    }

}
