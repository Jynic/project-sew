<?php 
$mulai = $_POST['mulai'];
$selesai = $_POST['selesai'];
$nama = $_POST['nama'];

$con = new mysqli('localhost', 'root', '', 'educoncept_db');
$stmt=$con->prepare("insert into sesi (nama, waktu_mula, waktu_selesai) values (?,?,?);");
$stmt->bind_param("sss", $nama, $mulai, $selesai);
$stmt->execute();
if($stmt->affected_rows > 0){
    $response = array('status' => 'success', 'message' => 'Update berhasil');
}else{
    $response = array('status' => 'error', 'message' => $stmt->error);
}
echo json_encode($response);

?>