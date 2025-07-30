<?
define('DB_SERVER', '192.168.66.17');
define('DB_USER', 'medtu');
define('DB_PASS', 'tmt@medtu');
define('DB_NAME', 'blog_lecturev_2021');

// define('DB_SERVER','localhost');
// define('DB_USER','root');
// define('DB_PASS','');
// define('DB_NAME','blog_lecturev');

class DB_con
{
    function __construct()
    {
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->dbcon = $conn;
        mysqli_set_charset($this->dbcon, "utf8");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }
    public function fetch_data($sql)
    {
        $fetch = mysqli_query($this->dbcon, $sql);
        return $fetch;
    }
    #region Class
    // โหลดชั้นปีเพื่อแสดงหน้า main ของ admin
    public function initialLoadClass()
    {
        $sql = "SELECT * FROM blog_class";
        $query = mysqli_query($this->dbcon, $sql);
        $result = array();
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $result[] = $row;
            }
        }
        return $result;
    }
    // เพิ่มชั้นปี
    public function createClass($c_name, $order_show)
    {
        $sql = "INSERT INTO blog_class(c_name,order_show) VALUES('$c_name','$order_show')";
        $insert = mysqli_query($this->dbcon, $sql);
        return $insert;
    }
    // ลบชั้นปี
    public function deleteClass($c_id)
    {
        $sql = "DELETE FROM blog_class WHERE c_id = '$c_id'";
        $delete = mysqli_query($this->dbcon, $sql);
        return $delete;
    }
    // อัพเดตชั้นปี
    public function updateClass($c_id, $c_name)
    {
        $sql = "UPDATE blog_class SET c_name = '$c_name' WHERE c_id = '$c_id'";
        $update = mysqli_query($this->dbcon, $sql);
        return $update;
    }
    #endregion

    #region Subject
    // โหลดรายวิชาโดยอ้างอิงจากชั้นปี
    public function onLoadSubject($c_id)
    {
        $sql = "SELECT * FROM blog_subject WHERE class_no = '$c_id' ORDER BY subj_id DESC";
        $query = mysqli_query($this->dbcon, $sql);
        $result = array();
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $result[] = $row;
            }
        }
        return $result;
    }
    public function createSubject($c_id, $subj_code, $subj_nameT, $subj_nameE)
    {
        $sql = "INSERT INTO blog_subject(class_no,subj_code,subj_nameT,subj_nameE)
                    VALUES('$c_id','$subj_code','$subj_nameT','$subj_nameE')";
        $insert = mysqli_query($this->dbcon, $sql);
        return $insert;
    }
    public function deleteSubject($subj_id)
    {
        $sql = "DELETE FROM blog_subject WHERE subj_id = '$subj_id'";
        $delete = mysqli_query($this->dbcon, $sql);
        return $delete;
    }
    public function updateSubject($subj_id, $c_id, $subj_code, $subj_nameT, $subj_nameE)
    {
        $sql = "UPDATE blog_subject SET class_no = '$c_id', subj_code = '$subj_code' , subj_nameT = '$subj_nameT', subj_nameE = '$subj_nameE' WHERE subj_id = '$subj_id'";
        $update = mysqli_query($this->dbcon, $sql);
        return $update;
    }
    #endregion

    #region Header
    // โหลดหัวเรื่องโดยอ้างอิงจากรายวิชา
    public function onLoadHeader($subj_id)
    {
        $sql = "SELECT * FROM blog_header WHERE _subj_id = '$subj_id' ORDER BY head_id DESC";
        $query = mysqli_query($this->dbcon, $sql);
        $result = array();
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $result[] = $row;
            }
        }
        return $result;
    }
    // สร้างหัวเรื่อง
    public function createHeader($head_date, $head_teach, $head_name, $subj_id)
    {
        $sql = "INSERT INTO blog_header(head_date,head_teach,head_name,_subj_id)
                    VALUES('$head_date','$head_teach','$head_name','$subj_id')";
        $insert = mysqli_query($this->dbcon, $sql);
        return $insert;
    }
    // ลบหัวเรื่อง 
    public function deleteHeader($head_id)
    {
        $sql = "DELETE FROM blog_header WHERE head_id = '$head_id'";
        $delete = mysqli_query($this->dbcon, $sql);
        return $delete;
    }
    // แก้ไขหัวเรื่อง 
    public function updateHeader($head_id, $head_date, $head_teach, $head_name)
    {
        $sql = "UPDATE blog_header SET head_date = '$head_date', head_teach = '$head_teach' , head_name = '$head_name'
         WHERE head_id = '$head_id'";
        $update = mysqli_query($this->dbcon, $sql);
        return $update;
    }
    #endregion

    #region Video
    public function onLoadVideoList($head_id)
    {
        $sql = "SELECT * FROM media_vdo WHERE _head_id = '$head_id' AND v_type IS NOT NULL ORDER BY v_id DESC";
        $query = mysqli_query($this->dbcon, $sql);
        $result = array();
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $result[] = $row;
            }
        }
        return $result;
    }

    public function onSuccessUploadVideoFile($v_filename, $v_title, $v_type, $_head_id, $username)
    {
        $sql = "INSERT INTO media_vdo(v_filename,v_title,v_type,_head_id,user_upload) VALUES('$v_filename','$v_title','$v_type','$_head_id','$username')";
        $insert = mysqli_query($this->dbcon, $sql);
        return $insert;
    }

    public function onLoadPdfList($head_id)
    {
        $sql = "SELECT * FROM media_pdf WHERE _head_id = '$head_id'";
        $query = mysqli_query($this->dbcon, $sql);
        $result = array();
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $result[] = $row;
            }
        }
        return $result;
    }

    public function onDeleteVideo($v_id)
    {
        $sql = "DELETE FROM media_vdo WHERE v_id = '$v_id'";
        $delete = mysqli_query($this->dbcon, $sql);
        return $delete;
    }

    #endregion

    #region Handout
    public function onSuccessUploadHandout($p_filename, $p_title, $_head_id, $username)
    {
        $sql = "INSERT INTO media_pdf(p_filename,p_title,_head_id,user_upload) VALUES('$p_filename','$p_title','$_head_id','$username')";
        $insert = mysqli_query($this->dbcon, $sql);
        return $insert;
    }
    public function onDeleteHandout($p_id)
    {
        $sql = "DELETE FROM media_pdf WHERE p_id = '$p_id'";
        $delete = mysqli_query($this->dbcon, $sql);
        return $delete;
    }
    #endregion
    // COMPLETE ( END ) ...
}
