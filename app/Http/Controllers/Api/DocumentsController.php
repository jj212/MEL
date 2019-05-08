<?php

namespace App\Http\Controllers\Api;

use App\Models\Document;
use HTMLtoOpenXML\Parser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpWord\TemplateProcessor;

class DocumentsController extends Controller
{
    public function store(Request $request)
    {
        $document = new Document();
        $document->user_id = auth()->id();
        $document->approach = $request->approach['approach'];
        $document->approach_principles = $request->approach['principles'];
        $document->path = $this->generateDocument($request->all());

        if(!$document->save()){
            return response()->json([ 'msg'=>'Document saving failed'], 400);
        }

        return response()->json([ 'msg'=>'Document successfully saved', 'document'=> $document], 201);

    }


    public function generateDocument($data)
    {
        $template = new TemplateProcessor(public_path().'/templates/Final_M_AND_E_Framework-YFBP.docx');
//        $parser = new Parser();
//        $ooXml = $parser->fromHTML($data['approach']['approach']);
        
        $template->setValue('approach', $data['approach']['approach']);
        $template->setValue('approach_principles', $data['approach']['principles']);

        $path = 'exports/'.time().'_Final_M_AND_E_Framework-YFBP.docx';

        $template->saveAs(public_path().'/'.$path);

        return $path;
    }
}
