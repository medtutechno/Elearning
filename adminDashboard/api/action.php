<?
include "./database.php";

$received_data = json_decode(file_get_contents("php://input"));


#region class
if($received_data->action == 'initialLoadClass'){
    $fetch_class = new DB_con();
    $result = array();
    $result = $fetch_class->initialLoadClass()  ;
}
if($received_data->action == 'createClass'){
    $c_name = $received_data->c_name;
    $order_show = $received_data->order_show;
    $create_class = new DB_con();
    if($c_name && $create_class->createClass($c_name,$order_show)){
        $result = array(
            "message" => "Inserted",
            "status" => true 
        );
    }else{
        $result = array(
            "message" => "Can't Insert This Data",
            "status" => false 
        );
    }
}
if($received_data->action == 'deleteClass'){
    $delete_class = new DB_con();
    if($delete_class->deleteClass($received_data->c_id)){
        $result = array(
            "message" => "Deleted",
            "status" => true 
        );
    }else{
        $result = array(
            "message" => "Can't Insert This Data",
            "status" => false 
        );
    }
}
if($received_data->action == 'updateClass'){
    $update = new DB_con();
    
    $c_id = $received_data->c_id ? $received_data->c_id : 'c_id is invalid';
    $c_name = $received_data->c_name ? $received_data->c_name : 'c_name is invalid';
    
    if(($c_id && $c_name) && $update->updateClass($c_id,$c_name)){
        $result = array(
            "message" => "Updated",
            "status" => true 
        );
    }else{
        $result = array(
            "message" => "Can't Update err : " . $update->updateClass($c_id,$c_name),
            "status" => true 
        );
    }
}
#endregion


#region Subject
if($received_data->action == 'onLoadSubject'){
    if($received_data->c_id){
        $c_id = $received_data->c_id;
        $loadSubject = new DB_con();
        $result = array();
        $result = $loadSubject->onLoadSubject($c_id);
    }
}
if($received_data->action == 'createSubject'){
    $c_id = $received_data->c_id;
    $subj_code = $received_data->subj_code;
    $subj_nameT = $received_data->subj_nameT;
    $subj_nameE = $received_data->subj_nameE;
    $create_subject = new DB_con();
    if(($c_id && $subj_code && $subj_nameT && $subj_nameE) && $create_subject->createSubject($c_id,$subj_code,$subj_nameT,$subj_nameE)){
        $result = array(
            "message" => "Inserted",
            "status" => true 
        );
    }else{
        $result = array(
            "message" => "Can't Insert This Data",
            "status" => false 
        );
    }
    
}
if($received_data->action == 'deleteSubject'){
    $delete_subject = new DB_con();
    if( $received_data->subj_id && $delete_subject->deleteSubject($received_data->subj_id)){
        $result = array(
            "message" => "Deleted",
            "status" => true 
        );
    }else{
        $result = array(
            "message" => "Can't Delete This Data",
            "status" => false 
        );
    }
}
if($received_data->action == 'updateSubject'){
    $update = new DB_con();
    $subj_id = $received_data->subj_id ? $received_data->subj_id : 'subj_id is invalid';
    $c_id = $received_data->c_id ? $received_data->c_id : 'c_id is invalid';
    $subj_code = $received_data->subj_code ? $received_data->subj_code : 'subj_code is invalid';
    $subj_nameT = $received_data->subj_nameT ? $received_data->subj_nameT : 'subj_nameT is invalid';
    $subj_nameE = $received_data->subj_nameE ? $received_data->subj_nameE : 'subj_nameE is invalid';
    
    if(($subj_id && $c_id && $subj_code && $subj_nameT && $subj_nameE) 
        && 
        $update->updateSubject($subj_id,$c_id,$subj_code,$subj_nameT,$subj_nameE)){
        $result = array(
            "message" => "Updated",
            "status" => true 
        );
    }else{
        $result = array(
            "message" => "Can't Update err : " . $update->updateSubject($subj_id,$c_id,$subj_code,$subj_nameT,$subj_nameE),
            "status" => true 
        );
    }
}
#endregion


#region Header
if($received_data->action == 'onLoadHeader'){
    $subj_id = $received_data->subj_id;
    $loadHeader = new DB_con();
    $result = array();
    $result = $loadHeader->onLoadHeader($subj_id);
}
if($received_data->action == 'createHeader'){
    $head_date = $received_data->head_date;
    $head_teach = $received_data->head_teach;
    $head_name = $received_data->head_name;
    $subj_id = $received_data->subj_id;

    $create_Header = new DB_con();
    // $result[] = $create_Header->createHeader($head_date,$head_teach,$head_name,$subj_id);
    if(($head_date && $head_teach && $head_name && $subj_id) && $create_Header->createHeader($head_date,$head_teach,$head_name,$subj_id)){
        $result = array(
            "message" => "Inserted",
            "status" => true 
        );
    }else{
        $result = array(
            "message" => "Can't Insert This Data",
            "status" => false 
        );
    }
    
}
if($received_data->action == 'deleteHeader'){
    $delete_header = new DB_con();
    if( $received_data->head_id && $delete_header->deleteHeader($received_data->head_id)){
        $result = array(
            "message" => "Deleted",
            "status" => true 
        );
    }else{
        $result = array(
            "message" => "Can't Delete This Data",
            "status" => false 
        );
    }
}
if($received_data->action == 'updateHeader'){
    $update = new DB_con();
    $head_id = $received_data->head_id ? $received_data->head_id : 'head_id is invalid';
    $head_date = $received_data->head_date ? $received_data->head_date : 'head_date is invalid';
    $head_teach = $received_data->head_teach ? $received_data->head_teach : 'head_teach is invalid';
    $head_name = $received_data->head_name ? $received_data->head_name : 'head_name is invalid';
    
    if(($head_id && $head_date && $head_teach && $head_name) && 
        $update->updateHeader($head_id,$head_date,$head_teach,$head_name)){
        $result = array(
            "message" => "Updated",
            "status" => true 
        );
    }else{
        $result = array(
            "message" => "Can't Update err : " . $update->updateHeader($head_id,$head_date,$head_teach,$head_name),
            "status" => false 
        );
    }
}
#endregion

#region Video
if ($received_data->action == "onLoadVideoAndPdfList"){
    $head_id = $received_data->head_id;
    $loadVideoList = new DB_con();
    $result = array();
    $result['video'] = $loadVideoList->onLoadVideoList($head_id);
    $result['pdf'] = $loadVideoList->onLoadPdfList($head_id);
}
if ($received_data->action == "onSuccessUploadVideoFile"){
    $insert = new DB_con();
    session_start();
    $v_filename = $received_data->v_filename;
    $v_title = $received_data->v_title;
    $v_type = $received_data->v_type;
    $_head_id = $received_data->_head_id;
    $username = $_SESSION['user'];

    if($v_filename && $v_title && $v_type && $_head_id && $insert->onSuccessUploadVideoFile($v_filename,$v_title,$v_type,$_head_id,$username)){
        $result = array(
            "message" => "Inserted",
            "status" => true 
        );
    }else{
        $result = array(
            "message" => "Can't Insert This Data",
            "status" => false 
        );
    }
}
if($received_data->action == "onDeleteVideo"){
    $v_id = $received_data->v_id;
    $v_type = $received_data->v_type;
    $v_filename = $received_data->v_filename;
    $_head_id = $received_data->_head_id;
    $delete = new DB_Con();
    if($v_id  && $v_type && $v_filename && $_head_id){
        if($delete->onDeleteVideo($v_id)){
            $languege = $v_type == '1' ? "/TH/" : "/EN/";
            $rootPathUpload = @"../../uploads/header/".$_head_id."/video/".$languege.$v_filename;
            if(file_exists($rootPathUpload)){
                if(unlink($rootPathUpload)){
                    $result = array(
                        'message' => $v_filename.' is Deleted',
                        'status' => true
                    );
                }
            }
        }
    }
    
    if(!isset($result)){
        $result = array(
            'message' => 'Item Not Found',
            'status' => false
        );
    }
    
}
#endregion

if($received_data->action == "onSuccessUploadHandout"){
    $insert = new DB_con();
    $p_filename = $received_data->p_filename;
    $p_title = $received_data->p_title;
    $_head_id = $received_data->_head_id;
    session_start();
    $username = $_SESSION['user'];

    if($p_filename && $p_title && $_head_id && $insert->onSuccessUploadHandout($p_filename,$p_title,$_head_id,$username)){
        $result = array(
            "message" => "Inserted",
            "status" => true 
        );
    }else{
        $result = array(
            "message" => "Can't Insert This Data",
            "status" => false 
        );
    }
}

if($received_data->action == "onDeleteHandout"){
    $p_id = $received_data->p_id;
    $p_filename = $received_data->p_filename;
    $_head_id = $received_data->_head_id;
    $delete = new DB_Con();
    if($p_id  && $p_filename && $_head_id){
        if($delete->onDeleteHandout($p_id)){
            $rootPathUpload = @"../../uploads/header/".$_head_id."/handouts/".$p_filename;
            if(file_exists($rootPathUpload)){
                if(unlink($rootPathUpload)){
                    $result = array(
                        'message' => $p_filename.' is Deleted',
                        'status' => true
                    );
                }
            }else{
                $result = array(
                    'message' => $p_filename.' is Deleted But file Not Found',
                    'status' => true
                );
            }
        }
    }
    
    if(!isset($result)){
        $result = array(
            'message' => 'Item Not Found',
            'status' => false
        );
    }
}

echo json_encode($result);

?>