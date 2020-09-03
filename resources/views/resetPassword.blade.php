<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>Document</title>
</head>
<body>
<div class = "container">
    <form class="modal-content animate" action="" method="post">
        @csrf
        <div class="imgcontainer">
            <img src="../img/logoLogin.jpg


" alt="Avatar" class="avatar">
        </div>
        @if (session('message'))
            <div class="reset_message">{{session('message')}}</div>
        @endif
        <div class="container">
            <label for="username"><b>Email</b></label>
            <input type="text" placeholder="Enter email" name="email" required>
            <button type="submit">Send</button>
        </div>
    </form>
</div>

</body>
</html>
