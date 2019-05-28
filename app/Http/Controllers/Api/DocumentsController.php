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
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;


class DocumentsController extends Controller
{
    public function store(Request $request)
    {
        $html = $this->convertToWord();
        die();
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
//        dd($data);

//        CloudConvert::file(public_path().'/exports/'.'test.pdf')->to(public_path().'/exports/'.'test00.docx');
//        dd('hello');



        /*$html = file_get_contents(public_path().'/templates/section2_template.html');
        $html = str_replace('##{approach_text}##',$data['approach']['approach'],$html);
        $html = str_replace('##{approach_principles}##',$data['approach']['principles'],$html);
        $html = str_replace('##{approach_scope_audience}##',$data['approach']['scope_audience'],$html);
        $html = str_replace('##{approach_ethical_considerations}##',$data['approach']['ethical_considerations'],$html);
        $html = str_replace('##{approach_limitations}##',$data['approach']['limitation'],$html);*/

        $path = 'exports/'.time().'_Final_M_AND_E_Framework-YFBP.pdf';

//        PDF::loadHTML($html)->setWarnings(false)->save(public_path().'/'.$path);

        PDF::loadView('templates.section2', ['data'=>$data])->save(public_path().'/'.$path);

       /* $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('DOMPDF_ENABLE_CSS_FLOAT', true);

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents(public_path().'/'.$path, $output);*/

        /*$pdfMerger = PDFMerger::init(); //Initialize the merger

        $pdfMerger->addPDF(public_path('templates/1st_part_copy.pdf'), 'all');
        $pdfMerger->addPDF(public_path().'/'.$path, 'all');

        $pdfMerger->merge(); //For a normal merge (No blank page added)



        $pdfMerger->save(public_path().'/'.$path);

*/
       /* $oMerger = PDFMerger::init();

        $oMerger->addPDF(public_path('templates/1st_part_copy.pdf'), [2]);
        $oMerger->addPDF(public_path().'/'.$path, 'all');

        $oMerger->merge();
        $oMerger->save(public_path().'/'.$path);*/

        

        return $path;
    }

    public function convertToWord()
    {

        header("Content-Type: application/vnd.ms-word");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("content-disposition: attachment;filename=Report.docx");

        $html = file_get_contents(public_path().'/templates/final_test.html');

       /* $handle = fopen(public_path().'/templates/word.docx', "w+");
        fwrite($handle, $html);
        fclose($handle);*/

        echo $html;
    }
}
