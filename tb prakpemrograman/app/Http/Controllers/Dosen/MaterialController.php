<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:pdf,video,link',
            'file' => 'nullable|file|mimes:pdf,mp4|max:20480', // 20MB max
            'link_url' => 'nullable|url|required_if:type,link',
        ]);

        $filePath = null;
        if ($request->hasFile('file') && in_array($request->type, ['pdf', 'video'])) {
            $filePath = $request->file('file')->store('materials', 'public');
        } elseif ($request->type === 'link') {
            $filePath = $request->link_url;
        }

        $course->materials()->create([
            'title' => $request->title,
            'type' => $request->type,
            'file_path' => $filePath,
        ]);

        return back()->with('success', 'Material added successfully.');
    }

    public function destroy(Course $course, Material $material)
    {
        if ($material->course_id !== $course->id) {
            abort(403);
        }

        if ($material->type !== 'link' && $material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();

        return back()->with('success', 'Material deleted successfully.');
    }
}
