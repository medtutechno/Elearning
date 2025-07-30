<?
header("Content-type: application/json; charset=utf-8");



// define('DB_SERVER','192.168.66.1');
// define('DB_USER','root');
// define('DB_PASS','medadmin');
// define('DB_NAME','menu_handle');
define('DB_SERVER', '192.168.66.17');
define('DB_USER', 'medtu');
define('DB_PASS', 'tmt@medtu');
define('DB_NAME', 'blog_lecturev_2021');


// define('DB_SERVER','localhost');
// define('DB_USER','root');
// define('DB_PASS','');
// define('DB_NAME','menu_handle');

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
    public function connect_auth()
    {
        $conn_auth = mysqli_connect('192.168.66.1', 'medtu', 'tmt@medtu', 'menu_handle');
        mysqli_set_charset($conn_auth, "utf8");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        return $conn_auth;
    }
    // เช็ค user ซ้ำใน base
    public function username_check($uname)
    {
        $conn_auth = $this->connect_auth();
        $checkuser = mysqli_query($conn_auth, "SELECT medcode,authorise_pass FROM authorise WHERE medcode = '$uname'");
        return $checkuser;
    }
    // เช็ค login
    public function signin($uname, $password)
    {
        $conn_auth = $this->connect_auth();
        $signin = mysqli_query($conn_auth, "SELECT * FROM v_union_authorise_all WHERE medcode = '$uname' AND MD5(authorise_pass) = '$password' LIMIT 1");
        $conn_auth->close();
        return $signin;
    }
    public function fetch_data($sql)
    {
        $conn2 = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        mysqli_set_charset($conn2, "utf8");
        $fetch = mysqli_query($conn2, $sql);
        $conn2->close();
        return $fetch;
    }
}

$user = strtoupper(trim($_REQUEST['user']));
$pass = MD5($_REQUEST['pass']);

$result = array();
session_start();

$conn_chkAdmin = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($conn_chkAdmin, 'utf8');
$valid = new DB_con();
$query = $valid->signin($user, $pass);
if (mysqli_num_rows($query) > 0) {
    $sql = "SELECT * FROM admin_user WHERE medcode = '$user'";
    $queryAdmin = mysqli_query($conn_chkAdmin, $sql);
    if (mysqli_num_rows($queryAdmin)) {
        $result['msg'] = 'your admin login successful';
        $_SESSION['user'] = strtoupper($user);
        $_SESSION['roll'] = 1;
        $result['medcode'] = strtoupper($user);
        $result['roll'] = 1;
        $result['status'] = true;

        $sql = "INSERT INTO log_login(medcode,log_status) VALUES('" . $result['medcode'] . "','I')";
        $valid->fetch_data($sql);
    } else {
        $passCheck = mysqli_fetch_assoc($query);
        $_SESSION['user'] = strtoupper($passCheck['medcode']);
        $_SESSION['roll'] = 2;
        $result['msg'] = 'login successful';
        $result['medcode'] = strtoupper($passCheck['medcode']);
        $result['status'] = true;
        $result['roll'] = 2;
    }
    if ($result['medcode'] != '') {
        $sql = "INSERT INTO log_login(medcode,log_status) VALUES('" . $result['medcode'] . "','I')";
        $valid->fetch_data($sql);
    }

    mysqli_close($conn_chkAdmin);
} else {
    $result['msg'] = 'invalid Medcode or Password';
    $result['status'] = false;
    session_destroy();
}



echo json_encode($result);