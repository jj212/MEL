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
        $document = new Document();
        $document->user_id = auth()->id();
        $document->approach = $request->approach['approach'];
        $document->approach_principles = $request->approach['principles'];
        $document->path = $this->convertToWord($request->all());

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

    public function convertToWord($data)
    {

        header("Content-Type: application/vnd.ms-word");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("content-disposition: attachment;filename=Report.docx");

        $html = file_get_contents(public_path().'/templates/final_test.html');

        $html = str_replace('##{approach_text}##',$data['approach']['approach'],$html);
        $html = str_replace('##{approach_principles}##',$data['approach']['principles'],$html);
        $html = str_replace('##{scope_audience_text}##',$data['approach']['scope_audience'],$html);
        $html = str_replace('##{scope_audience_table}##',$this->evaluationAudienceTableHtml($data),$html);

        $html = str_replace('##{ethical_considerations}##',$data['approach']['ethical_considerations'],$html);
        $html = str_replace('##{limitation_text}##',$data['approach']['limitation'],$html);
        $html = str_replace('##{key_evolution_questions}##',$data['approach']['key_evolution_questions'],$html);
        $html = str_replace('##{key_evolution_table}##',$this->keyEvaluationTableHtml($data),$html);

        $html = str_replace('##{operational_steps}##',$data['approach']['operational_steps'],$html);
        $html = str_replace('##{monitoring_improvement}##',$data['approach']['monitoring_improvement'],$html);
        $html = str_replace('##{evaluation_plan_text}##',$data['approach']['evaluation_plan'],$html);
        $html = str_replace('##{reporting_text}##',$data['approach']['reporting'],$html);

        $html = str_replace('##{public_path}##','/var/www/html/sunhill/M_AND_E/public',$html);

        $path = 'exports/'.time().'_Final_M_AND_E_Framework_YFBP.docx';

        $handle = fopen($path, "w+");
        fwrite($handle, $html);
        fclose($handle);

        return $path;
    }

    public function evaluationAudienceTableHtml($data)
    {
        $html = '';
        if(count($data['approach']['scope_audience_tbl'])) {
            foreach($data['approach']['scope_audience_tbl'] as $val) {
                $html .= "<tr>
                          <td width=642 colspan=2 style='width:481.7pt;border:solid #E26E00 1.0pt;
                          border-top:none;padding:0in 5.4pt 0in 5.4pt'>
                          <div style='border:solid #F8DCC0 1.5pt;padding:1.0pt 4.0pt 1.0pt 4.0pt;
                          background:#F8DCC0'>
                          <p class=Tablelightheading style='background:#F8DCC0'><span lang=EN-AU
                          style='font-size:10.0pt'>". $val['name']. "</span></p>
                          </div>
                          </td>
                         </tr>";

                if(count($val['data'])) {
                    foreach ($val['data'] as $item) {
                        $html .= "<tr>
                                      <td width=104 style='width:77.75pt;border-top:none;border-left:solid #F79646 1.0pt;
                                      border-bottom:solid #F79646 1.0pt;border-right:solid #E26E00 1.0pt;
                                      padding:0in 5.4pt 0in 5.4pt'>
                                      <p class=tabletext0 align=right style='text-align:right'><span
                                      style='font-size:9.0pt'>".$item['stakeholder']."</span></p>
                                      </td>
                                      <td width=539 style='width:403.95pt;border-top:none;border-left:none;
                                      border-bottom:solid #E26E00 1.0pt;border-right:solid #E26E00 1.0pt;
                                      padding:0in 5.4pt 0in 5.4pt'>
                                        ". $item['need'] ."
                                      </td>
                                 </tr>";

                    }
                }

            }
        }

        return $html;
    }

    public function keyEvaluationTableHtml($data)
    {
        $html = '';
        if (count($data['approach']['key_evolution_tbl'])) {

            foreach ($data['approach']['key_evolution_tbl'] as $val) {
                $html .= "<tr>
                              <td width=123 valign=top style='width:91.9pt;border:solid #FABF8F 1.0pt;
                              border-top:none;background:#C6E9F6;padding:0in 5.4pt 0in 5.4pt;height:31.95pt'>
                             ".$val['criteria']."
                              </td>
                              <td width=208 valign=top style='width:155.95pt;border-top:none;
                              border-left:none;border-bottom:solid #FABF8F 1.0pt;border-right:solid #FABF8F 1.0pt;
                              background:#C6E9F6;padding:0in 5.4pt 0in 5.4pt;height:31.95pt'>
                              ".$val['question']."
                              </td>
                              <td width=299 valign=top style='width:224.4pt;border-top:none;border-left:
                              none;border-bottom:solid #FABF8F 1.0pt;border-right:solid #FABF8F 1.0pt;
                              background:#C6E9F6;padding:0in 5.4pt 0in 5.4pt;height:31.95pt'>
                                ". $val['subQuestion'] ."
                              </td>
                         </tr>";

            }
        }

        return $html;
    }
}
