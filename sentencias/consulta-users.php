<?php
 include '../lib/config2.php'; // MySQL Connection
if (isset($_POST["employee_id"])) {
    $query  = "SELECT * FROM usaurio WHERE idusuario = '" . $_POST["employee_id"] . "'";
    $result = mysqli_query($conn, $query);
    $row    = mysqli_fetch_array($result);
    echo json_encode($row);
}
?>