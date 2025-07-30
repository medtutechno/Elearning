<?
    header("Content-type: application/json; charset=utf-8");

    define('DB_SERVER','192.168.66.1');
    define('DB_USER','medtu');
    define('DB_PASS','tmt@medtu');
    define('DB_NAME','menu_handle');
    echo DB_SERVER;
    // define('DB_SERVER','localhost');
    // define('DB_USER','root');
    // define('DB_PASS','');
    // define('DB_NAME','menu_handle');
    
    class DB_con{
        function __construct(){
            $conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
            $this->dbcon = $conn;
            mysqli_set_charset($this->dbcon,"utf8");
            if (mysqli_connect_errno()){
                echo "Failed to connect to MySQL: ".mysqli_connect_error();
            }else{
                echo "Db Connected";
            }
        }

        // เช็ค user ซ้ำใน base
        public function username_check($uname){
            $checkuser = mysqli_query($this->dbcon,"SELECT medcode,authorise_pass FROM authorise WHERE medcode = '$uname' LIMIT 1");
            return $checkuser;      
        }
        // เช็ค login
        public function signin($uname , $password){
            $signin = mysqli_query($this->dbcon, "SELECT * FROM authorise WHERE medcode = '$uname' AND authorise_pass = '$password' LIMIT 1");
            return $signin;
        }
        public function fetch_data($sql){
            $conn2 = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,'blog_lecturev');
            mysqli_set_charset($conn2,"utf8");
            $fetch = mysqli_query($conn2 ,$sql);
            $conn2->close();
            return $fetch;
        }

        public function fetch_user(){
            $sql = "SELECT * FROM authorise";
            $query = mysqli_query($this->dbcon,$sql);
            return $query;
        }
    }
    
    // $user = strtoupper(trim($_REQUEST['user']));
    // $pass = trim($_REQUEST['pass']);
    $db = new DB_con();
    $user = 'BET0047';
    $pass = '076902';
    $res = $db->signin($user,$pass);
    $result = array() ;

    if(mysqli_num_rows($res) > 0){
        while($row = mysqli_fetch_assoc($res)){
            $result[] = $row;
        }
    }
    // session_start();
    
    // $conn_chkAdmin = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,'blog_lecturev_2021');
    // mysqli_set_charset($conn_chkAdmin,'utf8');
    // $sql = "SELECT * FROM admin_user WHERE medcode = '$user' AND `password` = '$pass' LIMIT 1";
    // $query = mysqli_query($conn_chkAdmin,$sql);
    // if(mysqli_num_rows($query)){
    //     $result['msg'] = 'your admin login successful';
    //     $_SESSION['user'] = strtoupper($user);
    //     $_SESSION['roll'] = 1;
    //     $result['medcode'] = strtoupper($user);
    //     $result['roll'] = 1;
    //     $result['status']= true;
    // }else{
    //     $valid = new DB_con();
    //     $query = $valid->signin($user,$pass);
        
    //     if(mysqli_num_rows($query) > 0){
    //         $passCheck = mysqli_fetch_assoc($query);
    //         $_SESSION['user'] = strtoupper($passCheck['medcode']);
    //         $_SESSION['roll'] = 2;
    //         $result['msg'] = 'login successful';
    //         $result['medcode'] = strtoupper($passCheck['medcode']);
    //         $result['status']= true;
    //         $result['roll'] = 2;
    //         $sql = "INSERT INTO log_login(medcode,log_status) VALUES('".$result['medcode'] ."','I')";
    //         $valid->fetch_data($sql);
    //     }else{
    //         $result['msg'] = 'invalid Medcode or Password';
    //         $result['status'] = false;
    //         session_destroy();
    //     }
    // }

    echo "<pre>";
    print_r($result);
    echo "</pre>";

?>