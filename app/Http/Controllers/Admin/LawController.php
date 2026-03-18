<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Schema;
=======

use App\Models\Law;
>>>>>>> 34036aaff8a4409a974abde8df238722cec97ddb
use Illuminate\Support\Facades\Storage;

class LawController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $query = Law::query();
        $hasYearColumn = Schema::hasColumn('laws', 'year');
        $hasCategoryColumn = Schema::hasColumn('laws', 'category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('law_number', 'like', "%{$search}%")
                  ->orWhere('content_text', 'like', "%{$search}%");
            });
        }

        if ($hasYearColumn && $request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($hasCategoryColumn && $request->filled('category')) {
            $query->where('category', $request->category);
        }

        $laws = $query->latest()->paginate(10);
        
        $years = $hasYearColumn
            ? Law::select('year')->distinct()->orderBy('year', 'desc')->pluck('year')
            : collect();
        $categories = $hasCategoryColumn
            ? Law::select('category')->distinct()->whereNotNull('category')->pluck('category')
            : collect();

        return view('admin.laws.index', compact('laws', 'years', 'categories'));
=======
        $laws = Law::orderByDesc('created_at')->paginate(15);
        return view('admin.laws.index', compact('laws'));
>>>>>>> 34036aaff8a4409a974abde8df238722cec97ddb
    }

    public function upload(Request $request)
    {
        $request->validate([
            'documents.*' => 'required|file|mimes:pdf,docx,zip|max:20480',
        ]);

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('law-documents', 'public');
                
                Law::create([
                    'title' => $file->getClientOriginalName(),
                    'file_path' => $path,
                ]);
            }
        }

        return back()->with('success', 'Documents uploaded successfully!');
    }

    public function update(Request $request, Law $law)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $law->update([
            'title' => $request->title,
        ]);

        return back()->with('success', 'Document title updated!');
    }

    public function destroy(Law $law)
    {
        // Delete physical file
        if (Storage::disk('public')->exists($law->file_path)) {
            Storage::disk('public')->delete($law->file_path);
        }

        $law->delete();

        return back()->with('success', 'Document deleted successfully!');
    }
}
