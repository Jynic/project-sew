<?php
require_once("EduconceptClass.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type='text/css' href="tugas.css">
    <link rel="stylesheet" href="tugas.css?v=1.0">
    <link rel="stylesheet" type='text/css' href="./dist/output.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <title>Edit Tugas</title>
</head>
<body>
    <div id='nav-samping-kiri'>
    <img src="img/Dolomites.jpg" alt="Foto Profil" id='FotoProfilNav'>
        <?php
        $akun = new akun();
        $res_akun = $akun->getProfil("%");
        while($row = $res_akun->fetch_assoc()){
            $user_db = $row['username'];
            echo "<div id='namaprofil'><p>$user_db</p></div>";
        }
        ?>
        <div class='btnnav'><p>Home</p></div>
        <div class='btnnav click'><p>Tugas</p></div>
        <div class='btnnav'><p>Jadwal</p></div>
        <div class='btnnav'><p>Daftar</p></div>
        <div class='btnnav'><p>Tambah</p></div>
    </div>
    <div id='header'>
        <div>
            <p id='home-admin'>TUGAS SISWA</p>
        </div>
    </div>
    <div id='container'>
        <div id='filter_tugas'>
            <p id='txtKelas'>Kelas</p>
            <select name="kelas_siswa" id="cb_kelas_siswa">
                <option value="%">--Pilih Kelas--</option>
                <?php
                    $key_kelas = "%";
                    $key_matpel = "%";
                    if(isset($_GET['key_kelas'])){
                        $key_kelas = $_GET['key_kelas'];
                    }else{
                        $key_kelas = "%";
                    }
                    if(isset($_GET['key_matpel'])){
                        $key_matpel = $_GET['key_matpel'];
                    }else{
                        $key_matpel = "%";
                    }
                    $tugas = new tugas();
                    
                    $res_kelas = $tugas->getKelas("%");
                    while($row=$res_kelas->fetch_assoc()){
                        echo "<option value='".$row['nama']."' class='cbkelas'>".$row['nama']."</option>";
                    }
                ?>
            </select>
            <br><br>
            <p id='txtMataPelajaran'>Mata Pelajaran</p>
            <select name="matpel_siswa" id="cb_matpel_siswa">
                <option value="%">--Pilih Kelas--</option>
                <?php
                    $tugas = new tugas();
                    $res_kelas = $tugas->getMatpel("%");
                    while($row=$res_kelas->fetch_assoc()){
                        echo "<option value='".$row['nama']."' class='cbmatpel'>".$row['nama']."</option>";
                    }
                ?>
            </select>
            <button id='btnCari'>Cari</button>
            <button id='btnBatal'>Batal</button>
            <button id='btnSimpanTugas'>Simpan</button>
        </div>
        <div id='content_border'>
            <div id='contant_tugas'>
                <table id='table_tugas' border="1" class='scroll'>
                    <thead>
                    <tr>
                    <td>No.</td>
                    <td>Nama</td>
                    <td>Mata Pelajaran</td>
                    <td>Nilai Tugas 1</td>
                    <td>Nilai Tugas 2</td>
                    <td>Nilai Tugas 3</td>
                    <td>Quiz</td>
                    <td>Aksi</td>
                    </tr>
                </thead>
                        <?php
                            $res_tugas = $tugas->getTugas($key_kelas, $key_matpel);
                            while($row=$res_tugas->fetch_assoc()){
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>".$row['idtugas']."</td>";
                                echo "<td><input type='text' name='txtnamasiswa' value='".$row['nama_siswa']."' style=\"width:70px; border:1px solid #042b3f\"></td>";
                                echo "<td><input type='text' name='txtmatapelajaran' value='".$row['mata_pelajaran']."' style=\"width:70px; border:1px solid #042b3f\"></td>";
                                echo "<td><input type='text' name='txttugas1' value='".$row['tugas_1']."' style=\"width:20px; border:1px solid #042b3f\"></td>";
                                echo "<td><input type='text' name='txttugas2' value='".$row['tugas_2']."' style=\"width:20px; border:1px solid #042b3f\"></td>";
                                echo "<td><input type='text' name='txttugas3' value='".$row['tugas_3']."' style=\"width:20px; border:1px solid #042b3f\"></td>";
                                echo "<td>".$row['quiz']."</td>";
                                echo "<td><button id='btnDetailSiswa' style=\"background-color:gray\">Detail Siswa</button>&nbsp &nbsp &nbsp<button id='btnHapus' style=\"background-color:gray\" >Hapus</button></td>";
                                echo "</tr>";
                                echo "</tbody>";
                            }


                        ?>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".btnnav").click(function(){
            $(".btnnav").removeClass("click");
            $(this).addClass("click");
            var nama = $(this).find("p").text();
            var optElement = $(this).find(".opt");
            optElement.remove();
            if(nama == "Daftar" && optElement.length === 0){
                $(this).append("<span class='opt'><p>Daftar Siswa</p></span>");
                $(this).append("<span class='opt'><p>Daftar Tentor</p></span>");
                $(this).append("<span class='opt'><p>Daftar Mata Pelajaran</p></span>");
                $(this).append("<span class='opt'><p>Daftar Kelas</p></span>");
                $(this).append("<span class='opt'><p>Daftar Sesi</p></span>");
            }else{
                optElement.remove();
            }
            if(nama == "Jadwal" && optElement.length === 0){
                $(this).append("<span class='opt'><p>Jadwal Bimbel</p></span>");
                $(this).append("<span class='opt'><p>Jadwal Tentor</p></span>");
            }else{
                optElement.remove();
            }
            if(nama == "Tambah" && optElement.length === 0){
                $(this).append("<span class='opt'><p>Tambah Siswa</p></span>");
                $(this).append("<span class='opt'><p>Tambah Tentor</p></span>");
            }else{
                optElement.remove();
            }
            if(nama == "Tugas"){
                window.location.href = "tugas.php";
            }
            if(nama == "Home"){
                window.location.href = "home.php";
            }
        });
        $("#btnCari").click(function(){
            var key_mapel = $("#cb_matpel_siswa").val();
            var key_kelas = $("#cb_kelas_siswa").val();
            // alert("tugas.php?key_kelas="+key_kelas+"&key_matpel="+key_mapel);
            window.location.href="tugas.php?key_kelas="+key_kelas+"&key_matpel="+key_mapel;
            
        });
    </script>
</body>
</html>