<?php
require_once("EduconceptClass.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type='text/css' href="daftarkelas.css">
    <link rel="stylesheet" type='text/css' href="./dist/output.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <title>Tambah Kelas</title>
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
        <div class='btnnav '><p>Tugas</p></div>
        <div class='btnnav'><p>Jadwal</p></div>
        <div class='btnnav click'><p>Daftar</p></div>
        <div class='btnnav'><p>Tambah</p></div>
    </div>
    <div id='header'>
        <div>
            <p id='home-admin'>Tambah Kelas</p>
        </div>
    </div>
    <div id='container'>
        <div id='content-edit'>
            <table cellspacing=5 id='table-edit'>
                <tr>
                    <td><label class='lbl'>Pilih Kelas</label></td>
                    <td><label class='lbl'>Nama Ruang</label></td>
                </tr>
                <tr>
                    <<td><select name="cboKelas" id="cbKelas">
                    <option value="">Pilih Kelas</option>
                    <?php 
                    $kelas = "%";
                    $daftar = new daftarsiswa();
                    if(isset($_GET['kelas'])){
                        $kelas = $_GET['kelas'];
                    }
                    $res_kelas = $daftar->getKelas("%");
                    while($row=$res_kelas->fetch_assoc()){
                        echo "<option value='".$row['kelas']."'>".$row['kelas']."</option>";
                    }
                    
                    ?>
                </select></td>
                <td><input type="text" id='txtruang' placeholder='Masukan Nama Ruang' class='input'></td>
                </tr>
                <tr>
                    <td>
                        <button id='btnSimpan'>Simpan</button>&nbsp
                        <button id='btnBatal'>Batal</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <script>
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
            $(".opt").click(function(){
            window.location.href="jadwalbimbel.php";
            });
        });
        $("#btnSimpan").click(function(){
            var kelas = $("#cbKelas").val();
            var ruang = $("#txtruang").val();
            $.post("insert-kelas-ajax.php", {kelas: kelas,
            ruang: ruang}).done(function(data){
                if(data == "Input Gagal"){
                    alert(data);
                }else{
                    alert(data);
                    window.location.href="daftarkelas.php";
                }
            })
        });
    </script>
</body>
</html>