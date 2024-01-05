<?php 
$username = $_POST['username'];
$kelas_id = $_POST['kelas_id'];
$nama = $_POST['nama'];
$nama_sekolah = $_POST['nama_sekolah'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$password = $_POST['password'];
$tgl_lahir = $_POST['tgl_lahir'];

$con = new mysqli('localhost', 'root', '', 'educoncept_db');
$stmt = $con->prepare("insert into siswa 
(username, kelas_id, nama, nama_sekolah, email, no_hp, password, tanggal_lahir) 
values (?,?,?,?,?,?,?,?)");
$stmt->bind_param("sissssss", $username, $kelas_id, 
$nama, $nama_sekolah, $email, $no_hp, $password, $tgl_lahir);
$stmt->execute();
if($stmt->affected_rows > 0){
    $response = array('status' => 'success', 'message' => 'Insert berhasil');
}else{
    $response = array('status' => 'error', 'message' => $stmt->error);
}
echo json_encode($response);


?>