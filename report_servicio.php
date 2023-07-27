<?php
require_once('tcpdf/tcpdf.php');
require_once('./php/main.php');
date_default_timezone_set('America/Caracas');

$servicio_id = "";

if ( $_SERVER ['REQUEST_METHOD'] == 'GET'){

    if(!isset($_GET["id"])){
        header('location: servicio_lista.php');
        exit;
    }

    $servicio_id = $_GET["id"];

    // ob_end_clean(); //limpiar la memoria
    
    class MYPDF extends TCPDF{
          
            public function Header() {
                $bMargin = $this->getBreakMargin();
                $auto_page_break = $this->AutoPageBreak;
                $this->SetAutoPageBreak(false, 0);
                $img_file = dirname( __FILE__ ) .'/img/logo.png';
                $this->Image($img_file, 10, 5, 70, 40, 'JPG', '', '', false, 30, '', false, false, 0);
                $this->SetAutoPageBreak($auto_page_break, $bMargin);
                $this->setPageMark();
            }
    }

        //Iniciando un nuevo pdf
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, 'mm', 'Letter', true, 'UTF-8', false);
 
        //Establecer margenes del PDF
        $pdf->SetMargins(20, 35, 25);
        $pdf->SetHeaderMargin(20);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(true); //Eliminar la linea superior del PDF por defecto
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); //Activa o desactiva el modo de salto de página automático
 
        //Informacion del PDF
        $pdf->SetAuthor('JOHN DOE');
        $pdf->SetTitle('Reporte de Servicios');

        $factura = rand(999999, 111111);

        //Agregando la primera página
        $pdf->AddPage();
        $pdf->SetFont('courier','B', 15); 
        $pdf->Cell(50,20,'Taller John Doe',0,0,'C');
        $pdf->SetFont('helvetica','B',12); //Tipo de fuente y tamaño de letra
        $pdf->SetXY(100, 20);
        $pdf->Write(0, 'Factura: '.'#'. $factura);
        $pdf->SetXY(100, 25);
        $pdf->Write(0, 'Fecha: '. date('d-m-Y'));
        

        
        
        
        $pdf->Ln(35); //Salto de Linea
        $pdf->Cell(40,26,'',0,0,'C');
        $pdf->SetDrawColor(50, 0, 0, 0);
        $pdf->SetFillColor(0, 0, 0, 0); 
        $pdf->SetTextColor(34,68,136);
        //$pdf->SetTextColor(255,204,0); //Amarillo
        //$pdf->SetTextColor(34,68,136); //Azul
        //$pdf->SetTextColor(153,204,0); //Verde
        //$pdf->SetTextColor(204,0,0); //Marron
        //$pdf->SetTextColor(245,245,205); //Gris claro
        //$pdf->SetTextColor(100, 0, 0); //Color Carne
        $pdf->SetFont('courier','B', 25); 
        $pdf->Cell(100,6,'FACTURA DE SERVICIO',0,0,'C');
        
        
        $pdf->Ln(15);
        $pdf->SetTextColor(0, 0, 0); 
        
        $pdf->SetFillColor(200,232,232);
        $pdf->SetFont('helvetica','B',9); //La B es para letras en Negritas
        $pdf->SetX(2);
        $pdf->Cell(10,7,'#',1,0,'C',1);
        $pdf->Cell(50,7,'Servicio',1,0,'C',1);
        $pdf->Cell(50,7,'Vehículo',1,0,'C',1);
        $pdf->Cell(30,7,'Cliente',1,0,'C',1);
        $pdf->Cell(16,7,'Dni',1,0,'C',1);
        $pdf->Cell(25,7,'Fecha',1,0,'C',1);
        $pdf->Cell(25,7,'Precio',1,0,'C',1);
        
        $pdf->Ln(7); //Salto de Linea
        $pdf->SetFont('helvetica','',9);

        
        
        $sqlOrdenServ = conexion();
        $sqlOrdenServ = $sqlOrdenServ->query("SELECT * FROM servicio INNER JOIN cliente ON servicio.cliente_id = cliente.cliente_id WHERE servicio_id =$servicio_id");
        
        while ($rows = $sqlOrdenServ->fetch()) {
                $pdf->SetX(2);
                $pdf->Cell(10,7,$rows['servicio_id'],1,0,'C',);
                $pdf->Cell(50,7,$rows['servicio_nombre'],1,0,'C');
                $pdf->Cell(50,7,$rows['cliente_marca'] . '-' . $rows['cliente_modelo'],1,0,'C');
                $pdf->Cell(30,7,$rows['cliente_nombre'],1,0,'C');
                $pdf->Cell(16,7,$rows['cliente_dni'],1,0,'C');
                $pdf->Cell(25,7,(date('m-d-Y', strtotime($rows['fecha_orden']))),1,0,'C');
                $pdf->Cell(25,7,$rows['servicio_precio'] .' $',1,0,'C');                
                
            }
}
    $pdf->Output('Reporte_Servcio_#'.$servicio_id. '_' .date('d_M_y').'.pdf', 'I');




?>
