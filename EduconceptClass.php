<?php
class Koneksi {
    protected $con;

    public function __construct(){
        $this->con = new mysqli("localhost", "root", "", "educoncept_db");
    }
    public function __destruct(){
        $this->con->close();
    }
}
class jadwal extends Koneksi{
    public function __construct(){
        parent::__construct();
    } 
    public function getJadwal($search='%'){
        $stmt = $this->con->prepare("select j.hari, j.tanggal_waktu, s.waktu_mula, s.waktu_selesai, mp.nama as mata_pelajaran, k.nama as kelas
        from jadwal_bimbel j inner join sesi s on j.sesi_idsesi = s.idsesi 
        inner join mata_pelajaran mp on j.mata_pelajaran_idmata_pelajaran = mp.idmata_pelajaran
        inner join kelas k on j.kelas_id = k.id where j.hari like ?");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    
}
class akun extends Koneksi{
    public function getProfil($username = "ivano"){
        $stmt = $this->con->prepare("select * from tentor where username like ?;");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result == null){
            $stmt2 = $this->con->prepare("select * from siswa where username like ?;");
            $stmt2->bind_param("s", $username);
            $stmt2->execute();
            $result = $stmt2->get_result();
        }
        return $result;
    }
}


?>