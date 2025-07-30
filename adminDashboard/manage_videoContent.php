<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage video</title>

    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />
</head>

<body>
    <div id="app_video">
        <div class="container">
            <!-- ค้นหา Videos และ Handouts ตามหัวข้อที่เลือก -->
            <form @submit.prevent="onSearch()">
                <div class="alert alert-danger alert-dismissible fade show" v-if="errors.length>0">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Warning!</strong> {{ errors[0] }}
                </div>
                <div class="form-row">
                    <div class="col-md-2">
                        <select class="form-control form-control-sm" @change="onLoadSubject($event)"
                            v-model="search.class_id">
                            <option value="">เลือกชั้นปี</option>
                            <option v-for="item in classList" :key="item.c_id" :value="item.c_id">{{ item.c_name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control form-control-sm" @change="onLoadHeader($event)"
                            v-model="search.subj_id">
                            <option value="" selected>เลือกรายวิชา</option>
                            <option v-for="item in subjectList" :key="item.subj_id" :value="item.subj_id">
                                {{ item.subj_code }} {{ item.subj_nameT }} ( {{ item.subj_nameE }} )
                            </option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control form-control-sm" v-model="search.head_id">
                            <option value="">เลือกหัวเรื่อง</option>
                            <option v-for="item in headerList" :key="item.head_id" :value="item.head_id">
                                {{ item.head_name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-info btn-sm">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <hr>

            <div class="card card-secondary mb-2">
                <div class="card-header">
                    <h3 class="card-title">Video File</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered mb-2" v-if="video_list.length>0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Filename</th>
                                <th>Language</th>
                                <th>Upload by</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in video_list" :key="item.v_id">
                                <td>{{ item.v_id }}</td>
                                <td>{{ item.v_title }}</td>
                                <td>{{ item.v_filename }}</td>
                                <td v-if="item.v_type == '1'">ภาษาไทย</td>
                                <td v-else-if="item.v_type == '2'">English</td>
                                <td v-else></td>
                                <td>{{ item.user_upload }}</td>

                                <td class="text-nowrap text-center">

                                    <!-- edit processing... -->
                                    <!-- <button class="btn btn-sm btn-warning" @click="onEditVideo(item)">
                                        <i class="fa fa-edit"></i>
                                    </button> -->
                                    <button class="btn btn-sm btn-info" @click="onPreviewVideo(item)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" @click="onDeleteVideo(item)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button v-if="btn_state" class="btn btn-success float-right"
                        @click="onCreateVideo()">เพิ่มวิดีโอ</button>
                </div>
            </div>
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Pdf File</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered mb-2" v-if="pdf_list.length > 0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Filename</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in pdf_list" :key="item.p_id">
                                <td>{{ item.p_id }}</td>
                                <td>{{ item.p_title }}</td>
                                <td>{{ item.p_filename }}</td>
                                <td class="text-nowrap text-center">
                                    <!-- edit processing ...      -->
                                    <!-- <button class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </button> -->
                                    <button class="btn btn-sm btn-info" @click="onPreviewHandout(item)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" @click="onDeleteHandout(item)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-success float-right" v-if="btn_state" @click="onCreateHandOut()">เพิ่ม
                        PDF</button>
                </div>
            </div>
        </div>
        <? include "./modalAction/video.php"; ?>
        <? include "./modalAction/handout.php"; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>


    <script>
    const app_video = new Vue({
        el: '#app_video',
        data: {
            // content show 
            classList: [],
            subjectList: [],
            headerList: [],
            errors: [],
            video_list: [],
            pdf_list: [],
            search: {
                class_id: '',
                subj_id: '',
                head_id: '',
            },
            btn_state: false,

            // video add
            file: '',
            file_title: '',
            nameFile: 'Choose File',
            successAlert: false,
            errorAlert: false,
            uploadedImage: '',
            errorMessage: 'Error Message',
            successMessage: 'Success Message',
            languege: '',
            fileNameSuccess: '',
            uploadPercentage: 0,

            // video edit 
            fileEdit_title: '',
            nameFileEdit: 'Choose File',
            languegeEdit: '',

            // video player
            player: null,
            videoOptions: {
                autoplay: false,
                controls: true,
                sources: [{
                    src: "../video/test.mp4",
                    type: "video/mp4"
                }]
            },

            // Handout
            fileHandout: '',
            fileHandout_title: ''

        },
        mounted() {
            this.initialLoadClass();
            this.initialSetupVideo();
        },
        methods: {
            // เช็คว่ามีการเลือก ชั้นปี รายวิชา และหัวเรื่อง เพื่อ search เรียกดูวิดีโอ
            checkForm: function(e) {
                if (this.search.class_id && this.search.subj_id && this.search.head_id) {
                    if (this.errors.length > 0)
                        this.errors.pop();
                    return true;
                } else {
                    this.errors.push('กรุณาเลือกข้อมูลในการค้นหาให้ครบ')
                    return false;
                }
            },
            // โหลดชั้นปีทั้งหมด 
            initialLoadClass() {
                axios.post('./api/action.php', {
                    action: 'initialLoadClass'
                }).then(response => {
                    this.classList = response.data;
                }).catch(error => {
                    console.log(error)
                })
            },
            initialSetupVideo() {
                this.player = videojs(this.$refs.videoPlayer, this.videoOptions)
            },
            // โหลดรายวิชาจากการเลือกชั้นปี
            onLoadSubject(e) {
                c_id = e.target.value;
                if (c_id) {
                    axios.post('./api/action.php', {
                        action: 'onLoadSubject',
                        c_id: c_id
                    }).then(response => {
                        this.subjectList = response.data
                    }).catch(error => {
                        console.log(error)
                    })
                }
            },
            // โหลดหัวเรื่องจากการเลือกรายวิชา
            onLoadHeader(e) {
                subj_id = e.target.value;
                if (subj_id) {
                    axios.post('./api/action.php', {
                        action: 'onLoadHeader',
                        subj_id: subj_id
                    }).then(response => {
                        this.headerList = response.data
                    }).catch(error => {
                        console.log(error)
                    })
                }
            },
            // ค้นหา List video และ List pdf ทั้งหมดของหัวเรื่องที่เลือก 
            onSearch() {
                this.video_list = [];
                this.pdf_list = [];
                if (this.checkForm()) {
                    console.log('%c onSearch Clicked', 'background: #222; color: #bada55')
                    console.log('ชั้นปี/รายวิชา/หัวเรื่อง', this.search)
                    axios.post('./api/action.php', {
                            action: 'onLoadVideoAndPdfList',
                            head_id: this.search.head_id
                        })
                        .then(response => {
                            if (response.data.video.length > 0) this.video_list = response.data.video;
                            if (response.data.pdf.length > 0) this.pdf_list = response.data.pdf;
                            this.btn_state = true;
                            console.log('%c Videos And Handouts :', 'background: #222; color: #bada55')
                            console.log({
                                'video': this.video_list
                            }, {
                                'pdf': this.pdf_list
                            })
                        })
                        .catch(error => {
                            console.log(error)
                        })
                }
            },
            // แสดง Modal สำหรับการอัพโหลดวิดีโอ 
            onCreateVideo() {
                $('#addVideoModal').modal('show');
            },
            // เปลี่ยน Label ให้เป็นชื่อไฟล์ที่อัพโหลด
            onChangedFile() {
                this.file = this.$refs.file.files[0];
                this.nameFile = this.file.name;
            },
            onChangedFileEdit() {
                this.file = this.$refs.fileEdit.files[0];
                this.nameFileEdit = this.file.name;

            },

            checkFormUploadVideo: function() {
                if (this.file && this.file_title && this.languege) return true;
                else return false
            },
            upLoadVideo() {
                if (this.checkFormUploadVideo()) {
                    var formData = new FormData();
                    formData.append('file', this.file);
                    formData.append('head_id', this.search.head_id);
                    formData.append('languege', this.languege);
                    axios.post('./api/uploadVideo.php', formData, {
                        header: {
                            'Content-Type': 'multipart/form-data'
                        },
                        onUploadProgress: function(progressEvent) {
                            this.uploadPercentage = parseInt(Math.round((progressEvent.loaded /
                                progressEvent.total) * 100));
                        }.bind(this)
                    }).then(function(response) {
                        if (response.data.image == '') {
                            app_video.errorAlert = true;
                            app_video.successAlert = false;
                            app_video.errorMessage = response.data.message;
                            app_video.successMessage = '';
                            app_video.uploadedImage = '';
                        } else {
                            app_video.errorAlert = false;
                            app_video.successAlert = true;
                            app_video.errorMessage = '';
                            app_video.onSuccesUploadVideoFile(response);
                        }
                    });
                } else {
                    app_video.errorAlert = true;
                    app_video.successAlert = false;
                    app_video.errorMessage = "กรุณากรอกข้อมูลให้ครบ";
                    app_video.successMessage = '';
                    app_video.uploadedImage = '';
                }
            },
            // บันทึกข้อมูลวิดีโอลงฐานข้อมูลหลังจากอัพโหลดวิดีโอไปยังโฟลเดอร์เรียบร้อย 
            onSuccesUploadVideoFile(response) {
                app_video.successMessage = (response.data.message) ? response.data.message :
                    'Success Message';
                app_video.$refs.file.value = '';
                app_video.nameFile = 'Choose File';
                app_video.fileNameSuccess = response.data.fileNameSuccess;

                let data = {
                    _head_id: this.search.head_id,
                    v_filename: this.fileNameSuccess,
                    v_type: this.languege,
                    v_title: this.file_title
                }

                axios.post('./api/action.php', {
                        action: 'onSuccessUploadVideoFile',
                        _head_id: data._head_id,
                        v_filename: data.v_filename,
                        v_type: data.v_type,
                        v_title: data.v_title
                    })
                    .then(response => {
                        app_video.file = '';
                        app_video.file_title = '';
                        app_video.languege = '';
                        app_video.onSearch();
                    })
                    .then(res => {
                        setTimeout(() => {
                            app_video.successAlert = false;
                            app_video.uploadPercentage = 0;
                        }, 10000);
                    })
            },
            onDeleteVideo(item) {
                alertify.confirm(`ต้องการลบข้อมูล <span style = "color:red">${item.v_title}</span> ?`,
                    function() {
                        if (item) {
                            axios.post('./api/action.php', {
                                    action: "onDeleteVideo",
                                    v_id: item.v_id,
                                    v_filename: item.v_filename,
                                    v_type: item.v_type,
                                    _head_id: item._head_id
                                })
                                .then(response => {
                                    app_video.onSearch();
                                    window.scrollTo(0, 0);
                                    alertify.success(response.data.message);
                                })
                                .catch(err => console.log(err))
                        }
                    }).set({
                    title: 'Warning Delete !'
                });

            },
            onPreviewVideo(item) {
                console.log('preview clicked')
                console.log(item)
                let type = item.v_type == '1' ? "TH" : "EN";
                let src = `../uploads/header/${item._head_id}/video/${type}/${item.v_filename}#t=2`;
                // Update source:
                this.player.src({
                    src: src,
                    type: 'video/mp4'
                });

                $('#previewVideoModal').modal('show');
            },
            onEditVideo(item) {
                let type = item.v_type == '1' ? "TH" : "EN";
                let src = `../uploads/header/${item._head_id}/video/${type}/${item.v_filename}#t=2`;
                // Update source:
                this.player.src({
                    src: src,
                    type: 'video/mp4'
                });

                $('#editVideoModal').modal('show');
            },
            onUpdateVideo() {
                if (this.checkFormUploadVideo()) {
                    var formData = new FormData();
                    formData.append('file', this.file);
                    formData.append('head_id', this.search.head_id);
                    formData.append('languege', this.languege);
                    axios.post('./api/upload.php',
                        formData, {
                            header: {
                                'Content-Type': 'multipart/form-data'
                            },
                        }).then(function(response) {
                        if (response.data.image == '') {
                            app_video.errorAlert = true;
                            app_video.successAlert = false;
                            app_video.errorMessage = response.data.message;
                            app_video.successMessage = '';
                            app_video.uploadedImage = '';
                        } else {
                            app_video.errorAlert = false;
                            app_video.successAlert = true;
                            app_video.errorMessage = '';
                            app_video.onSuccesUploadVideoFile(response);
                        }
                    });
                } else {
                    app_video.errorAlert = true;
                    app_video.successAlert = false;
                    app_video.errorMessage = "กรุณากรอกข้อมูลให้ครบ";
                    app_video.successMessage = '';
                    app_video.uploadedImage = '';
                }
            },

            // Handouts 
            UrlExists(url, cb) {
                $.ajax({
                    url: url,
                    dataType: 'text',
                    type: 'GET',
                    complete: function(xhr) {
                        if (typeof cb === 'function')
                            cb.apply(this, [xhr.status]);
                    }
                });
            },
            onPreviewHandout(item) {
                let url = `../uploads/header/${item._head_id}/handouts/${item.p_filename}`;
                this.UrlExists(url, function(status) {
                    if (status === 200) {
                        // file was found
                        window.open(url)
                    } else if (status === 404) {
                        // 404 not found
                        alertify.error('File Not Fount');
                    }
                });
            },
            onCreateHandOut() {
                $('#addHandOutModal').modal('show');
            },
            checkFormUploadHandout: function() {
                if (this.fileHandout && this.fileHandout_title) return true;
                else return false
            },
            onChangedFileHandout() {
                this.fileHandout = this.$refs.fileHandout.files[0];
                this.nameFile = this.fileHandout.name;
            },
            upLoadHandout() {
                if (this.checkFormUploadHandout()) {
                    let formData = new FormData();
                    formData.append('file', this.fileHandout);
                    formData.append('head_id', this.search.head_id);
                    axios.post('./api/uploadHandout.php', formData, {
                        header: {
                            'Content-Type': 'multipart/form-data'
                        },
                        onUploadProgress: function(progressEvent) {
                            this.uploadPercentage = parseInt(Math.round((progressEvent.loaded /
                                progressEvent.total) * 100));
                        }.bind(this)
                    }).then(function(response) {
                        if (response.data.image == '') {
                            app_video.errorAlert = true;
                            app_video.successAlert = false;
                            app_video.errorMessage = response.data.message;
                            app_video.successMessage = '';
                            app_video.uploadedImage = '';
                        } else {
                            app_video.errorAlert = false;
                            app_video.successAlert = true;
                            app_video.errorMessage = '';
                            app_video.onSuccesUploadHandout(response);
                        }
                    });
                } else {
                    app_video.errorAlert = true;
                    app_video.successAlert = false;
                    app_video.errorMessage = "กรุณากรอกข้อมูลให้ครบ";
                    app_video.successMessage = '';
                    app_video.uploadedImage = '';
                }
            },
            onSuccesUploadHandout(response) {
                app_video.successMessage = (response.data.message) ? response.data.message :
                    'Success Message';
                app_video.$refs.file.value = '';
                app_video.nameFile = 'Choose File';
                app_video.fileNameSuccess = response.data.fileNameSuccess;

                let data = {
                    _head_id: this.search.head_id,
                    p_filename: this.fileNameSuccess,
                    p_title: this.fileHandout_title
                }

                axios.post('./api/action.php', {
                        action: 'onSuccessUploadHandout',
                        _head_id: data._head_id,
                        p_filename: data.p_filename,
                        p_title: data.p_title
                    })
                    .then(response => {
                        app_video.fileHandout = '';
                        app_video.fileHandout_title = '';
                        app_video.onSearch();
                    })
                    .then(res => {
                        setTimeout(() => {
                            app_video.successAlert = false;
                            app_video.uploadPercentage = 0;
                        }, 10000);
                    })
            },
            onDeleteHandout(item) {
                alertify.confirm(`ต้องการลบข้อมูล <span style = "color:red">${item.p_title}</span> ?`,
                    function() {
                        if (item) {
                            axios.post('./api/action.php', {
                                    action: "onDeleteHandout",
                                    p_id: item.p_id,
                                    p_filename: item.p_filename,
                                    _head_id: item._head_id
                                })
                                .then(response => {
                                    app_video.onSearch();
                                    window.scrollTo(0, 0);
                                    alertify.success(response.data.message);
                                })
                                .catch(err => console.log(err))
                        }
                    }).set({
                    title: 'Warning Delete !'
                });

            },

        }
    })
    </script>
</body>

</html>


<style scoped>
.form-control,
.form-control-sm,
.input-group-text,
.custom-file-label,
.alert {
    border-radius: 0px;
}

.errorsMessage {
    color: red;
    font-size: 0.8rem;
}

.input-group {
    margin: 0px;
}

select {
    cursor: pointer;
}
</style>