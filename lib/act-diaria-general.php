<?php
require "./fpdf/fpdf.php";
include './class_mysql.php';
include './config.php';


$sql = Mysql::consulta("SELECT * FROM actividad_diaria");

class PDF extends FPDF
{
}
$pdf=new PDF('P','mm','Letter');
$pdf->SetMargins(15,20);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetTextColor(0,0,128);
$pdf->SetFillColor(255,255,255);
$pdf->SetDrawColor(0,0,0);
$pdf->SetFont("Arial","b",9);
$pdf->Image('../img/logo.png',18,10,-300);

date_default_timezone_set('America/Mexico_City');
setlocale(LC_ALL,"es_ES");
$pdf->Cell(160,10,'Fecha:',0,0,"R");
$pdf->Cell(10,10,date('d/m/y H:i a'),0,1,"L");


$pdf->Cell (0,10,utf8_decode('ORDEN DE REVISIÓNES A PUESTOS'),0,1,'C');
$pdf->Cell (0,5,utf8_decode('Distribuidora de Abarrrotes LA Y GRIEGA'),0,1,'C');
$pdf->Ln();
$pdf->Ln();

while($row=mysqli_fetch_array($sql, MYSQLI_ASSOC)){
$pdf->Cell (35,10,'Asignado',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($row['id_cliente_dia']),1,1,'L');
$pdf->Cell (35,10,'Fecha Elaboracion',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($row['fecha_dia']),1,1,'L');
$pdf->Cell (35,10,'Prioridad',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($row['prioridad']),1,1,'L');
$pdf->Cell (35,10,'estatus de Revision',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($row['estatus_revi_dia']),1,1,'L');
$pdf->Cell (35,10,'Fecha de Revision',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($row['fecha_revi_dia']),1,1,'L');
}

$pdf->Ln();
$pdf->Ln();
$pdf->SetTextColor(0,0,128);
$pdf->cell(0,5,"Sistema MTL LA Y GRIEGA 2019",0,0,'C');

$pdf->output();