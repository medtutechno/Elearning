<div class="form-row mt-3">
    <div class="col-md-5">
        <div class="subject">
            <div class="card">
                <div class="card-header">
                    <h6 class="text-cl-title">รายวิชา</h6>
                </div>
                <div class="card-body able-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover table-wrapper-scroll-y pl-0">
                        <tbody class="subj_show">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="header">
            <div class="card">
                <div class="card-header">
                    <h6 class="text-cl-title">ชื่อเรื่อง</h6>
                </div>
                <div class="card-body able-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover table-wrapper-scroll-y pl-0">
                        <tbody class="header_show">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style scoped>
.card {
    border-radius: 7px !important;
    border-color: #ffff !important;
}


.card .card-body {
    padding-top: 15px !important;
    padding-bottom: 15px !important;
}

.card .card-body button {
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    border-radius: 7px !important;
    border: 0.2px solid gray !important;
}

.card-header {
    background-color: white;
    color: black;
    text-align: center;
}

.card-header h6 {
    vertical-align: middle !important;
}

.tr_details {
    cursor: pointer;
}

.my-custom-scrollbar {
    position: relative;
    height: 400px;
    overflow: auto;
}

.table-wrapper-scroll-y {
    display: block;
}

.btn-square-md {
    width: 45px !important;
    max-width: 100% !important;
    max-height: 100% !important;
    height: 45px !important;
    text-align: center;
    padding: 0px;
    font-size: 1.7rem;
}

table {
    font-size: 0.9rem
}
</style>