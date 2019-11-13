<?php
    use Spipu\Html2Pdf\Html2Pdf;
    use Spipu\Html2Pdf\Exception\Html2PdfException;
    use Spipu\Html2Pdf\Exception\ExceptionFormatter;

    try {
        ob_clean();
        ob_start();        
        error_reporting(E_ALL | E_STRICT);
        $employee = EmployeeController::controllerShowOneEmployeePDF($idEmployeePDF);
        
        include 'pdf_html/contract_employee_start.php';
        
        $content = ob_get_clean();
    
        $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', array(5, 5, 5, 8));
        
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content);
        $html2pdf->output('empleado.pdf', "D");
    } catch (Html2PdfException $e) {
        $html2pdf->clean();
    
        $formatter = new ExceptionFormatter($e);
        echo $formatter->getHtmlMessage();
    }

?>