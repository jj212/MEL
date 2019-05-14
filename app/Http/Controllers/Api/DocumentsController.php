<?php

namespace App\Http\Controllers\Api;

use App\Models\Document;

//use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpWord\TemplateProcessor;
//use RobbieP\CloudConvertLaravel\Facades\CloudConvert;

class DocumentsController extends Controller
{
    public function store(Request $request)
    {
//        $html = $this->generatePdf();
//        die();
        $document = new Document();
        $document->user_id = auth()->id();
        $document->approach = $request->approach['approach'];
        $document->approach_principles = $request->approach['principles'];
        $document->path = $this->generatePdf($request->all());

        if(!$document->save()){
            return response()->json([ 'msg'=>'Document saving failed'], 400);
        }

        return response()->json([ 'msg'=>'Document successfully saved', 'document'=> $document], 201);

    }


    public function generateDocument($data)
    {

        $template = new TemplateProcessor(public_path().'/templates/Final_M_AND_E_Framework-YFBP.docx');
//        $template = new TemplateProcessor(public_path().'/templates/test.docx');

//        $template->setValue('approach', $data['approach']['approach']);
        $template = $this->setApproachData($template, $data['approach']);
        $template->setValue('approach_principles', $data['approach']['principles']);

        $path = 'exports/'.time().'_Final_M_AND_E_Framework-YFBP.docx';

        $template->saveAs(public_path().'/'.$path);

        return $path;
    }

    public function setApproachData(TemplateProcessor $template, $data)
    {
        $template->setValue('approach_title', $data['title']);
        $template->setValue('approach_text', $data['description']);

        $template->cloneBlock('CLONEAPPROACHLEVEL', count($data['levels']));
//        $template->deleteBlock('CLONEAPPROACHLEVEL');

        foreach($data['levels'] as $level) {
            $template->setValue('approach_level', $level['text'], 1);

        }

        return $template;
    }

    public function convertToDocx()
    {
        $pw = new \PhpOffice\PhpWord\PhpWord();

        $html = file_get_contents(public_path().'/templates/test.html');

        /* [THE HTML] */
        $section = $pw->addSection();
//        $html = "<h1>HELLO WORLD!</h1>";
//        $html .= "<p>This is a paragraph of random text</p>";
//        $html .= "<table><tr><td>A table</td><td>Cell</td></tr></table>";
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html, false, false);

        /* [SAVE FILE ON THE SERVER] */
        $pw->save(public_path().'/exports/'."html-to-doc.docx", "Word2007");
    }

    public function generatePdf($data)
    {

//        CloudConvert::file(public_path().'/exports/'.'test.pdf')->to(public_path().'/exports/'.'test00.docx');
//        dd('hello');



        $html = file_get_contents(public_path().'/templates/testhtml.html');
        $html = str_replace('##{approach_text}##',$data['approach']['approach'],$html);
        $html = str_replace('##{approach_principles}##',$data['approach']['principles'],$html);

        $path = 'exports/'.time().'_Final_M_AND_E_Framework-YFBP.pdf';

        PDF::loadHTML($html)->setWarnings(false)->save(public_path().'/'.$path);

       /* $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents(public_path().'/'.$path, $output);*/

        return $path;
    }

}
