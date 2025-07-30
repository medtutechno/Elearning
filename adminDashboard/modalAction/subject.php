   <!-- Add Class Modal -->
   <div class="modal fade" id="addSubjectModal">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">เพิ่มข้อมูลรายวิชา</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form class="modal-body" @submit.prevent="onSubmitSubject()">
                   <div class="form-group">
                       <label for="inp_classForSubject">เลือกชั้นปี</label>
                       <select name="inp_classForSubject" class="form-control form-control-sm"
                           v-model="form_subject.c_id">
                           <option v-for="item in classList" :key="item.c_id" :value="item.c_id">{{ item.c_name }}
                           </option>
                       </select>
                   </div>
                   <div class="form-group">
                       <label for="subj_code">รหัสวิชา</label>
                       <input type="text" class="form-control form-control-sm" name="subj_code"
                           v-model="form_subject.subj_code">

                   </div>
                   <div class="form-group">
                       <label for="subj_nameT">ชื่อภาษาไทย</label>
                       <input type="text" class="form-control form-control-sm" name="subj_nameT"
                           v-model="form_subject.subj_nameT">
                   </div>
                   <div class="form-group">
                       <label for="subj_nameE">ชื่อภาษาอังกฤษ</label>
                       <input type="text" class="form-control form-control-sm" name="subj_nameE"
                           v-model="form_subject.subj_nameE">
                   </div>
                   <button type="submit" class="btn btn-success float-right">บันทึก</button>
               </form>
           </div>
       </div>
   </div>
   <!-- Edit Class Modal -->
   <div class="modal fade" id="editSubjectModal">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">แก้ไขข้อมูล</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form class="modal-body" @submit.prevent="onUpdateSubject()">
                   <div class="form-group">
                       <input type="text" class="form-control form-control-sm" v-model="formeditSubject.subj_id" hidden>
                       <input type="text" class="form-control form-control-sm" v-model="formeditSubject.c_id" hidden>
                   </div>
                   <div class="form-group">
                       <label for="subj_code">รหัสวิชา</label>
                       <input type="text" class="form-control form-control-sm" v-model="formeditSubject.subj_code">

                   </div>
                   <div class="form-group">
                       <label for="subj_nameT">ชื่อภาษาไทย</label>
                       <input type="text" class="form-control form-control-sm" v-model="formeditSubject.subj_nameT">
                   </div>
                   <div class="form-group">
                       <label for="subj_nameE">ชื่อภาษาอังกฤษ</label>
                       <input type="text" class="form-control form-control-sm" v-model="formeditSubject.subj_nameE">
                   </div>
                   <button type="submit" class="btn btn-success float-right">อัพเดต</button>
               </form>
           </div>
       </div>
   </div>