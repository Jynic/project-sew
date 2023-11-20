<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type='text/css' href="login.css">
    <link rel="stylesheet" type='text/css' href="./dist/output.css">
    <title>LOGIN</title>
</head>
<body class=''>  
    <div id='container' class=' '>
        <div id='content' class='float-left text-7xl mt-60 ml-40  text-violet-600'>
            <p class=''>Welcome To</p>
            <p>EDUCONCEPT</p>
        </div>

        <div class='flex justify-end'>
        <div id='aside' class=' mr-12 mt-12 text-center bg-violet-600'>
            <img id='logo' class='block ml-auto mr-auto mt-10' src="img/logo-dummy.png" alt="logo-dummy">
            <br>
            <hr id='garis' class='mr-auto ml-auto mt-3 mb-10'>
            <label class=' ' id='txtUser'>Username : <span class ='text-red-700'>*</span>&nbsp &nbsp
            <input type="text" name='txtUsername' placeholder='  Type Your Username'>
            </label>
            <br><br>
            <label class=' ' id='txtPass'>Password : <span class ='text-red-700'>*</span>&nbsp &nbsp
            <input type="text" name='txtPassword' placeholder='  Type Your Password'>
            </label>
            <br>
            <button id='btnSubmit' name='btnSubmit' class='mt-40 w-40 h-14 bg-white rounded-full'>Submit</button>&nbsp &nbsp &nbsp &nbsp
            <button id='btnRegis' name='btnRegis' class='mt-40 w-40 h-14 bg-white rounded-full' onclick="window.location.href='register.php'">Registration</button>
        </div>
        </div>
    </div>
</body>
</html>