<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>Changepassword</title>
</head>
<body>
<div class = "container">
    <form class="modal-content animate" action="" method="post">
        @csrf
        <div class="imgcontainer">
            <img src="../img/logoLogin.jpg" alt="Avatar" class="avatar">
        </div>
        <div class="container">
            <label for="username"><b>New Password</b></label>
            <input type="hidden" name="passwordtoken" value="{{$passwordtoken}}">
            <input type="password" placeholder="Enter new password" name="password" required>
            <button type="submit">Change Password</button>
        </div>
    </form>
</div>

</body>
</html>
