   <!-- Add Class Modal -->
   <div class="modal fade" id="addClassModal">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">เพิ่มข้อมูลชั้นปี</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form class="modal-body" @submit.prevent="onSubmitClass()">
                   <div class="form-group">
                       <label for="inp_class">ชั้นปี</label>
                       <input type="text" name="inp_class" class="form-control form-control-sm"
                           v-model="form_Class.c_name" required />
                   </div>
                   <button type="submit" class="btn btn-success float-right">บันทึก</button>
               </form>
           </div>
       </div>
   </div>
   <!-- Edit Class Modal -->
   <div class="modal fade" id="editClassModal">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">แก้ไขข้อมูล</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form class="modal-body" @submit.prevent="onUpdateClass()">
                   <div class="form-group">
                       <input type="text" v-model="formeditClass.c_id" hidden>
                       <label for="">ชั้นปี</label>
                       <input type="text" name="inp_class_edit" class="form-control form-control-sm"
                           v-model="formeditClass.c_name" required />
                   </div>
                   <button type="submit" class="btn btn-success float-right">อัพเดต</button>
               </form>
           </div>
       </div>
   </div>