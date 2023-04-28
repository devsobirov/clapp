<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $docs = Document::search($request->search)->paginate(15)->withQueryString();
        return view('documents', compact('docs'));
    }

    public function show(Document $document)
    {
        return view('pdf', compact('document'));
    }

    public function stream(Document $document)
    {
        return response()->make(
            Storage::get($document->path),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $document->name . '"'
            ]
        );
    }
}
