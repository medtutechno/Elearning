<?
// define('DB_SERVER','192.168.66.2');
// define('DB_USER','root');
// define('DB_PASS','medadmin');
// define('DB_NAME','blog_lecturev4');

define('DB_SERVER','192.168.66.17');
define('DB_USER','medtu');
define('DB_PASS','tmt@medtu');
define('DB_NAME','blog_lecturev_2021');

class DB_con{
    function __construct(){
        $conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
        $this->dbcon = $conn;
        mysqli_set_charset($this->dbcon,"utf8");
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: ".mysqli_connect_error();
        }
    }
    
    // COMPLETE ...
    public function fetch_data($sql){
        $fetch = mysqli_query($this->dbcon ,$sql);
        return $fetch;
    }
    public function fetch_department(){
        $this->dbcon2 = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,'personal');
        mysqli_set_charset($this->dbcon2,"utf8");
        $fetch = mysqli_query($this->dbcon2,"SELECT SECTION_CODE , `DESCRIPTION` FROM appm_section WHERE USE_STATUS = '1'");
        mysqli_close($this->dbcon2);
        return $fetch;
    }
    public function search_department($section_id){
        $this->dbcon2 = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,'personal');
        mysqli_set_charset($this->dbcon2,"utf8");
        $search = mysqli_query($this->dbcon2,"SELECT `DESCRIPTION` FROM appm_section WHERE SECTION_CODE = '$section_id' LIMIT 1");
        mysqli_close($this->dbcon2);
        return mysqli_fetch_assoc($search);
    }
    public function delete($id,$table){
        $sql = ("DELETE FROM $table WHERE idindex_number = '$id'");
        if(mysqli_query($this->dbcon, $sql)){
            if(file_exists('../uploads/pdf/'.$id.'.pdf')){
                unlink('../uploads/pdf/'.$id.'.pdf');
            }
            return '1';
        }else{
            return '0';
        }
    }
    public function search($table , $where){
        $sql = "SELECT * FROM $table WHERE $where";
        $search = mysqli_query($this->dbcon, $sql);
        return $search;
    }
    public function search_fullnameBymedcode($medcode){
        $this->dbcon2 = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,'personal');
        $sql = "SELECT CONCAT(TFNAME,' ',TLNAME) FROM appm_personnel WHERE USERNAME = '$medcode' AND ID_CODE != '' LIMIT 1";
        $search = mysqli_query($this->dbcon2, $sql);
        mysqli_close($this->dbcon2);
        return $search;
    }
    public function search_fullnameByreq($name){
        $this->dbcon2 = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,'personal');
        mysqli_set_charset($this->dbcon2,"utf8");
        $sql = "SELECT CONCAT(TFNAME,' ',TLNAME) AS FULLNAME FROM appm_personnel WHERE 
            (TFNAME LIKE '$name%' OR
                TLNAME LIKE '$name%' OR
                    TFNAME LIKE '%$name%' OR
                        TLNAME LIKE '%$name%') 
                                AND ID_CODE != ''";
        $search = mysqli_query($this->dbcon2, $sql);
        mysqli_close($this->dbcon2);
        return $search;
    }
    public function insert($value){
        $val_text = "";
        for($i = 0 ; $i < count($value) ; $i++){
            $val_text .= $value[$i];
            if($i < count($value)-1){
                $val_text .= ",";
            }
        }
        $sql = "INSERT INTO 
                    index_number(idindex_number,index_number,
                        date_inbook,date_number,appm_section_id,
                            in_to,in_subject,in_type,pdf_file,username_req,tel,medcode) 
                VALUE ($val_text)";
        $insert = mysqli_query($this->dbcon,$sql);
        return $insert;
        
    }
    // COMPLETE ( END ) ...


    
    // สมัครสมาชิก หรือลงทะเบียน
    public function registration($fname , $uname , $uemail , $password){
        $reg = mysqli_query($this->dbcon,"INSERT INTO tb_user(fullname,username,email,password)
        VALUE ('$fname','$uname','$uemail','$password')");
        return $reg;
    }
    // เช็ค user ซ้ำใน base
    public function username_check($uname){
        $checkuser = mysqli_query($this->dbcon,"SELECT username FROM tb_user WHERE username = '$uname'");
        return $checkuser;      
    }
    // เช็ค login
    public function signin($uname , $password){
        $signin = mysqli_query($this->dbcon, "SELECT * FROM tb_user WHERE username = '$uname' AND password = '$password'");
        return $signin;
    }

    public function select($training_num){
        $select = mysqli_query($this->dbcon, "SELECT * FROM training_all WHERE ID = '$training_num' LIMIT 1");
        return $select;
    }

    public function update($table,$data,$where){
        $modifs="";
        $i=1;
        foreach($data as $key=>$val){
            if($i!=1){ $modifs.=", "; }
            if(is_numeric($val)) { $modifs.=$key.'='.$val; }
            else { $modifs.=$key.' = "'.$val.'"'; }
            $i++;
        }
        $sql = ("UPDATE $table SET $modifs WHERE $where");
        if($this->dbcon->query($sql)) { return true; }
        else { die("SQL Error: <br>".$sql."<br>".$this->dbcon->error); return false; }
    }
}

?>