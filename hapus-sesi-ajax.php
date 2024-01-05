<?php 
$id = $_POST['idsesi'];
$con = new mysqli('localhost', 'root', '', 'educoncept_db');
$stmt = $con->prepare("delete from sesi where idsesi like ?");
$stmt->bind_param("i", $id);
$stmt->execute();
if($stmt->affected_rows > 0){
    $response = array('status' => 'success', 'message' => 'Update berhasil');
}else{
    $response = array('status' => 'error', 'message' => $stmt->error);
}
return json_encode($response);

?>