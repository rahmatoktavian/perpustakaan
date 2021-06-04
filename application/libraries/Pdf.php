<?php defined('BASEPATH') OR exit('No direct script access allowed');

define('DOMPDF_ENABLE_AUTOLOAD', false);
require_once APPPATH . "/third_party/dompdf_php5/dompdf_config.inc.php";

class Pdf extends Dompdf{

    public function __construct(){
        parent::__construct();
    }

    public function view($view, $data=array()){
        $ci =& get_instance();
        $html = $ci->load->view($view, $data, TRUE);
       
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();

        $filename = $view.'.pdf';
        $dompdf->stream($filename, array("Attachment"=>0));
    }
}