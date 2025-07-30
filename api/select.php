<?
    header("Content-type: application/json; charset=utf-8");

    include "../build/config/connect.php";
    $select = new DB_con();
    $topic = $_POST['topic'];
    $result = array();

    if($topic == 'class'){
        $sql = "SELECT *
                        FROM blog_class 
                                ORDER BY order_show ASC" ;
        $query = $select->fetch_data($sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $result[] = $row;
            }
        }
    }else if($topic == 'subject'){
        $class_id = $_POST['class_id'];
        $sql = "SELECT * FROM blog_subject WHERE class_no = '$class_id' ORDER BY subj_code ASC";
        $query = $select->fetch_data($sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $result[] = $row;
            }
        }
    }else if($topic == 'header'){
        $subj_id = $_POST['subj_id'];
        $sql = "SELECT * FROM blog_header WHERE _subj_id = '$subj_id' ORDER BY head_id ASC";
        $query = $select->fetch_data($sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $result[] = $row;
            }
        }

        if(count($result) > 0){
            for($i = 0 ; $i < count($result) ; $i++){
                $head_id = $result[$i]['head_id'];
                $sql = "SELECT * FROM media_vdo WHERE _head_id = $head_id AND v_type = '1' LIMIT 1";
                $query = $select->fetch_data($sql);
                if(mysqli_num_rows($query) > 0){
                    $result[$i]['has_th'] = '1';
                }else{
                    $result[$i]['has_th'] = '0';
                }
                $sql = "SELECT * FROM media_vdo WHERE _head_id = $head_id AND v_type = '2' LIMIT 1";
                $query = $select->fetch_data($sql);
                if(mysqli_num_rows($query) > 0){
                    $result[$i]['has_en'] = '1';
                }else{
                    $result[$i]['has_en'] = '0';
                }

                $sql = "SELECT * FROM media_pdf WHERE _head_id = $head_id";
                $query = $select->fetch_data($sql);
                if(mysqli_num_rows($query) > 0){
                    $result[$i]['has_pdf'] = '1';
                }else{
                    $result[$i]['has_pdf'] = '0';
                }
            }
        }

    }
   
    echo json_encode($result);
?>