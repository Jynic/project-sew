<?php
require_once("EduconceptClass.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type='text/css' href="daftartentor.css">
    <link rel="stylesheet" type='text/css' href="./dist/output.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    </style>
    <title>Daftar Tentor</title>
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
            <p id='home-admin'>Daftar Tentor</p>
        </div>
    </div>
    <div id='container'>
        <div id='filter-siswa'>

            <table>
                
                <tr>
                    <td>
                    <label>Mata Pelajaran : </label>
                    </td>
                    <td>
                        <select id='cbmatpel'>
                    <option value="%">Semua Mata Pelajaran</option>
                    <?php 
                        $siswa = new daftarsiswa();
                        $tentor = new daftartentor();
                        $matpel = $_GET['matpel'];;
                        $res_matpel = $siswa->getMatpel("%");
                        while($row=$res_matpel->fetch_assoc()){
                            echo "<option value='".$row['nama']."'>".$row['nama']."</option>";
                        }
                    ?>
                    </select>
                    </td>
                </tr>
            </table>
            <button id='btnSortir'>Sortir</button>
        </div>
        <div id='content-siswa'>
            <table id='table_siswa'>
                <tr>
                    <td>Username</td>
                    <td>Nama</td>
                    <td>Lulusan</td>
                    <td>Email</td>
                    <td>Mata Pelajaran</td>
                    <td>Tanggal Lahir</td>
                </tr>
                
                    <?php 
                        $res_tentor = $tentor->getTentor();
                        if(isset($_GET['matpel'])){
                            $res_tentor = $tentor->getTentorFilter($_GET['matpel']);
                        }
                        $unik = 1;
                        while($row=$res_tentor->fetch_assoc()){
                            echo "<tr>";
                            echo "<td class='p_username'>".$row['username']."</td>";
                            echo "<td class='p_nama'>".$row['nama']."</td>";
                            echo "<td class='p_lulusan' value='".$row['lulusan']."'>".$row['lulusan']."</td>";
                            echo "<td class='p_email'>".$row['email']."</td>";
                            echo "<td class='p_matpel'>".$row['mata_pelajaran']."</td>";
                            echo "<td><button class='btnEdit' value='$unik'>Edit</button>&nbsp &nbsp &nbsp<button class='btnHapus' value='$unik'>Hapus</button></td>";
                            echo "</tr>";
                            $unik +=1;
                        }
                    ?>
                
            </table>
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
            $(".opt").click(function(){
                var vale = $(this).text();
                if(vale == "Daftar Siswa"){
                    window.location.href="daftarsiswa.php";
                }
                if(vale == "Daftar Kelas"){
                    window.location.href="daftarkelas.php";
                }
                if(vale == "Daftar Tentor"){
                    window.location.href="daftartentor.php";
                }
                if(vale=="jadwalbimbel"){
                    window.location.href="jadwalbimbel.php";
                }
            });
        });
        $("#btnEditTugas").click(function(){
            window.location.href="edit_tugas.php";
        });
        $("#btnCari").click(function(){
            var key_mapel = $("#cb_matpel_siswa").val();
            var key_kelas = $("#cb_kelas_siswa").val();
            // alert("tugas.php?key_kelas="+key_kelas+"&key_matpel="+key_mapel);
            window.location.href="daftartentor.php?key_kelas="+key_kelas+"&key_matpel="+key_mapel;
            
        });
        $("#btnSortir").click(function(){

            var matpel = $("#cbmatpel").val();
            window.location.href="daftartentor.php?matpel="+matpel;
        });
        if (performance.navigation.type === 1) {
        history.replaceState({}, document.title, "daftartentor.php");
        }
        $(".btnEdit").click(function(){
            var id = $(this).val();
            $("#table_siswa tr").each(function(){
                var idulang = $(this).find(".btnEdit").val();
                if(id === idulang){
                    alert(idulang)
                    var username = $(this).find(".p_username").html();
                    var nama = $(this).find(".p_nama").html();
                    var kelas = $(this).find(".p_lulusan").html();
                    var tanggal_lahir = $(this).find(".p_email").html();
                    var sekolah = $(this).find(".p_matpel").html();
                    alert(kelas);
                    window.location.href="edittentor.php?username=" +
                    username + "&nama=" + nama + "&lulusan=" + kelas +
                    "&email=" + tanggal_lahir +
                    "&matpel=" + sekolah;

                }
            });
        });
        $(".btnHapus").click(function(){
            var id = $(this).val();
            $("#table_siswa tr").each(function(){
                var idulang = $(this).find(".btnHapus").val();
                if(id === idulang){
                    var username = $(this).find(".p_username").html();
                    alert(username);
                    var confirmres = confirm("Apakah anda yakin menghapus data ini ?");
                    if(confirmres)
                    {
                        $.post("hapus-siswa-ajax.php", {username:username
                        }).done(function(data){
                        alert(data);
                        
                        })
                        window.location.href="daftarsiswa.php";
                    }
                }
            });
        });
    </script>
</body>
</html>