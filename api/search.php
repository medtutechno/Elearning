<?
    header("Content-type: application/json; charset=utf-8");

    include "../build/config/connect.php";
    $search = new DB_con();
    $topic = $_POST['topic'];
    $result = array();
    if($topic == 'content'){
        $content = array();
        $subj_id = $_POST['subj_id'];
        $sql_subj = "SELECT * FROM blog_subject AS subj WHERE subj.subj_id = '$subj_id' LIMIT 1";
        $query = $search->fetch_data($sql_subj);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $result['subject'] = $row;
            }
        }
        $sql_content = "SELECT 
                            COUNT(v_id) AS vcd
                            ,COUNT(p_id) AS pdf
                            ,bh.* 
                        FROM 
                            blog_header  AS bh
                            LEFT JOIN media_vdo AS mv
                            ON bh.head_id = mv._head_id
                            LEFT JOIN media_pdf AS mp
                            ON bh.head_id = mp._head_id
                            LEFT JOIN media_cai AS mc
                            ON bh.head_id = mc._head_id		
                                    WHERE _subj_id='".$subj_id."' 
                                            GROUP BY bh.head_id 
                                                    ORDER BY head_name ASC";
        $query_subj = $search->fetch_data($sql_content);
        if(mysqli_num_rows($query_subj) > 0){
            while($row = mysqli_fetch_assoc($query_subj)){
                $content[] = $row;
            }
            $result['content'] = $content;
        }
    }else if ($topic == "video_list"){
        $medcode = $_POST['medcode'];
        $head_id = $_POST['head_id'];
        $sql = "SELECT * FROM media_vdo WHERE _head_id = '$head_id'";
        $query = $search->fetch_data($sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $row['currentTime'] = "0";
                $row['last_visited'] = "";
                $row['current_percent'] = "0";
                $result['video'][] = $row;
            }
        }
        $sql = "SELECT last_visited,current_secTime ,current_percent,v_id AS cur_id
                    FROM log_view 
                        WHERE _header_id = '$head_id' 
                            AND medcode = '$medcode' 
                                ORDER BY view_id ASC";
        $query = $search->fetch_data($sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                for($i= 0 ; $i < count($result['video']) ; $i++){
                    if($result['video'][$i]['v_id'] == $row['cur_id']){
                        $result['video'][$i]['currentTime'] = $row['current_secTime'];
                        $result['video'][$i]['last_visited'] = $row['last_visited'];
                        $result['video'][$i]['current_percent'] = $row['current_percent'];
                        break;
                    }
                }
            }
        }


        $sql = "SELECT * FROM media_pdf WHERE _head_id = '$head_id'";
        $query = $search->fetch_data($sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $result['pdf'][] = $row;
            }
        }
    }else if ($topic == "video"){
        $v_id = $_POST['v_id'];
        $v_type = $_POST['v_type']; 
        $medcode = $_POST['medcode']; 
        // $sql = "SELECT * FROM media_vdo WHERE v_id = '$v_id' AND v_type = '$v_type'";
        $sql = "SELECT log_v.*,vdo.v_filename,vdo.v_title,vdo.v_type FROM log_view AS log_v
                    JOIN media_vdo AS vdo ON log_v.v_id = vdo.v_id
                        WHERE log_v.medcode = '$medcode' AND log_v.v_id = '$v_id' AND vdo.v_type = '$v_type'
                            ORDER BY log_v.view_id DESC LIMIT 1";
        $query = $search->fetch_data($sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $result[] = $row;
            }
        }else{
            $sql = "SELECT * , _head_id AS _header_id FROM media_vdo 
                        WHERE v_id = '$v_id' LIMIT 1";
            $query = $search->fetch_data($sql);
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                    $result[] = $row;
                }
            }
        }
    }else if ($topic == 'getSubjectByHeadID'){
        $head_id = $_POST['head_id'];
        $sql = "SELECT sub.subj_nameT , sub.subj_nameE , sub.subj_code FROM blog_header AS header
                    JOIN blog_subject AS sub ON header._subj_id = sub.subj_id
                        WHERE header.head_id = '$head_id' LIMIT 1";
        $query = $search->fetch_data($sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $result[] = $row;
            }
        }
    }
    else if($topic == "onLoadVideoAndPdf"){
        $head_id = $_POST['head_id'];
        $v_type = $_POST['v_type'];
        $medcode = $_POST['medcode'];
        $result = array();
        $search = new DB_con();

        if($v_type != '0'){
            $sql = "SELECT vdo.*,header.head_name FROM media_vdo AS vdo 
                    JOIN blog_header AS header ON header.head_id = vdo._head_id 
                        WHERE vdo._head_id = '$head_id' AND vdo.v_type = '$v_type'";
            $query = $search->fetch_data($sql);
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                    $result['video'][] = $row;
                }
            }
            $sql = "SELECT last_visited,current_secTime ,current_percent,v_id AS cur_id
                        FROM log_view 
                            WHERE _header_id = '$head_id' 
                                AND medcode = '$medcode' 
                                    ORDER BY view_id ASC";
            $query = $search->fetch_data($sql);
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                    for($i= 0 ; $i < count($result['video']) ; $i++){
                        if($result['video'][$i]['v_id'] == $row['cur_id']){
                            $result['video'][$i]['currentTime'] = $row['current_secTime'];
                            $result['video'][$i]['last_visited'] = $row['last_visited'];
                            $result['video'][$i]['current_percent'] = $row['current_percent'];
                            break;
                        }
                    }
                }
            }
        }
        
        $sql = "SELECT * FROM media_pdf WHERE _head_id = '$head_id'";
        $query = $search->fetch_data($sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $result['pdf'][] = $row;
            }
        }
    }
    else if($topic == "onLoadLastVisited"){
        $medcode = $_POST['medcode'];
        $sql = "SELECT  a.*,vdo.v_filename,vdo.v_title,vdo._head_id,vdo.v_type, header.head_name
        FROM    (SELECT view_id, medcode , _header_id , v_id, current_secTime, current_percent, last_visited,
                     ROW_NUMBER() OVER (PARTITION BY v_id ORDER BY last_visited DESC) AS RowNumber
                        FROM   log_view
                        ) AS a
                    JOIN media_vdo AS vdo ON a.v_id = vdo.v_id
                    JOIN blog_header AS header ON header.head_id = _head_id
                    WHERE  a.current_percent <> 100 AND a.RowNumber = 1 AND a.medcode = '$medcode' ORDER BY a.last_visited DESC LIMIT 5";
       $query = $search->fetch_data($sql);
       if(mysqli_num_rows($query) > 0){
           while($row = mysqli_fetch_assoc($query)){
               $result['video_lastview'][] = $row;
           }
       }
    }
    // echo $sql_subj;
    echo json_encode($result);

?>