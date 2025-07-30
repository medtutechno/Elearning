<?
header("Content-type: application/json; charset=utf-8");
include "../build/config/connect.php";
session_start();
$medcode = $_REQUEST['medcode'];
$topic = $_REQUEST['topic'];
$save = new DB_con();
if($medcode != ''){
    if($topic == "login"){
        $sql = "INSERT INTO log_login(medcode,log_status) VALUES('$medcode','I')";
    }else{
        $sql = "INSERT INTO log_login(medcode,log_status) VALUES('$medcode','O')";
        session_destroy();
        header('Location: ../');
    }
    
    if($save->fetch_data($sql)){
        echo "1";
    }else{
        echo "0";
    }
}else{
    echo "0";
}


?>