
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . "/third_party/tcpdf/tcpdf.php";
class PdfHeadeFooter extends tcpdf {
   
    public function Footer() {
        // Position at 20 mm from bottom
        $this->SetY(-20);
        $this->SetFont('helvetica', 'I', 12);

        $footertext = '<p style="font-size: 0.6em;float:left;border-top:1px solid #000;"></p>';

        $this->writeHTMLCell(0, 0, '', '', $footertext, 0, 0, false,true, "L", true);

    }
}