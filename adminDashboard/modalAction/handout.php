<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Handout</title>
</head>

<body>
    <!-- add handout -->
    <div id="app_handouts">
        <div class="modal fade" id="addHandOutModal" tabindex="-1" aria-labelledby="addHandOutModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div v-if="successAlert" class="alert alert-success alert-dismissible mb-2">
                                <a href="#" class="close" aria-label="close" @click="successAlert=false">&times;</a>
                                {{ successMessage }}
                            </div>
                            <div v-if="errorAlert" class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" aria-label="close" @click="errorAlert=false">&times;</a>
                                {{ errorMessage }}
                            </div>
                        </div>
                        <!-- content -->
                        <div class="form-group">
                            <label for="">ชื่อ Handouts</label>
                            <input type="text" class="form-control form-control-sm" v-model="fileHandout_title">
                        </div>


                        <!-- file upload -->
                        <div class="from-group">
                            <div class="input-group form-row mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" ref="fileHandout" class="custom-file-input"
                                        aria-describedby="inputGroupFileAddon01" @change="onChangedFileHandout()">
                                    <label class="custom-file-label" for="inputGroupFile01"> {{ nameFile }} </label>
                                </div>

                            </div>
                            <div class="progress mb-2" style="height:10px;">
                                <div class="progress-bar bg-success" :style="{ width:uploadPercentage + '%' }">
                                    {{ uploadPercentage }} %
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary btn-block" @click="upLoadHandout()">Upload
                                Handout
                            </button>
                            <hr />
                        </div>

                        <div class="form-group">
                            <h6 style="font-size:1rem">
                                คำแนะนำในการตั้งชื่อไฟล์ <br>
                                - หากเป็น handout จากไฟล์ powerpoint : ชื่อเรื่อง (Handout) - ปี พ.ศ.<br>
                                - หากเป็นเอกสารที่มีเนื้อหา : ชื่อเรื่อง (เอกสารประกอบการสอน) - ปี พ.ศ.
                            </h6>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>