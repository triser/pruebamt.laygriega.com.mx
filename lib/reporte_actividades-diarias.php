<?php
require "./fpdf/fpdf.php";
include './class_mysql.php';
include './config.php';

$id = MysqlQuery::RequestGet('id');
$sql = Mysql::consulta("SELECT a.fecha_act,a.hora_act, a.estatus,t.nombre_completo_a,a.descripcion,a.comentario,a.fecha_revi,a.hora_revi
FROM reporte_diario a INNER JOIN cliente c ON a.id_cliente_fk = c.id_cliente INNER JOIN administrador t ON  a.id_admin_fk = t.id_admin WHERE a.id_cliente_fk = a.id_cliente_fk AND a.id_act= '$id'");
$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);


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
$pdf->Cell (0,5,utf8_decode('Reporte de Actividad Diaria'),0,1,'C');

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->Ln();




$pdf->Cell (35,10,'Nombre del Revisor',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['nombre_completo_a']),1,1,'L');
$pdf->Cell (35,10,'Fecha Alta',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['fecha_act']),1,1,'L');
$pdf->Cell (35,10,'Estatus',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['estatus']),1,1,'L');
$pdf->Cell (35,10,'Descripcion',1,0,'C',true);
$pdf->Cell (0,10,($reg['descripcion']),1,1,'L');
$pdf->Cell (35,10,'Comentario',1,0,'C',true);
$pdf->Cell (0,10,($reg['comentario']),1,1,'L');
$pdf->Cell (35,10,'Comentario',1,0,'C',true);


$pdf->Ln();

$pdf->cell(0,5,"Sistema de Orden de Mejora 2018",0,0,'C');

$pdf->output();




