<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index()
    {
        $years = AcademicYear::latest()->get();

        return view('admin.academic-years.index', compact('years'));
    }

    public function create()
    {
        return view('admin.academic-years.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:20',
            'semester' => 'required|in:Ganjil,Genap',
            'is_active' => 'boolean',
        ]);

        // If setting to active, deactivate others (optional logic, good UX)
        if ($request->has('is_active') && $request->is_active) {
            AcademicYear::where('is_active', true)->update(['is_active' => false]);
        }

        AcademicYear::create($validated);

        return redirect()->route('admin.academic-years.index')->with('success', 'Tahun Akademik berhasil dibuat.');
    }

    public function edit(AcademicYear $academicYear)
    {
        return view('admin.academic-years.edit', compact('academicYear'));
    }

    public function update(Request $request, AcademicYear $academicYear)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:20',
            'semester' => 'required|in:Ganjil,Genap',
            'is_active' => 'boolean',
        ]);

        if ($request->has('is_active') && $request->is_active) {
            AcademicYear::where('id', '!=', $academicYear->id)->update(['is_active' => false]);
        }

        $academicYear->update($validated);

        return redirect()->route('admin.academic-years.index')->with('success', 'Tahun Akademik berhasil diperbarui.');
    }

    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();

        return redirect()->route('admin.academic-years.index')->with('success', 'Tahun Akademik berhasil dihapus.');
    }
}
