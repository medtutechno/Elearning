<div id="player_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color:black">
            <div class="modal-header justify-content-center" style="background-color:black;color:white">
                <h5>Video Title : <span class="v_title"></span></h5>
            </div>
            <div class="modal-body">
                <video id="my-video" class="video-js vjs-default-skin vjs-16-9" controls preload="auto"
                    data-setup='{ "playbackRates": [0.5, 1, 1.5, 2] }'>
                </video>
                <div hidden>
                    <div id="user_visitor">
                        <b>USER VISITOR : <span style="color:blue"><?= $_SESSION['user'];?></span></b>
                    </div>
                    <div>
                        <b>VIDEO ID : <span id="v_id"></span> </b>
                    </div>
                    <div id="v_name">
                        <b>FILENAME : </b>
                    </div>
                    <div>
                        <b>CURRENT TIME (MINUTE) : <span id="currentTime" style='color:blue;'></span></b>
                    </div>
                    <div id="v_lastview">
                        <b>LAST VISITED : </b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style scoped>
@media only screen and (max-width: 1000px) {
    .video-js {
        width: 400px
    }
}

.modal-dialog {
    max-width: 1024px;
    margin: 30px auto;
}

.modal-body {
    position: relative;
    padding: 0px;
}

.close {
    position: absolute;
    right: -30px;
    top: 0;
    z-index: 999;
    font-size: 2rem;
    font-weight: normal;
    color: #fff;
    opacity: 1;
}
</style>