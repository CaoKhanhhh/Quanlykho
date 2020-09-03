<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="img/title.png">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>Login</title>
</head>
<body>
<div class = "container">
    <form class="modal-content animate" action="" method="post">
        @csrf
            <div class="imgcontainer">
                <img src="../img/logoLogin.jpg" alt="Avatar" class="avatar">
            </div>
            @if (session('warning'))
                <div class="text-danger">{{ session('warning') }}</div>
            @endif
            @if (session('message'))
                <div class="text-danger">{{ session('message') }}</div>
            @endif
            @if (session('sucess'))
                <div class="text-danger">{{session('sucess')}}</div>
            @endif
            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <button type="submit">Login</button>
                <div class="forgot_psw">
                    <label>
                        <input type="checkbox" checked="checked" > Remember me
                    </label>
                    <span class="psw">Forgot <a href="{{route('reset_password')}}">password?</a></span>
                </div>
            </div>
    </form>
</div>

</body>
</html>
