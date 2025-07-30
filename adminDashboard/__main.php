<? session_start();?>
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
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- vido js CSS  -->
    <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
    <!-- flag CSS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <!-- custom css  -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition layout-navbar-fixed dark-mode">
    <div id="overlay"></div>
    <div class="wrapper">
        <!-- Navbar -->
        <? include "./ui/nav.php";?>

        <!-- sidebar-container  -->
        <? include "./ui/sidebar.php";?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>จัดการข้อมูล ชั้นปี, รายวิชา, หัวเรื่อง และวิดีโอ</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content header list -->
            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">ชั้นปี</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <table class="table table-bordered table_class_list">
                                        <thead>
                                            <tr>
                                                <th>ชั้นปี</th>
                                                <th width="10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="table_class">

                                        </tbody>
                                    </table>
                                    <button class="btn btn-sm btn-success float-right">
                                        <i class="fas fa-plus"></i> Add Class
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="card col-md-5">
                                <div class="card-header">
                                    <h1 class="card-title">รายวิชา</h1>
                                </div>
                                <div class="card-body">
                                    <div class="table_subject_show">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card col-md-7">
                                <div class="card-header">
                                    <h1 class="card-title">หัวเรื่อง</h1>
                                </div>
                                <div class="card-body">
                                    <div class="table_header_show">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?include "./ui/footer.php";?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="../dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/theme.js"></script>

    <!-- data table  -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- <script src="./plugins/toastr/toastr.min.js"></script> -->


    <script>
    $(document).ready(function() {
        user_session = <?= json_encode($_SESSION['user']) ;?>;
        subj_name = '';

        // $('.table_video').DataTable({
        //     "paging": true,
        //     "lengthChange": false,
        //     "searching": false,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "pageLength": 5,
        //     "responsive": true,
        // });



        // ---------------- ALL FUNCTION -------------------
        init = () => {
            show_class();
        }
        show_class = () => {
            $.ajax({
                url: "../api/select.php",
                dataType: "JSON",
                method: "POST",
                data: {
                    topic: "class"
                },
                success: function(res) {
                    console.log(res);
                    output = "";
                    if (res.length > 0) {
                        for (i = 0; i < res.length; i++) {
                            output += '<tr>';
                            output += '<td>' + res[i]['c_name'] + '</td>';
                            output += '<td>';
                            output += '<div class="btn-group btn-group-sm">';
                            output +=
                                '<a class="btn btn-info btn-sm" href="#" onclick = "show_subject(' +
                                res[i]['c_id'] + ')" id = "' + res[
                                    i]['c_id'] + '"><i class="fas fa-eye"></i></a>';
                            output += '<a class="btn btn-warning btn-sm" href="#" id = "' + res[
                                i]['c_id'] + '"><i class="fas fa-pencil-alt"></i></a>';
                            output += '<a class="btn btn-danger btn-sm" href="#" id = "' + res[
                                i]['c_id'] + '"><i class="fas fa-trash"></i></a>';
                            output += '</div>';
                            output += '</td>';
                            output += '</tr>';
                            $('.table_class').html(output);
                        }
                        $('.table_class_list').DataTable({
                            "paging": true,
                            "lengthChange": false,
                            "searching": false,
                            "ordering": true,
                            "info": true,
                            "autoWidth": false,
                            "pageLength": 5,
                            "responsive": true,
                        });
                    }
                }
            })
        }
        show_subject = (class_id) => {
            console.log('class_id = ' + class_id);
            $('.table_header_show').html('');

            $.ajax({
                url: "../api/select.php",
                method: "POST",
                dataType: "json",
                data: {
                    topic: 'subject',
                    class_id: class_id
                },
                beforeSend: function(data) {
                    $('#overlay').addClass('loading');
                },
                success: function(data) {
                    console.log(data);
                    if (data.length > 0) {
                        // in select 
                        output_select = '';
                        output_select += '<option selected disabled>' + 'Select Subject' +
                            '</option><hr>';


                        // in table 
                        output = '';
                        output +=
                            '<table class="table table-bordered table-hover table_subject_dataTable" width = "100%">';
                        output += '<thead>';
                        output += '<tr>';
                        output += '<th style="width: 10%">#</th>';
                        output += '<th>รายวิชา</th>';
                        output += '</tr>';
                        output += '</thead>';
                        output += '<tbody>';
                        for (i = 0; i < data.length; i++) {

                            // in select 

                            output_select += '<option value = "' + data[i]['subj_id'] + '">' +
                                data[i]['subj_code'] + "<br>" + data[
                                    i]['subj_nameT'] +
                                " ( " + data[i]['subj_nameE'] + " ) " + '</option>';

                            // in table 
                            output += "<tr style = 'cursor:pointer' onclick = 'show_header(" +
                                data[i]['subj_id'] +
                                ")'>";
                            output += "<td>" + parseInt(i + 1) + "</td>";
                            output += "<td>";
                            output += data[i]['subj_code'] + "<br>" + data[i]['subj_nameT'] +
                                " ( " +
                                data[i]['subj_nameE'] + " ) ";
                            output += "</td>";
                            output += "</tr>";
                        }
                        output += '</tbody></table>';
                        output +=
                            '<button class="btn btn-sm btn-success float-right mt-md-2"><i class="fas fa-plus"></i> Add Subject</button>';
                        $('#selectSubject').html(output_select);
                        $('.table_subject_show').html(output);


                    }
                },
                complete: function(data) {
                    $('#overlay').removeClass('loading');
                    $('.table_subject_dataTable').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                    });
                }
            })
        }

        show_header = (subj_id) => {
            console.log('subj_id = ' + subj_id);
            $.ajax({
                url: "../api/select.php",
                method: "POST",
                dataType: "json",
                data: {
                    topic: 'header',
                    subj_id: subj_id
                },
                beforeSend: function(data) {
                    $('#overlay').addClass('loading');
                },
                success: function(data) {
                    console.log(data);
                    if (data.length > 0) {
                        output = '';
                        output +=
                            '<table class="table table-bordered table-hover table_header_dataTable">'
                        output +=
                            '<thead><tr><th style="width: 10%">#</th><th>หัวเรื่อง</th></tr></thead><tbody>';
                        for (i = 0; i < data.length; i++) {
                            output +=
                                "<tr style = 'cursor:pointer' onclick = 'show_video_content(" +
                                data[i]['head_id'] +
                                ")'>";
                            output += "<td>" + parseInt(i + 1) + "</td>";
                            output += "<td>";
                            output += "<b>" + data[i]['head_teach'] + "</b><br>" + data[i][
                                    'head_name'
                                ] +
                                "<br><p style = 'color:gray'> created : " +
                                data[i]['head_date'] + "</p>";
                            output += "</td>";
                            output += "</tr>";
                        }
                        output += '</tbody></table>';
                        $('.table_header_show').html(output);
                    }
                },
                complete: function(data) {
                    $('#overlay').removeClass('loading');
                    $('.table_header_dataTable').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                    });
                }
            })
        }

        // this function process video and handouts content 
        show_video_content = (head_id) => {
            console.log('show_content function clicked');
            console.log('head_id = ' + head_id);
            window.location.href = './video.php?head_id=' + head_id +
                '&user_session=' + user_session;
        }
        // ./this function process video and handouts content 

        $('#selectSubject').on('change', function() {
            console.log('select changed')
            console.log($(this).val())
            subj_id = $(this).val();
            show_header(subj_id.toString());
        })
        // this function process edit header content 
        edit_content = (head_id, subj_id) => {
            console.log('edit_content function clicked');
            console.log('subj = ' + subj_id);
            console.log('header = ' + head_id);
        }
        // ./this function process edit header content 

        add_content = (subj_id) => {
            console.log('add_content function clicked');
            console.log('subj = ' + subj_id);
            console.log('header = ' + head_id);
        }

        swap = (order_show1, order_show2) => {
            dataForm = {
                'order_show1': order_show1,
                'order_show2': order_show2,
            };
            $.ajax({
                url: "./api/action.php",
                dataType: "json",
                method: "POST",
                data: {
                    topic: 'swap',
                    data: dataForm
                },
                success: function(res) {
                    console.log(res);
                }
            })
        }

        $('.show_edit_page').on('click', function() {
            console.log(1);
            console.log("page edit = " + $(this).val());
        })

        show_edit_page = (topic) => {
            console.log(topic)
        }

        init();


        // ---------------- ./ALL FUNCTION -------------------

    })
    </script>
</body>

</html>