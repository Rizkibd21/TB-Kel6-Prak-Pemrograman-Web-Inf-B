<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::latest()->get();

        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:subjects',
            'name' => 'required|string',
            'sks' => 'required|integer|min:1',
        ]);

        Subject::create($validated);

        return redirect()->route('admin.subjects.index')->with('success', 'Mata Kuliah berhasil dibuat.');
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:subjects,code,'.$subject->id,
            'name' => 'required|string',
            'sks' => 'required|integer|min:1',
        ]);

        $subject->update($validated);

        return redirect()->route('admin.subjects.index')->with('success', 'Mata Kuliah berhasil diperbarui.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('admin.subjects.index')->with('success', 'Mata Kuliah berhasil dihapus.');
    }
}
