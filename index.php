<?
    session_start();
    print_r($_SESSION);
    if(isset($_SESSION['user'])){
        if($_SESSION['roll'] == '1'){
            header('Location: ./adminDashboard/');
        }else{
            header('Location: ./main.php');
        }
    }else{
        header('Location:login.php');
    }
?>