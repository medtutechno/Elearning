<!-- เป็น เวอร์ชั่นก่อนทำการแบ่งหน้า Page -->

<?
session_start();
if(!isset($_SESSION['user']) && strtoupper($_SESSION['user']) != "ADMIN"){
    header('Location: ../logout.php');
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
    <!-- custom css  -->
    <link rel="stylesheet" href="../css/style.css">
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
    <div class="wrapper" id="app">
        <!-- Navbar -->
        <? include "./ui/nav.php";?>

        <!-- sidebar-container  -->
        <? include "./ui/sidebar.php";?>

        <!-- Content Wrapper. Contains page content [main] -->
        <div class="content-wrapper">
            <hr>
            <div class="form-row ml-md-3">

                <!-- table class -->
                <?include "./tableClass.php" ;?>

                <!-- table subject -->
                <?include "./tableSubject.php" ;?>

                <!-- table header -->
                <?include "./tableHeader.php" ;?>


            </div>
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


        <!-- modal for manage data ( class , subject , header ) -->
        <? include "./modalAction/class.php" ?>
        <? include "./modalAction/subject.php" ?>
        <? include "./modalAction/header.php" ?>


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
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Alertify -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
    const app = new Vue({
        el: '#app',
        data: {
            classList: [],
            subjectList: [],
            headerList: [],
            form_Class: {
                c_name: '',
            },
            formeditClass: {
                c_id: '',
                c_name: ''
            },
            form_subject: {
                c_id: '',
                subj_code: '',
                subj_nameT: '',
                subj_nameE: ''
            },
            formeditSubject: {
                subj_id: '',
                c_id: '',
                subj_id: '',
                subj_nameT: '',
                subj_nameE: ''
            },
            form_header: {
                head_teach: '',
                head_date: '',
                head_name: '',
                subj_name: '',
                subj_id: '',
            },
            formeditHeader: {
                head_id: '',
                head_tech: '',
                head_date: '',
                head_name: '',
                subj_name: '',
                subj_id: '',
            }
        },
        mounted() {
            // โหลดข้อมูลชั้นปี
            this.initialLoadClass();
        },
        methods: {
            //#region  Class

            // โหลดชั้นปี
            initialLoadClass() {
                axios.post('./api/action.php', {
                    action: 'initialLoadClass'
                }).then(response => {
                    this.classList = response.data;
                }).catch(err => {
                    alert(err.response.data)
                })
            },
            // แสดง Modal Form สำหรับเพิ่มข้อมูลชั้นปี
            onCerateClass() {
                $('#addClassModal').modal('show');
            },
            // เพิ่มข้อมูลชั้นปี
            onSubmitClass() {
                axios.post('./api/action.php', {
                    c_name: this.form_Class.c_name,
                    action: 'createClass'
                }, ).then(response => {
                    if (response.data.status) {
                        $('#addClassModal').modal('hide');
                        this.initialLoadClass();
                        alertify.success('Inserted');

                    }
                }).catch(err => {
                    alertify.error(err);
                })
            },
            // ลบข้อมูลชั้นปี
            onDeleteClass(item) {
                if (confirm("ท่านแน่ใจว่าต้องการลบข้อมูล " + item.c_name + "?")) {
                    axios.post('./api/action.php', {
                        c_id: item.c_id,
                        action: 'deleteClass'
                    }).then(response => {
                        this.initialLoadClass();
                        alertify.error('Deleted');
                    }).catch(err => {
                        console.log(err)
                    })
                }
            },
            // แสดง Modal สำหรับ แก้ไขข้อมูลชั้นปี
            onEditClass(item) {
                this.formeditClass.c_id = item.c_id;
                this.formeditClass.c_name = item.c_name;
                $('#editClassModal').modal('show');
            },
            // อัพเดตข้อมูลชั้นปี
            onUpdateClass() {
                if (this.formeditClass.c_id && this.formeditClass.c_name) {
                    axios.post('./api/action.php', {
                        c_id: this.formeditClass.c_id,
                        c_name: this.formeditClass.c_name,
                        action: 'updateClass'
                    }).then(response => {
                        this.onResetFormEditClass();
                        this.initialLoadClass();
                        alertify.success('Updated');
                        $('#editClassModal').modal('hide');
                    }).catch(err => {
                        alert(err)
                    })
                }
            },
            onResetFormEditClass() {
                formeditClass = {
                    c_id: '',
                    c_name: ''
                }
            },
            //#endregion Class




            //#region Subject -------------------------------------------------------------
            onLoadSubject(item) {
                this.onResetHeaderList();
                // เก็บ ชั้นปี เพื่อนแสดงรายวิชาในชั้นปีนั้นๆ 
                this.form_subject.c_id = (item.c_id) ? item.c_id : this.form_subject.c_id;
                axios.post('./api/action.php', {
                        action: 'onLoadSubject',
                        c_id: this.form_subject.c_id
                    })
                    .then(response => {
                        this.subjectList = response.data;
                    }).catch(err => {
                        console.log(err)
                    })
            },
            // เมื่อกดปุ่มเพิ่มข้อมูลรายวิชาให้แสดง Modal form สำหรับเก็บข้อมูล 
            onCreateSubject() {
                $('#addSubjectModal').modal('show')
            },
            // เพิ่มข้อมูลรายวิชา
            onSubmitSubject() {
                axios.post('./api/action.php', {
                    c_id: this.form_subject.c_id,
                    subj_code: this.form_subject.subj_code,
                    subj_nameT: this.form_subject.subj_nameT,
                    subj_nameE: this.form_subject.subj_nameE,
                    action: 'createSubject'
                }, ).then(response => {
                    if (response.data.status) {
                        $('#addSubjectModal').modal('hide');
                        this.onResetSubject();
                        this.onLoadSubject(this.form_subject);
                        alertify.success('Inserted');
                    }
                }).catch(err => {
                    alert(err)
                })
            },
            // ลบข้อมูลรายวิชา
            onDeleteSubject(item) {
                // console.log(item)
                if (confirm("ท่านแน่ใจว่าต้องการลบข้อมูล " + item.subj_nameT + "?")) {
                    axios.post('./api/action.php', {
                        subj_id: item.subj_id,
                        action: 'deleteSubject'
                    }).then(response => {
                        this.onLoadSubject(item);
                        alertify.error('Deleted');
                    }).catch(err => {
                        console.log(err)
                    })
                }
            },
            // แสดง Modal สำหรับ แก้ไขข้อมูลรายวิชา
            onEditSubject(item) {
                this.formeditSubject.subj_id = item.subj_id;
                this.formeditSubject.c_id = item.class_no;
                this.formeditSubject.subj_code = item.subj_code;
                this.formeditSubject.subj_nameT = item.subj_nameT;
                this.formeditSubject.subj_nameE = item.subj_nameE;
                $('#editSubjectModal').modal('show');
            },
            // อัพเดตข้อมูลรายวิชา
            onUpdateSubject() {
                if (this.formeditSubject.subj_id && this.formeditSubject.c_id &&
                    this.formeditSubject.subj_code &&
                    this.formeditSubject.subj_nameT && this.formeditSubject.subj_nameE) {
                    axios.post('./api/action.php', {
                        subj_id: this.formeditSubject.subj_id,
                        c_id: this.formeditSubject.c_id,
                        subj_code: this.formeditSubject.subj_code,
                        subj_nameT: this.formeditSubject.subj_nameT,
                        subj_nameE: this.formeditSubject.subj_nameE,
                        action: 'updateSubject'
                    }).then(response => {
                        this.onLoadSubject(this.formeditSubject);
                        this.onResetFormEditSubject();
                        $('#editSubjectModal').modal('hide');
                        alertify.success('Updated');
                    }).catch(err => {
                        alertify.error(err)
                    })
                }
            },
            // รีเซ็ตค่าฟอร์มเพิ่มข้อมูลรายวิชา
            onResetSubject() {
                this.form_subject = {
                    c_id: this.form_subject.c_id,
                    subj_code: '',
                    subj_nameT: '',
                    subj_nameE: ''
                }
            },
            // รีเซ็ตค่าฟอร์มแก้ไขข้อมูลรายวิชา
            onResetFormEditSubject() {
                formeditSubject = {
                    subj_id: '',
                    c_id: '',
                    subj_id: '',
                    subj_nameT: '',
                    subj_nameE: ''
                }
            },
            //#endregion Subject



            //#region Header -------------------------------------------------------------

            // โหลดหัวเรื่องจากรายวิชา
            onLoadHeader(item) {
                this.form_header.subj_id = (item.subj_id) ? item.subj_id : this.form_header.subj_id;
                this.form_header.subj_name = (item.subj_nameT) ? item.subj_nameT + ' (' + item.subj_nameE +
                    ')' :
                    this.form_header.subj_name;
                axios.post('./api/action.php', {
                        action: 'onLoadHeader',
                        subj_id: this.form_header.subj_id
                    })
                    .then(response => {
                        this.headerList = response.data;
                    }).catch(err => {
                        console.log(err)
                    })
            },
            onCreateHeader() {
                $('#addHeaderModal').modal('show')
            },
            onSubmitHeader() {
                this.form_header.head_date = new Date();
                axios.post('./api/action.php', {
                    head_date: this.form_header.head_date,
                    head_teach: this.form_header.head_teach,
                    head_name: this.form_header.head_name,
                    subj_id: this.form_header.subj_id,
                    action: 'createHeader'
                }, ).then(response => {
                    if (response.data.status) {
                        $('#addHeaderModal').modal('hide');
                        this.onResetHeader();
                        this.onLoadHeader(this.form_header);
                        alertify.success('Inserted');
                    }
                }).catch(err => {
                    alert(err)
                })
            },
            onDeleteHeader(item) {
                if (confirm("ท่านแน่ใจว่าต้องการลบข้อมูล " + item.head_name + "?")) {
                    axios.post('./api/action.php', {
                        head_id: item.head_id,
                        action: 'deleteHeader'
                    }).then(response => {
                        this.onLoadHeader(item)
                        alertify.error('Deleted');
                    }).catch(err => {
                        console.log(err)
                    })
                }
            },
            onEditHeader(item) {
                this.formeditHeader.head_date = item.head_date;
                this.formeditHeader.head_id = item.head_id;
                this.formeditHeader.head_teach = item.head_teach;
                this.formeditHeader.head_name = item.head_name;
                $('#editHeaderModal').modal('show');
            },
            onUpdateHeader() {
                if (this.formeditHeader.head_id && this.formeditHeader.head_teach &&
                    this.formeditHeader.head_date && this.formeditHeader.head_name) {
                    axios.post('./api/action.php', {
                        action: 'updateHeader',
                        head_id: this.formeditHeader.head_id,
                        head_date: this.formeditHeader.head_date,
                        head_teach: this.formeditHeader.head_teach,
                        head_name: this.formeditHeader.head_name
                    }).then(response => {
                        this.onLoadHeader(this.formeditHeader);
                        this.onResetFormEditHeader();
                        $('#editHeaderModal').modal('hide');
                        alertify.success('Updated');
                    }).catch(err => {
                        alertify.error(err)
                    })
                }
            },
            onResetHeaderList() {
                this.headerList = [];
            },
            onResetHeader() {
                this.form_header.head_teach = '';
                this.form_header.head_name = '';
            },
            onResetFormEditHeader() {
                formeditHeader = {
                    head_id: '',
                    head_tech: '',
                    head_date: '',
                    head_name: '',
                    subj_name: '',
                    subj_id: '',
                }
            }

            //#enregion
        },
    })
    </script>

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