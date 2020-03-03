<?php
    use Spipu\Html2Pdf\Html2Pdf;
    use Spipu\Html2Pdf\Exception\Html2PdfException;
    use Spipu\Html2Pdf\Exception\ExceptionFormatter;

    try {
        ob_clean();
        ob_start();        
        error_reporting(E_ALL | E_STRICT);

        if (!in_array($file, array('inicial', 'renovacion', 'inmediato', 'determinado', 'constancia','finiquito'))) {
            throw new Exception('The mode ['.$file.'] is invalid');
        }

        $employee = EmployeeController::controllerShowOneEmployee($idEmployeePDF);

        if($employee !== false) {
            
            $namePDF = $employee['name_employee'].' '.$employee['first_surname'].' '.$employee['second_surname'];
            include 'pdf_html/styles.php';
            switch ($file) {
                case 'inicial':
                    $typeFile = 'CONTRATO INICIAL';
                    include 'pdf_html/indefinite_contract.php';
                    break;
            }
            
            $content = ob_get_clean();
        
            $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', array(5, 5, 5, 8));
            
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->pdf->SetTitle($typeFile.' - '.$namePDF);
            $html2pdf->writeHTML($content);
            $html2pdf->output($typeFile.' - '.$namePDF.'.pdf');

        } else {
            throw new Html2PdfException('El empleado no existe');
        }
        
    } catch (Html2PdfException $e) {
        $html2pdf->clean();
    
        $formatter = new ExceptionFormatter($e);
        echo $formatter->getHtmlMessage();
    }

?>