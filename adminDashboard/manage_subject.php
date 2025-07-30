<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="app">
        <div class="form-row ml-md-3">

            <!-- table class -->
            <div class="col-md-2">
                <div class="card card-secondary" v-if="classList.length > 0">
                    <div class="card-header ">
                        <h3 class="card-title">ชั้นปี</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ชั้นปี</th>
                                    <th width="100px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in classList" :key="item.id">
                                    <td @click="onLoadSubject(item)">{{ item.c_name }}</td>
                                    <td class="text-nowrap">
                                        <button class="btn btn-sm btn-warning" @click="onEditClass(item)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" @click="onDeleteClass(item)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-success float-right m-3" @click="onCerateClass()">
                            <i class="fas fa-plus"></i> เพิ่มชั้นปี
                        </button>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <!-- table subject -->
            <div class="col-md-5">
                <div class="card card-secondary">
                    <div class="card-header ">
                        <h3 class="card-title">รายวิชา</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>รหัสวิชา</th>
                                    <th>ชื่อภาษาไทย</th>
                                    <th>ชื่อภาษาอังกฤษ</th>
                                    <th width="100px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in subjectList" :key="item.subj_id">
                                    <td @click="onLoadHeader(item)">{{ item.subj_code }}</td>
                                    <td @click="onLoadHeader(item)">{{ item.subj_nameT }}</td>
                                    <td @click="onLoadHeader(item)">{{ item.subj_nameE }}</td>
                                    <td class="text-nowrap">
                                        <button class="btn btn-sm btn-warning" @click="onEditSubject(item)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" @click="onDeleteSubject(item)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button v-if="this.form_subject.c_id != ''" class="btn btn-success float-right m-3"
                            @click="onCreateSubject()">
                            <i class="fas fa-plus"></i> เพิ่มรายวิชา
                        </button>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <!-- table header -->
            <div class="col-md-5">
                <div class="card card-secondary">
                    <div class="card-header ">
                        <h3 class="card-title">หัวเรื่อง</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>วันที่</th>
                                    <th>หัวข้อ</th>
                                    <th>ชื่อเรื่อง</th>
                                    <th width="100px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in headerList" :key="item.head_id">
                                    <td>{{ item.head_date }}</td>
                                    <td>{{ item.head_teach }}</td>
                                    <td>{{ item.head_name }}</td>
                                    <td class="text-nowrap">
                                        <button class="btn btn-sm btn-warning" @click="onEditHeader(item)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" @click="onDeleteHeader(item)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button v-if="this.form_header.subj_id != ''" class="btn btn-success float-right m-3"
                            @click="onCreateHeader()">
                            <i class="fas fa-plus"></i> เพิ่มหัวเรื่อง
                        </button>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>


        </div>
        <!-- modal for manage data ( class , subject , header ) -->
        <? include "./modalAction/class.php" ?>
        <? include "./modalAction/subject.php" ?>
        <? include "./modalAction/header.php" ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
                    console.log(this.classList);
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
                    order_show: parseInt(this.classList[this.classList.length - 1]['order_show']) +
                        parseInt(1),
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
                let d = this.form_header.head_date.getDate();
                (d < 10) ? d = '0' + d: d = d;
                let m = this.form_header.head_date.getMonth();
                let y = this.form_header.head_date.getFullYear();
                this.form_header.head_date = y + '-' + m + '-' + d;
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