<?php
require "./fpdf/fpdf.php";
include './class_mysql.php';
include './config.php';

$id = MysqlQuery::RequestGet('id');
$sql = Mysql::consulta("SELECT * FROM ticket WHERE serie= '$id'");
$reg = mysqli_fetch_array($sql, MYSQLI_ASSOC);

class PDF extends FPDF
{
}

$pdf=new PDF('P','mm','Letter');
$pdf->SetMargins(15,20);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetTextColor(0,0,128);
$pdf->SetFillColor(186,223,184);
$pdf->SetDrawColor(0,0,0);
$pdf->SetFont("Arial","b",9);
$pdf->Image('../img/logo.png',40,10,-300);
$pdf->Cell (0,5,utf8_decode('Sitema de Orden de Mejora LA Y GRIEGA'),0,1,'C');
$pdf->Cell (0,5,utf8_decode('Reporte de problema mediante la Orden'),0,1,'C');

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->Cell (0,5,utf8_decode('Información de la Orden con Folio '.utf8_decode($reg['serie'])),0,1,'C');
$pdf->Ln();

$pdf->Cell (35,10,'Fecha de Solicitud',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['fecha']),1,1,'L');
$pdf->Cell (35,10,'Serie',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['serie']),1,1,'L');
$pdf->Cell (35,10,'Estado',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['estado_ticket']),1,1,'L');
$pdf->Cell (35,10,'Nombre',1,0,'C',true);
$pdf->Cell (0,10,($reg['nombre_usuario']),1,1,'L');
$pdf->Cell (35,10,'Email',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['email_cliente']),1,1,'L');
$pdf->Cell (35,10,'Departamento',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['departamento']),1,1,'L');
$pdf->Cell (35,10,'Solicitado A',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['area_solicitada']),1,1,'L');
$pdf->Cell (35,10,'Prioridad',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['Prioridad']),1,1,'L');
$pdf->Cell (35,10,'Asunto',1,0,'C',true);
$pdf->Cell (0,10,($reg['asunto']),1,1,'L');
$pdf->Cell (35,23,'Problema',1,0,'C',true);
$pdf->MultiCell (0,5.5,($reg['mensaje']),1,'L', FALSE);
$pdf->Cell (35,15,'Solucion',1,0,'C',true);
$pdf->Cell (0,15,($reg['solucion']),1,1,'L');
$pdf->Cell (35,10,'Fecha de Entrega',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['fechaE']),1,1,'L');

$pdf->Ln();

$pdf->cell(0,5,"Sistema de Orden de Mejora 2018",0,0,'C');

$pdf->output();