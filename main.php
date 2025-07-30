<?
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Please Sign In !')</script>";
    echo "<script>window.location.href='./login.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-learning</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://vjs.zencdn.net/7.2.3/video-js.css">

    <!-- alertify  -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />

    <!-- <link rel="stylesheet" href="./plugins/toastr/toastr.min.css"> -->
</head>

<body class="hold-transition layout-navbar-fixed dark-mode">
    <div id="overlay"></div>
    <!-- <body class="layout-navbar-fixed control-sidebar-slide-open sidebar-mini sidebar-collapse"> -->
    <div class="wrapper">
        <!-- Navbar -->
        <? include "./ui/nav.php"; ?>

        <div class="container">
            <div class="form-row">
                <div class="col">
                    <div class="float-right">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $_SESSION['user']; ?>
                                &nbsp;
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <? if ($_SESSION['roll'] == '1') { ?>
                                    <a class="dropdown-item" href="./adminDashboard/main.php">Admin</a>
                                <? } ?>
                                <a class="dropdown-item" href="./">User</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <hr>
            <? include "./ui/lastview.php"; ?>
            <? include "./ui/class.php"; ?>
            <? include "./ui/details.php"; ?>
            <? include "./ui/video_list.php"; ?>
            <? include "./ui/handout_list.php"; ?>
        </div>
    </div>
    <? include "./ui/videoPlayer.php"; ?>

    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.6.0/popcorn.js"></script>
    <!-- include the script -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://rawgit.com/allensarkisyan/VideoFrame/master/VideoFrame.min.js"></script>




    <script>
        $(document).ready(function() {
            const medcode = <?= json_encode($_SESSION['user']); ?>;
            let subj_name = '';
            let cur_head_id = '';
            let cur_vType = '';
            let cur_headName = '';
            // ---------------- ALL FUNCTION -------------------

            initialLoadFunction = () => {
                onLoadClassRoom();
                onLoadLastVisited();
            }
            onLoadClassRoom = () => {
                $.ajax({
                    url: "./api/select.php",
                    method: "POST",
                    data: {
                        topic: 'class'
                    },
                    success: function(data) {
                        console.log(data);
                        output = "";
                        if (data.length > 0) {
                            for (i = 0; i < data.length; i++) {
                                c_id = data[i]['c_id'];
                                output +=
                                    '<button class="btn btn-secondary btn-square-md mr-4" onclick = "show_subject(this.id,this.text)" data-toggle="tooltip" title="' +
                                    data[i]['c_name'] + '"';
                                output += 'id = "' + c_id + '">';
                                output += '<span>';
                                output += (data[i]['order_show'] < 7) ? i + 1 : `📦`;
                                output += '</span>'
                                output += '</button>';
                            }
                        }
                        $('.show_class').html(output);
                        $('[data-toggle="tooltip"]').tooltip();

                    },
                });
            }
            onLoadLastVisited = () => {
                $.ajax({
                    url: "./api/search.php",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        topic: "onLoadLastVisited",
                        medcode: medcode
                    },
                    success: function(data) {
                        console.log(data);
                        // get videos list file
                        if (typeof data.video_lastview !== 'undefined' && data.video_lastview
                            .length > 0) {
                            let output = '';
                            let video_list = data.video_lastview;
                            for (i = 0; i < video_list.length; i++) {

                                // cur variable use for set percent Watched or Never Watch
                                let cur = (video_list[i]['current_percent'] != null) ? video_list[i]
                                    ['current_percent'] : '0';
                                output += '<div class="col-md-2">';
                                let vid = "lastview_list_show" + i;
                                output += '<video height="auto" width="100" id="' +
                                    vid +
                                    '" onclick="show_video(' +
                                    video_list[i]['v_id'] + ',' + video_list[i]['v_type'] +
                                    ')" style = "cursor:pointer">';

                                // path of video src 
                                let path = './uploads/header/' + video_list[i]['_head_id'] +
                                    '/video/';
                                path += (video_list[i]['v_type'] == 1) ? "TH" : "EN";
                                path += '/' + video_list[i]['v_filename'];
                                output += '<source src="' + path + '">';
                                output += '</source> </video>';
                                output += '<br /><div class="text-center">';
                                output +=
                                    '<div class="progress center-block" style="width: 200px">';
                                output +=
                                    '<div class="progress-bar progress-bar-striped active" role="progressbar"';
                                output += 'style="width: ' + cur +
                                    '%"> <span> ' + cur +
                                    '% </span></div>';
                                output +=
                                    '</div></div><small class="text-muted"><span style = "font-style: italic;color:#009e83">' +
                                    video_list[i][
                                        'head_name'
                                    ] + "</span><br>" +
                                    video_list[i][
                                        'v_title'
                                    ] + '</small></div>';
                            }
                            $('.lastview_list_show').html(output);

                            // set image video list from current time
                            for (i = 0; i < video_list.length; i++) {
                                let vid = "lastview_list_show" + i;
                                loadImage(vid, video_list[i]['current_secTime']);
                            }
                        }
                    },
                })
            }
            show_subject = (class_id, class_no) => {
                console.log('class_id = ' + class_id);
                console.log('class_no = ' + class_no);
                $('.subj_show').html('');
                $('.header_show').html('');
                $('.handout_list_show').html('');
                $('.video_list_show').html('');

                $.ajax({
                    url: "./api/select.php",
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
                            for (i = 0; i < data.length; i++) {
                                // in select 
                                output_select += '<option value = "' + data[i]['subj_id'] + '">' +
                                    data[i]['subj_code'] + "<br>" + data[
                                        i]['subj_nameT'] +
                                    " ( " + data[i]['subj_nameE'] + " ) " + '</option>';

                                // in table 
                                output += '<tr class="tr_details" onclick = "show_header(' +
                                    data[i]['subj_id'] + ')">';
                                output += '<td>' + data[i]['subj_nameT'] +
                                    ' (' + data[i]['subj_nameE'] + ')' + '</td>';
                                output += '<td>';
                                output += data[i]['subj_code'];
                                output += '</td>';
                                output += '</tr>';
                            }
                            $('#selectSubject').html(output_select);
                            $('.subj_show').html(output);


                        }
                    },
                    complete: function(data) {
                        $('#overlay').removeClass('loading');
                    }
                })
            }
            show_header = (subj_id) => {
                console.log('subj_id = ' + subj_id);
                $.ajax({
                    url: "./api/select.php",
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
                        console.log('header')
                        console.log(data);
                        if (data.length > 0) {
                            output = '';
                            for (i = 0; i < data.length; i++) {
                                let styleTh = '';
                                let styleEn = '';
                                let stylePdf = '';
                                (data[i]['has_th'] == '1') ? styleTh = 'style = "opacity:1"':
                                    styleTh = 'style = "opacity:0.3"';
                                (data[i]['has_en'] == '1') ? styleEn = 'style = "opacity:1"':
                                    styleEn = 'style = "opacity:0.3"';
                                (data[i]['has_pdf'] == '1') ? stylePdf = 'style = "opacity:0.8"':
                                    stylePdf = 'style = "opacity:0.3"';
                                output +=
                                    '<tr  >';
                                output += '<td width = "80%">' + data[i]['head_name'] + '</td>';
                                3
                                output += '<td class="d-flex">';
                                output +=
                                    '<a class="flex tr_details ml-3" onclick = "onLoadVideoAndPdf(' +
                                    data[i]['head_id'] + ',' + '1' + ',`' + data[i]['head_name'] +
                                    '`)">';
                                output += '<span class="flag-icon flag-icon-th"'
                                output += styleTh;
                                output += '></span></a>';
                                output +=
                                    '<a class="flex tr_details ml-3" onclick = "onLoadVideoAndPdf(' +
                                    data[i]['head_id'] + ',' + '2' + ',`' + data[i]['head_name'] +
                                    '`)">'
                                output += '<span class="flag-icon flag-icon-us"';
                                output += styleEn;
                                output += '></span></a>';
                                output +=
                                    '<a class="flex tr_details ml-3" style = "color:white;" onclick = "onLoadVideoAndPdf(' +
                                    data[i]['head_id'] + ',' + '0' + ',`' + data[i]['head_name'] +
                                    '`)">'
                                output += '<i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"';
                                output += stylePdf;
                                output += '></i></a>';
                                output += '</td>';
                                output += '</tr>';
                            }
                            $('.header_show').html(output);
                        }
                    },
                    complete: function(data) {
                        $('#overlay').removeClass('loading');
                    }
                })
            }
            onLoadVideoAndPdf = (head_id, v_type, head_name) => {
                console.log(v_type, head_id, head_name, medcode);
                cur_head_id = head_id;
                cur_vType = v_type;
                cur_headName = head_name;

                // medcode variable use for check current time video watched
                // flag_output variable use for show flag on card video list
                let flag_output = "";

                if (v_type == '1') {
                    flag_output += '<span class="flag-icon flag-icon-th" style ="font-size:1.5rem"></span>';
                } else {
                    flag_output += '<span class="flag-icon flag-icon-us" style ="font-size:1.5rem"></span>';
                }
                $('.flag_video_list').html(flag_output);
                $('.head_title_video_list').html("<span>" + head_name + "</span>");

                // reset video list and handout list every search 
                $('.video_list_show').html('');
                $('.handout_list_show').html('');

                $.ajax({
                    url: "./api/search.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        topic: 'onLoadVideoAndPdf',
                        head_id: head_id,
                        v_type: v_type,
                        medcode: medcode
                    },
                    beforeSend: function(data) {
                        $('#overlay').addClass('loading');
                    },
                    success: function(data) {
                        console.log("Videos and Handouts");
                        console.log(data);

                        // get videos list file
                        if (typeof data.video !== 'undefined' && data.video.length > 0) {
                            let output = '';
                            let video_list = data.video;
                            for (i = 0; i < video_list.length; i++) {

                                // cur variable use for set percent Watched or Never Watch
                                let cur = (video_list[i]['current_percent'] != null) ? video_list[i]
                                    ['current_percent'] : '0';
                                output += '<div class="col-md-2">';
                                let vid = "video" + i;
                                output += '<video height="auto" width="100" id="' +
                                    vid +
                                    '" onclick="show_video(' +
                                    video_list[i]['v_id'] + ',' + video_list[i]['v_type'] +
                                    ')" style = "cursor:pointer">';

                                // path of video src 
                                let path = './uploads/header/' + head_id + '/video/';
                                path += (video_list[i]['v_type'] == 1) ? "TH" : "EN";
                                path += '/' + video_list[i]['v_filename'];
                                output += '<source src="' + path + '">';
                                output += '</source> </video>';
                                output += '<br /><div class="text-center">';
                                output +=
                                    '<div class="progress center-block" style="width: 200px">';
                                output +=
                                    '<div class="progress-bar progress-bar-striped active" role="progressbar"';
                                output += 'style="width: ' + cur +
                                    '%"> <span> ' + cur +
                                    '% </span></div>';
                                output += '</div></div><small class="text-muted">' +
                                    video_list[i][
                                        'v_title'
                                    ] + '</small></div>';
                            }
                            $('.video_list_show').html(output);

                            // set image video list from current time
                            for (i = 0; i < video_list.length; i++) {
                                let vid = "video" + i;
                                loadImage(vid, video_list[i]['currentTime']);
                            }
                        }

                        // get handout list file
                        if (typeof data.pdf !== 'undefined' && data.pdf.length > 0) {
                            let output = "";
                            let pdf_list = data.pdf;
                            for (i = 0; i < pdf_list.length; i++) {
                                output += '<tr><td width="85%">' + pdf_list[i]['p_title'] +
                                    '</td>';
                                output +=
                                    '<td><a class="flex tr_details mt-2" onclick="onsearchPdf(`' +
                                    pdf_list[i]['_head_id'] + '`,`' + pdf_list[i]['p_filename'] +
                                    '`)"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a></td></tr>'
                            }
                            $('.handout_list_show').html(output);
                        }
                    },
                    complete: function(data) {
                        $('#overlay').removeClass('loading');
                    }
                })
            }
            $('#selectSubject').on('change', function() {
                console.log('select changed')
                console.log($(this).val())
                subj_id = $(this).val();
                show_header(subj_id.toString());
            })
            onLogout = () => {
                alertify.confirm("confirm logout .",
                    function() {
                        window.location.href = "./logout.php";
                    },
                    function() {
                        alertify.error('Cancel');
                    }).set({
                    title: "are you sure for sign out ?"
                });
            }
            onsearchPdf = (head_id, p_filename) => {
                pdf_url = "";
                pdf_url += "./uploads/header/" + head_id + "/handouts/" + p_filename;
                window.open(pdf_url);
                console.log(head_id, p_filename);
            }
            player_show = () => {
                $('#player_modal').modal('show');
            }

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
            myPlayer.on('ended', function() {
                console.log(this.currentTime());
                saveCurrentTimeVideo();
            })

            $('#player_modal').on('hide.bs.modal', function() {
                console.log('modal video hide now')
                onLoadLastVisited();
                onLoadVideoAndPdf(cur_head_id, cur_vType, cur_headName)
                myPlayer.pause();
                // will only come inside after the modal is shown
            });

            setInterval(() => {
                if (!myPlayer.paused()) {
                    saveCurrentTimeVideo();
                }
            }, 10000);

            saveCurrentTimeVideo = () => {
                v_id = $('#v_id').text();
                if (v_id != "" && myPlayer.currentTime() != "") {
                    data = {
                        "medcode": medcode,
                        "_head_id": cur_head_id,
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
                            cur_head_id = res[0]['_header_id'];
                            // SET DETAILS VIDEO 
                            $('.v_title').html(res[0]['v_title'])
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
                            // myPlayer.poster('./img/panda.jpg');
                            myPlayer.load();
                            $('#player_modal').modal('show');

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

            // first image poster video  media will use capture img from current time video 
            var video = Popcorn("#my-video");
            video.listen("canplayall", function() {
                this.currentTime(10).capture();
            });

            // this function use for first image poster video list media will use capture img from current time video 
            loadImage = (vid, curTime = 0) => {
                let player = document.getElementById(vid);
                player.onloadedmetadata = function() {
                    console.log('metadata loaded!');
                    if (curTime != this.duration) {
                        player.currentTime = curTime;
                    } else {
                        player.currentTime = 0;
                    }
                };
            }

            initialLoadFunction();

            // ---------------- ./ALL FUNCTION -------------------
        })
    </script>
</body>

</html>