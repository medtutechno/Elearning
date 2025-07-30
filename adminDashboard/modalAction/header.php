   <!-- Add Class Modal -->
   <div class="modal fade" id="addHeaderModal">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">เพิ่มข้อมูลหัวเรื่อง</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form class="modal-body" @submit.prevent="onSubmitHeader()">
                   <div class="form-group">
                       <label>รายวิชา</label>
                       <input type="text" class="form-control form-control-sm" :value="form_header.subj_name" readonly>
                   </div>
                   <div class="form-group">
                       <label>หัวเรื่อง</label>
                       <input type="text" class="form-control form-control-sm" v-model="form_header.head_teach">
                   </div>
                   <div class="form-group">
                       <label>ชื่อหัวเรื่อง</label>
                       <input type="text" class="form-control form-control-sm" v-model="form_header.head_name">
                   </div>
                   <button type="submit" class="btn btn-success float-right">บันทึก</button>
               </form>
           </div>
       </div>
   </div>

   <!-- Edit Class Modal -->
   <div class="modal fade" id="editHeaderModal">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">แก้ไขข้อมูล</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form class="modal-body" @submit.prevent="onUpdateHeader()">
                   <div class="form-group">
                       <input type="text" class="form-control form-control-sm" v-model="formeditHeader.head_id" hidden>
                   </div>
                   <div class="form-group">
                       <label>วันที่</label>
                       <input type="date" class="form-control form-control-sm" :value="formeditHeader.head_date"
                           readonly>
                   </div>
                   <div class="form-group">
                       <label>หัวข้อ</label>
                       <input type="text" class="form-control form-control-sm" v-model="formeditHeader.head_teach">
                   </div>
                   <div class="form-group">
                       <label>ชื่อหัวเรื่อง</label>
                       <input type="text" class="form-control form-control-sm" v-model="formeditHeader.head_name">
                   </div>
                   <button type="submit" class="btn btn-success float-right">อัพเดต</button>
               </form>
           </div>
       </div>
   </div>