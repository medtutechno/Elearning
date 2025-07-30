<?
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ./logout.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sidebar</title>
</head>

<body>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="main.php" class="brand-link">
            <img src="./dist/img/med_logo.png" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">E-learning</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#"
                        class="d-block"><?= "USER : ".(isset($_SESSION['user']) ? $_SESSION['user'] : 'USERNAME CODE');?></a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-flat show_details_class" data-widget="treeview"
                    role="menu" data-accordion="false">
                    <?include "material.php";?>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        $.ajax({
            url: "./api/select.php",
            method: "POST",
            data: {
                topic: 'class'
            },
            success: function(data) {
                console.log(data);
                output = '<li class="nav-header">ชั้นปีนักศึกษา</li>';
                if (data.length > 0) {
                    for (i = 0; i < data.length; i++) {
                        c_id = data[i]['c_id'];
                        output += '<li class="nav-item">';
                        output +=
                            '<a href="#" class="nav-link" onclick = "show_subject(this.id,this.text)" id = "' +
                            c_id + '">';
                        output += ' <i class = "nav-icon fas fa-list-alt" > </i>';
                        output += '<p> ' + data[i]['c_name'] +
                            '</p></a>';
                        output += '</li>';
                    }
                }
                $('.show_details_class').prepend(output);
            },
        });
    })
    </script>
</body>

</html>