<?php
include '../lib/class_mysql.php';
include '../lib/config.php';

$query =  Mysql::consulta("SELECT email_usuario FROM usuario WHERE email_usuario='".MysqlQuery::RequestGet('id')."'");

if(mysqli_num_rows($query)>0){
    echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
    echo '<label class="control-label" for="inputSuccess2" style="margin-top:10px;";>El Correo Corporativo ya existe, por favor elige otro Correo Corporativo</label>';
}else{
    echo '<span class="glyphicon glyphicon-ok form-control-feedback"></span>';
}
?>
