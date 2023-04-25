<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $docs = Document::search($request->search)->paginate(15)->withQueryString();
        return view('documents', compact('docs'));
    }

    public function show(Document $document)
    {
        dd($document);
    }
}
