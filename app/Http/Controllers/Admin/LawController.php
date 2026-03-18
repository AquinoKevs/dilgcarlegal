<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Law;
use Illuminate\Support\Facades\Storage;

class LawController extends Controller
{
    public function index()
    {
        $laws = Law::orderByDesc('created_at')->paginate(15);
        return view('admin.laws.index', compact('laws'));
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
