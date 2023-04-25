<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    public function save(Request $request, $id = null)
    {
        $document = Document::getOrNew($id);
        $request->validate([
            'name' => 'required|string',
            'doc' => [$document->exists ? 'nullable' : 'required', 'file', 'mimes:pdf', 'max:5120']
        ]);

        $document->name = $request->name;
        $document->path = $this->uploadDoc($request->file('doc'), $request->name, $document->path);
        $document->save();

        return redirect()->back()->with('success', $document->name . ' successfully saved!');
    }

    public function delete(Document $document)
    {
        $path = $document->path;
        $document->delete();
        if (file_exists(storage_path('app/' . $document->path))) {
            Storage::delete($path);
        }
        return redirect()->back()->with('success', 'File successfully deleted');
    }

    protected function uploadDoc(?UploadedFile $file, $name = '', $default): ?string
    {
        if ($file) {
            $filename = time() . '_' . mb_substr(Str::slug($name), 0, 30) . '.pdf';
            $path = $file->storeAs(Document::BASE_DIR, $filename);
            return $path ? $path : $default;
        }
        return $default;
    }
}
