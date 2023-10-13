<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use Mpdf\Mpdf;

class PDF_lib
{
    protected $ci;
    protected $mpdf;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->mpdf = new Mpdf();
    }

    public function generate($html, $filename = '', $output = 'stream')
    {
        $this->mpdf->WriteHTML($html);

        if ($output === 'stream') {
            $this->mpdf->Output($filename, 'I');
        } elseif ($output === 'download') {
            $this->mpdf->Output($filename, 'D');
        } elseif ($output === 'save') {
            $this->mpdf->Output($filename, 'S');
        }
    }
}
