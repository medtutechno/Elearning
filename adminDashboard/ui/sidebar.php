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
            <img src="../dist/img/med_logo.png" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">E-learning</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#"
                        class="d-block"><?= "USER : ".(isset($_SESSION['user']) ? $_SESSION['user'] : 'USERNAME CODE');?></a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview"
                    role="menu" data-accordion="false">
                    <li class="nav-header"> จัดการข้อมูล

                    <li class="nav-item">
                        <a href="?page=manage_subject" class="nav-link">
                            <i class="far fa-edit nav-icon"></i>
                            <p>ชั้นปี / รายวิชา / หัวเรื่อง</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=manage_videoContent" class="nav-link">
                            <i class="far fa-file-video nav-icon"></i>
                            <p>วิดีโอ / PDF</p>
                        </a>
                    </li>

                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</body>

</html>