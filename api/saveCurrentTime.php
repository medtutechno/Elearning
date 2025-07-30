<?
header("Content-type: application/json; charset=utf-8");

include "../build/config/connect.php";
$save = new DB_con();
$topic = $_POST['topic'];
$result = array();

if($topic == 'saveCurrentVideoTime'){
    $data = $_POST['dataAll'];
    $currentTime = $data['currentTime'];
    $medcode = $data['medcode'];
    $v_id = $data['v_id'];
    $_head_id = $data['_head_id'];
    $current_percent = $data['current_percent'];

    $sql = "INSERT INTO log_view(medcode , _header_id,v_id,current_secTime,current_percent) VALUES('$medcode','$_head_id','$v_id' , '$currentTime','$current_percent')";
    if($save->fetch_data($sql)){
        echo '1';
    }else{
        echo '0';
    }
    
}
?>