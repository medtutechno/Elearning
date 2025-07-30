<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-learning | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
    <!-- Alertify -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <div class="text-center">
                <img class="profile-user-img img-fluid" style="border: 0px !important;" src="./dist/img/med_logo.png">
            </div>
            <p><b>E-learning</b> | <b>Login</b> </p>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form id="form_login" action="#">
                    <div class="input-group mb-3">
                        <input type="text" name="medcode" class="form-control" placeholder="Medcode">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 ml-auto mb-3">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>

                        <a class="btn btn-block btn-sm btn-outline-secondary"
                            href="https://med.tu.ac.th/km/wp-content/uploads/2022/05/Handbook-elearning.pdf">คู่มือสำหรับนักศึกษา
                        </a>
                        <a class="btn btn-block btn-sm btn-outline-secondary"
                            href="https://med.tu.ac.th/km/wp-content/uploads/2022/06/Handbook-elearningAdmin.pdf">คู่มือสำหรับนแอดมิน
                        </a>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- <p class="mb-1">
                    <a href="#">I forgot my password</a>
                </p> -->
                <p class="mb-0">
                    <a href="#" class="text-center">techno service</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- jquery-validation -->
    <script src="./plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="./plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./dist/js/adminlte.min.js"></script>
    <!-- Alertify -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


    <script>
    $(function() {
        $('#form_login').validate({
            rules: {
                medcode: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 3
                },
            },
            messages: {
                medcode: {
                    required: "Please enter a Medcode"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 3 characters long"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                $.ajax({
                    url: './api/checkLogin.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        user: $('[name = medcode]').val(),
                        pass: $('[name = password]').val()
                    },
                    success: function(res) {
                        // console.log(res);
                        var message = '';
                        if (res['status']) {
                            if (res['roll'] != '1') {
                                alert('User Login Successful');
                                window.location = "./main.php";
                            } else {
                                alert('Admin Login Successful');
                                window.location =
                                    "./adminDashboard/main.php";
                            }
                        } else {
                            alert('ไม่พบข้อมูล');
                        }
                    },
                });
            }
        });
    });
    </script>
</body>

</html>