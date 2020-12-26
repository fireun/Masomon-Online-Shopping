
<?php

//pdf.php

require_once '../../dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Pdf extends Dompdf{

 public function __construct(){
  parent::__construct();
 }
}

if(isset($_POST["hidden_html"]) && $_POST["hidden_html"] != '')
{
 $file_name = 'google_chart.pdf';
 $html = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">';
 $html .= $_POST["hidden_html"];

 $pdf = new Pdf();
 $pdf->load_html($html);
 $pdf->render();
 $pdf->stream($file_name, array("Attachment" => false));
}
?>