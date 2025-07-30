<?
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-learning V2</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- vido js CSS  -->
    <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
    <!-- flag CSS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <!-- custom css  -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- alertify  -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
</head>

<body class="hold-transition layout-navbar-fixed sidebar-collapse dark-mode">
    <div id="overlay"></div>

    <!-- <body class="layout-navbar-fixed control-sidebar-slide-open sidebar-mini sidebar-collapse"> -->
    <div class="wrapper">
        <!-- Navbar -->
        <? include "ui/nav_video.php";?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12 text-center">
                            <h1 class="m-0 ml-2 mt-2 subject_title"></h1>
                            <h4 style="opacity:70%" class="m-0 ml-2 mt-2 head_title"></h4>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="card bg-dark">
                                <div class="card-header d-flex border-0 justify-content-center">
                                    <div class="card-title mt-2">
                                        <h4><b>VIDEO TITLE : &nbsp;
                                            </b>
                                            <span class="video_title"> NAME VIDEO</span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="d-flex col-md-12 justify-content-center">
                                            <video id="my-video" class="video-js vjs-default-skin" controls
                                                preload="auto" height="auto" width="1250" poster="./img/panda.jpg"
                                                data-setup="{}">
                                            </video>
                                        </div>
                                        <div class="col-md-12 text-center mt-3">
                                            <!-- <div id='ct'></div> -->
                                            <div id="user_visitor">
                                                <b>USER VISITOR : <span
                                                        style="color:yellow"><?= $_SESSION['user'];?></span></b>
                                            </div>
                                            <div>
                                                <b>VIDEO ID : <span id="v_id"></span> </b>
                                            </div>
                                            <div id="v_name">
                                                <b>FILENAME : </b>
                                            </div>
                                            <div>
                                                <b>CURRENT TIME (MINUTE) : <span id="currentTime"
                                                        style='color:yellow;'></span></b>
                                            </div>
                                            <div id="v_lastview">
                                                <b>LAST VISITED : </b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="card card-secondary card-outline card-tabs">
                                        <div class="card-header p-0 pt-1 border-bottom-0">
                                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="custom-tabs-three-home-tab"
                                                        data-toggle="pill" href="#custom-tabs-three-home" role="tab"
                                                        aria-controls="custom-tabs-three-home" aria-selected="true"
                                                        style="color:white!important;">Video</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-three-profile-tab"
                                                        data-toggle="pill" href="#custom-tabs-three-profile" role="tab"
                                                        aria-controls="custom-tabs-three-profile" aria-selected="false"
                                                        style="color:white!important;">Handouts</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                                <div class="tab-pane fade show active" id="custom-tabs-three-home"
                                                    role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                                    <table class="table table-bordered table-hover"
                                                        id="table_video_list">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>Title</th>
                                                                <th style="width:30%">Progress ( color :
                                                                    <i class="fas fa-circle" style="color:#00bc8c"></i>
                                                                    =
                                                                    finished
                                                                    ,
                                                                    <i class="fas fa-circle" style="color:#e74c3c"></i>
                                                                    =
                                                                    not
                                                                    finished)
                                                                </th>
                                                                <th style="width: 40px" class="text-center">
                                                                </th>
                                                                <!-- <th style="width: 40px" class="text-center">
                                                                    <i class="flag-icon flag-icon-us flag-icon-xl"></i>
                                                                </th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody id="video_list_body">
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-three-profile"
                                                    role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                                    <table class="table table-bordered table-hover"
                                                        id="table_handouts_list">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>Title</th>
                                                                <th>Download file</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="handouts_list_body">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?include "ui/footer.php";?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/theme.js"></script>
    <!-- video js  -->
    <script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-playLists/0.2.0/videojs-playlists.min.js"></script> -->
    <!-- data table  -->
    <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- alertify  -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


    <script>
    $(document).ready(function() {

        var head_id = <?= json_encode($_REQUEST['head_id']);?>;
        var medcode = <?= json_encode($_SESSION['user']);?>;
        console.log('head_id = ' + head_id);



        // get element video
        myPlayer = videojs('my-video', {
            autoplay: false,
            sources: [{
                type: "video/mp4",
                src: "",
            }]
        });
        myPlayer.on("timeupdate", function(event) {
            output = (myPlayer.currentTime() / 60).toFixed(2) +
                " / " + (myPlayer.duration() / 60).toFixed(2);
            $('#currentTime').html(output);
        });



        // set every xx secon time for save current time video .
        setInterval(() => {
            if (!myPlayer.paused())
                saveCurrentTimeVideo();
        }, 10000);

        // save current time video
        saveCurrentTimeVideo = () => {
            v_id = $('#v_id').text();
            if (v_id != "" && myPlayer.currentTime() != "") {
                data = {
                    "medcode": medcode,
                    "_head_id": head_id,
                    "v_id": v_id,
                    "currentTime": myPlayer.currentTime().toString(),
                    "current_percent": parseInt((myPlayer.currentTime() * 100) / myPlayer.duration())
                        .toString(),
                }
                console.log(data);
                $.ajax({
                    url: './api/saveCurrentTime.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        dataAll: data,
                        topic: 'saveCurrentVideoTime'
                    },
                    success: function(res) {
                        console.log(res);
                        if (res == '1') {
                            console.log('current time is saved');
                        }
                    }
                })
            }
        }

        myPlayer.on('ended', function() {
            console.log(this.currentTime());
            saveCurrentTimeVideo();
        })


        // show list video to table
        show_video_list = (head_id, medcode) => {
            $.ajax({
                url: "./api/search.php",
                method: "POST",
                dataType: "json",
                data: {
                    topic: "video_list",
                    head_id: head_id,
                    medcode: medcode,
                },
                success: function(res) {
                    console.log(res);
                    if (res['video'] != undefined && res['video'].length > 0) {
                        output_video = '';
                        for (i = 0; i < res['video'].length; i++) {
                            output_video +=
                                '<tr>';
                            output_video += "<td>" + parseInt(i + 1) + "</td>";
                            output_video += "<td>" + res['video'][i]['v_title'] + "</td>";
                            output_video += "<td>";
                            output_video += '<div class = "mb-1">';
                            if (res['video'][i]['v_type'] == '1') {
                                output_video +=
                                    '<i class="flag-icon flag-icon-th"></i> <span class = "d-none d-sm-inline">(ภาษาไทย)</span>';
                            } else {
                                output_video +=
                                    '<i class="flag-icon flag-icon-us"></i> <span class = "d-none d-sm-inline">(English Language)</span>';
                            }
                            output_video += '</div>';
                            output_video += '<div class="progress progress-xs">';
                            output_video += '<div class="progress-bar';
                            output_video += (res['video'][i]['current_percent'] == '100') ?
                                ' bg-success"' : ' bg-danger"';
                            output_video += ' style="width: ' +
                                res['video'][i]['current_percent'] + '%"></div>';
                            output_video += '</div>';
                            output_video += '<div>' + '<span class="badge ';
                            output_video += (res['video'][i]['current_percent'] == '100') ?
                                ' bg-success ' : ' bg-danger ';
                            output_video += 'float-right mt-2" style = "font-size:100%">' +
                                res['video']
                                [i]['current_percent'] + '%</span>' +
                                '<p style = "color:gray;" class = "ml-2 mt-1 d-none d-sm-block">Last Visited : ' +
                                res['video'][i]['last_visited'] +
                                '</p></div>';
                            output_video += '</td>';
                            output_video +=
                                '<td><a class="btn btn-info" onclick="show_video(' + res[
                                    'video'][i]['v_id'] + ',' + res['video'][i]['v_type'] +
                                ')"><i class="fas fa-play"></i> Play </a></td>';
                            output_video += '</tr>';
                        }
                        $('#video_list_body').html(output_video);
                        $('#table_video_list').DataTable({
                            "paging": true,
                            "lengthChange": false,
                            "searching": false,
                            "ordering": true,
                            "info": true,
                            "autoWidth": false,
                            "responsive": true,
                        });
                    }
                    if (res['pdf'] != undefined && res['pdf'].length > 0) {
                        output_pdf = '';
                        for (i = 0; i < res['pdf'].length; i++) {
                            output_pdf += '<tr>';
                            output_pdf += '<td>' + parseInt(i + 1) + '</td>';
                            output_pdf += '<td>' + res['pdf'][i]['p_title'] + '</td>';
                            output_pdf +=
                                '<td><a href = "./uploads/header/' + res['pdf'][i]['_head_id'] +
                                '/handouts/' + res['pdf'][i]['p_filename'] +
                                '" class="btn btn-default " id = "' +
                                res[
                                    'pdf'][i]['p_id'] +
                                '" download><i class="fas fa-file-pdf"></i> ' +
                                res['pdf'][i]['p_title'] + '</a></td>';
                            output_pdf += '</tr>';
                        }
                        $('#handouts_list_body').html(output_pdf);
                        $('#table_handouts_list').DataTable({
                            "paging": true,
                            "lengthChange": false,
                            "searching": false,
                            "ordering": true,
                            "info": true,
                            "autoWidth": false,
                            "responsive": true,
                        });
                    }
                }
            })
        }

        // when click btn on table list call function show video
        show_video = (v_id, v_type) => {
            $.ajax({
                url: './api/search.php',
                method: "POST",
                dataType: "json",
                data: {
                    topic: 'video',
                    v_id: v_id,
                    v_type: v_type,
                    medcode: medcode
                },
                beforeSend: function(data) {
                    $('#overlay').addClass('loading');
                },
                success: function(res) {
                    if (res.length > 0) {
                        // SET DETAILS VIDEO 
                        $('.video_title').html(res[0]['v_title'])
                        $('#v_id').html("<span style = 'color:red'>" + res[0]
                            [
                                'v_id'
                            ] + "</span>");
                        $('#v_name').html("<b>filename : " + "<span style = 'color:red'>" + res[
                            0][
                            'v_filename'
                        ] + "</span></b>");
                        $('#v_lastview').html("<b>last visited : " +
                            "<span style = 'color:red'>" + res[
                                0][
                                'last_visited'
                            ] + "</span></b>");
                        // ./
                        output_html = '';
                        var videoPath = 'uploads/header/' + res[0]['_header_id'] + '/video/';
                        console.log('path = ' + videoPath)
                        videoPath += (res[0]['v_type'] == '1') ? 'TH/' : 'EN/';
                        videoPath += res[0]['v_filename'];
                        output_html = '<source src="' + videoPath + '" type="video/mp4" />';
                        $('#my-player').html(output_html);
                        myPlayer.pause()
                        myPlayer.src(videoPath);
                        myPlayer.poster('./img/panda.jpg');
                        myPlayer.load();
                        if (res[0]['current_secTime'] != '') {
                            myPlayer.currentTime(parseFloat(res[0]['current_secTime']));
                        }
                    } else {
                        alertify.error('err ! file not found');

                    }
                },
                complete: function(data) {
                    $('#overlay').removeClass('loading');
                }
            })
        }

        //set subject name to header
        getSubjectNameByHeadID = (head_id) => {
            $.ajax({
                url: './api/search.php',
                dataType: 'json',
                method: 'POST',
                data: {
                    topic: 'getSubjectByHeadID',
                    head_id: head_id
                },
                success: function(res) {
                    console.log(res);
                    subject_name = '';
                    subject_name += "รายวิชา : " + res[0]['subj_code'] + "<br>" + res[0][
                            'subj_nameT'
                        ] +
                        " ( " + res[0]['subj_nameE'] + " ) ";
                    $('.head_title').html(subject_name);
                }
            })
        }

        //go back history
        goBack = () => {
            window.history.back();
        }
        // onload function 
        callFunc = () => {
            // display_ct();
            show_video_list(head_id, medcode);
            getSubjectNameByHeadID(head_id);
        }
        callFunc();
        // isClosing = () => {
        //     $.ajax({
        //         url: './api/saveLog.php',
        //         method: 'POST',
        //         dataType: 'json',
        //         data: {
        //             medcode: medcode,
        //             topic: 'logout'
        //         }
        //     })
        // }
    });
    </script>

</body>

</html>