<!-- add video -->
<div class="modal fade" id="addVideoModal" tabindex="-1" aria-labelledby="addVideoModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มวิดีโอ</h5>
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
                <div class="form-group" hidden>
                    <label for="">หัวเรื่อง</label>
                    <input type="text" v-model="search.head_id" class="form-control form-control-sm" readonly>
                </div>
                <div class="form-group">
                    <label for="">ชื่อวิดีโอ</label>
                    <input type="text" v-model="file_title" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <select class="form-control form-control-sm" v-model="languege">
                        <option value="">เลือกภาษา</option>
                        <option value="1">ภาษาไทย</option>
                        <option value="2">ภาษาอังกฤษ</option>
                    </select>
                </div>

                <!-- file upload -->
                <div class="from-group">
                    <div class="input-group form-row mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" ref="file" class="custom-file-input"
                                aria-describedby="inputGroupFileAddon01" @change="onChangedFile()">
                            <label class="custom-file-label" for="inputGroupFile01">{{ nameFile }}</label>
                        </div>

                    </div>
                    <div class="progress mb-2" style="height:10px;">
                        <div class="progress-bar bg-success" :style="{ width:uploadPercentage + '%' }">
                            {{ uploadPercentage }} %
                        </div>
                    </div>

                    <button type="button" @click="upLoadVideo()" class="btn btn-primary btn-block">Upload
                        Video
                    </button>
                    <hr />
                </div>

                <div class="form-group">
                    <h6 style="font-size:1rem">
                        คำแนะนำการตั้งชื่อไฟล์<br>
                        -วิดีโอภาษาไทย : ปี พ.ศ. (ตอนที่/จำนวนตอนทั้งหมด)<br>
                        -วิดีโอภาษาอังกฤษ : ปี ค.ศ. (ตอนที่/จำนวนตอนทั้งหมด)
                    </h6>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- edit video -->
<div class="modal fade" id="editVideoModal" tabindex="-1" aria-labelledby="editVideoModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไขวิดีโอ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div v-if="successAlert" class="alert alert-success alert-dismissible">
                        <a href="#" class="close" aria-label="close" @click="successAlert=false">&times;</a>
                        {{ successMessage }}
                    </div>
                </div>
                <div class="form-group">
                    <div v-if="errorAlert" class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" aria-label="close" @click="errorAlert=false">&times;</a>
                        {{ errorMessage }}
                    </div>
                </div>
                <!-- content -->
                <div class="form-group">
                    <label for="">ชื่อวิดีโอ</label>
                    <input type="text" class="form-control form-control-sm" v-model="fileEdit_title">
                </div>
                <div class="form-group">
                    <select class="form-control form-control-sm" v-model="languegeEdit">
                        <option value="">เลือกภาษา</option>
                        <option value="1">ภาษาไทย</option>
                        <option value="2">ภาษาอังกฤษ</option>
                    </select>
                </div>

                <!-- file upload -->
                <div class="from-group">
                    <div class="input-group form-row mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Edit</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" ref="fileEdit" class="custom-file-input"
                                aria-describedby="inputGroupFileAddon01" @change="onChangedFileEdit()">
                            <label class="custom-file-label" for="inputGroupFile01">{{ nameFileEdit }}</label>
                        </div>

                    </div>
                    <video ref="videoPlayer" class="video-js mb-2" width="376.38px" height="auto"></video>
                    <button type="button" @click="upDateVideo()" class="btn btn-primary btn-block">Update
                    </button>
                    <br />
                </div>
            </div>
        </div>
    </div>
</div>

<!-- preview video-->
<div class="modal fade" id="previewVideoModal" tabindex="-1" aria-labelledby="previewVideoModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ตัวอย่างวิดีโอ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mb-3">
                <video ref="videoPlayer" class="video-js mb-2" width="376.38px" height="auto"></video>
            </div>
        </div>
    </div>
</div>