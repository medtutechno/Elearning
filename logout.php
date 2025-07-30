<?
session_start();
$medcode = $_SESSION['user'];
header("Location: ./api/saveLog.php?topic=logout&medcode=$medcode");
?>