<?
session_start();
if($_SESSION['roll'] != 1){
    echo "<script>alert('ท่านไม่มีสิทธิ์เข้าถึงหน้า');window.location.href='../logout.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-learning ( ADMINISTRATOR)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">
    <!-- vido js CSS  -->
    <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
    <!-- flag CSS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Alertify -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
</head>

<body class="layout-navbar-fixed ">
    <div id="overlay"></div>
    <div class="wrapper">
        <!-- Navbar -->
        <? include "./ui/nav.php";?>

        <!-- sidebar-container  -->
        <? include "./ui/sidebar.php";?>

        <!-- Content Wrapper. Contains page content [main] -->
        <div class="content-wrapper">
            <br>
            <div class="form-row mr-5">
                <div class="col">
                    <div class="float-right">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $_SESSION['user'];?>
                                &nbsp;
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="./">Admin</a>
                                <a class="dropdown-item" href="../main.php">User</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <? 
            $page = isset($_GET['page']) ? $_GET['page'] : 'manage_subject';
            $page .= '.php';
            include $page ;
            ?>
        </div>
        <a id="back-to-top" href="#" class="btn btn-secondary back-to-top" role="button" aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>
        <!-- /.content-wrapper -->



        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->




        <!-- footer layout -->
        <? include "./ui/footer.php";?>

    </div>

    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="../js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../js/theme.js"></script>

    <!-- data table  -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>


    <!-- Alertify -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</body>

</html>
<style scoped>
.card-header {
    width: 100%
}

.card,
.card-header,
.btn {
    border-radius: 0;
}

tr td .btn {
    width: 30px;

}

.modal .modal-content,
.modal .modal-content .form-group .form-control {
    background-color: #FFFFFF;
    color: #2E2E2E
}

.modal-body {
    margin-left: 9%;
    margin-right: 9%;
}

.table td,
.table th {
    vertical-align: middle;
}

table tbody td {
    cursor: pointer;
}
</style>