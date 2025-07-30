<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <style scoped>
    .navbar {
        background-color: #2a2a2a;
        height: 60px;
        /* border-bottom: solid 1px #009e83; */
        border-bottom: solid 1px #fc997c;
        padding-right: 0;
        padding-top: 0;
    }

    .navbar-brand img {
        width: 262px;
        height: 45px;
    }

    .btn-logout {
        width: 80px;
        height: 60px;
        background-color: #fc997c;
        font-size: 24px;
        text-align: center;
        line-height: 60px;
        cursor: pointer;
        margin-top: 0;
        padding-top: 0;
    }

    .btn-logout i {
        color: #2a2a2a;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-light">
        <a class="navbar-brand" href="#">
            <img src="./img/logo.svg" alt="Logo" />
        </a>
        <a onclick="onLogout()" class="btn-logout">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
        </a>
    </nav>
</body>

</html>