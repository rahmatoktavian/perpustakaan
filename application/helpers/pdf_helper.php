<?php defined('BASEPATH') OR exit('No direct script access allowed');

function pdf_view($view, $data=array()){
    $ci =& get_instance();
    $html = $ci->load->view($view, $data, TRUE);
   
    require_once APPPATH."third_party/mpdf/vendor/autoload.php";
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->AddPage("P","","","","","15","15","15","15","","","","","","","","","","","","A4");
    $mpdf->WriteHTML($html);
    $mpdf->Output($view.'.pdf', 'D');
}