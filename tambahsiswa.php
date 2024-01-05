<?php
require_once("EduconceptClass.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type='text/css' href="tambahsiswa.css">
    <link rel="stylesheet" type='text/css' href="./dist/output.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    </style>
    <title>Tugas</title>
</head>
<body>
    <div id='nav-samping-kiri'>
    <img src="img/Dolomites.jpg" alt="Foto Profil" id='FotoProfilNav'>
        <?php
        $akun = new akun();
        $res_akun = $akun->getProfil("ivano");
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
            <p id='home-admin'>Tambah Siswa</p>
        </div>
    </div>
    <div id='container'>
        <table>
            <tr>
                <td>Nama Siswa</td>
                <td>Email Siswa</td>
            </tr>
            <tr>
                <td><input type="text" id='txtNamaSiswa'></td>
                <td><input type="text" id='txtEmailSiswa'></td>
            </tr>
            <tr>
                <td>Kelas Siswa</td>
                <td>Username</td>
            </tr>
            <tr>
                <td><select name="cboKelas" id="cbKelas">
                    <option value="">Pilih Kelas</option>
                    <?php 
                    $kelas = "%";
                    $daftar = new daftarsiswa();
                    if(isset($_GET['kelas'])){
                        $kelas = $_GET['kelas'];
                    }
                    $res_kelas = $daftar->getKelas("%");
                    while($row=$res_kelas->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['kelas']."</option>";
                    }
                    
                    ?>
                </select></td>
                <td><input type="text" id='txtUsername'></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>Password</td>
            </tr>
            <tr>
                <td><input type="Date" id='tglLahir'></td>
                <td><input type="text" id='tctpassword'></td>
            </tr>
            <tr><td>No HP</td></tr>
            <tr><td><input type="text" id='txtnohp'></td></tr>
            <tr><td>Nama Sekolah</td></tr>
            <tr><td><input type="text" id='txtNamaSekolah'></td>
            <td><button id='btnSimpan'>Simpan</button><button id='btnBatal'>Batal</button></td>
            </tr>
        </table>
        
        
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
            window.location.href="tugas.php?key_kelas="+key_kelas+"&key_matpel="+key_mapel;
            
        });
        $("#btnSimpan").click(function(){
            var namasiswa = $("#txtNamaSiswa").val();
            var emailsiswa = $("#txtEmailSiswa").val();
            var kelas = $("#cbKelas").val();
            var username = $("#txtUsername").val();
            var tgl_lahir = $("#tglLahir").val(); // Mendapatkan nilai dari input tipe tanggal
            var password = $("#tctpassword").val();
            var nama_Sekolah = $("#txtNamaSekolah").val();
            var no_hp = $("#txtnohp").val();
            $.post("insertsiswa-ajax.php", {username: username, kelas_id:kelas, nama:namasiswa, 
            nama_sekolah:nama_Sekolah, email:emailsiswa, no_hp:no_hp, password:password, tgl_lahir:tgl_lahir}).done(function(data){
                if(data == "Tambah Gagal"){
                    alert(data);
                }else{
                    alert(data);
                }
            })
            window.location.href="daftarsiswa.php";
        });
        $("#btnSortir").click(function(){
            var kelas = $("#cbkelas").val();
            var matpel = $("#cbmatpel").val();
            var sesi = $("#cbsesi").val();
            window.location.href="daftarsiswa.php?kelas="+kelas+"&matpel="+matpel+"&sesi="+sesi;
        });
        if (performance.navigation.type === 1) {
        history.replaceState({}, document.title, "tambahsiswa.php");
        }
        $(".btnEdit").click(function(){
            var id = $(this).val();
            $("#table_siswa tr").each(function(){
                var idulang = $(this).find(".btnEdit").val();
                if(id === idulang){
                    alert(idulang)
                    var username = $(this).find(".p_username").html();
                    var nama = $(this).find(".p_nama").html();
                    var kelas = $(this).find(".p_kelas").html();
                    var tanggal_lahir = $(this).find(".p_tanggallahir").html();
                    var sekolah = $(this).find(".p_namasekolah").html();
                    var email = $(this).find(".p_email").html();
                    var nohp = $(this).find(".p_nohp").html();
                    var password = $(this).find(".p_password").html();
                    var kelasid = $(this).find(".p_kelas").attr('value');
                    alert(kelasid);
                    window.location.href="editsiswa.php?username=" +
                    username + "&nama=" + nama + "&kelas=" + kelas +
                    "&tanggal_lahir=" + tanggal_lahir +
                    "&sekolah=" + sekolah + "&email=" + email +
                    "&nohp=" + nohp + "&p=" + password+"&kid="+kelasid;

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