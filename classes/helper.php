<?php
require_once('../View/autoload.php');
class helper extends pdocrudhandler{
    public function AddAnswers($params){
     /*   echo print_r($params,true);
        echo count($params);exit;*/
        $querey = "insert into answer(questionid,ans) ";
        $length = count($params) - 3;
        for($i=1;$i<=$length;$i++){
             ($i != $length) ? $querey .= "select {$params['questionid']},'{$params['a'.$i]}' union all " : $querey .= "select {$params['questionid']},'{$params['a'.$i]}'";
        }
        $result = $this->executeqry($querey);
        return $result;
    }
    public function getAllSubject(){
        $result = $this->select('subject',array('*'));
        return $result;
    }
    public function upload($params){

        if (isset($_FILES) && !empty($_FILES)){
            $result = $this->insert('subject',array('subject_name' => $params['subjectname']));
            if ($result['status'] == 'success' && $result['rowsAffected'] == 1){
                $getID = $this->select('subject',array('id'),'where subject_name = ?',array($params['subjectname']));
                $ID = $getID['result'][0]->id;
                if ($ID){
                    $tmpFilePath = $_FILES['image']['tmp_name'];
                    if ($tmpFilePath != ""){
                        $newFilePath = "../Uploads/Icons/".$ID."_".$_FILES['image']['name'];
                        if(move_uploaded_file($tmpFilePath,$newFilePath)) {
                            $update = $this->update('subject',array('picPath'  => $newFilePath),'where id = ? ',array($ID));
                            if ($update['status'] == 'success' && $update['rowsAffected'] == 1){
                                return "file uplaoded successfull";
                            }
                        }
                    }
                }
            }

        }else{
            $result = $this->insert('subject',array('subject_name' => $params['subjectname']));
            return $result;
        }


    }
    public function getquestion($params){
        $result = $this->select('questions',array('*'),'where subjectid = ?',array($params['subjectId']));
        return $result;
    }
    public function filter($params){
        /*echo print_r($params);exit;*/
        if($params){
            $whereClause = "";
            if(isset($params['question']) && $params['question'] != 0){
                if($whereClause == ""){
                    $whereClause .= " where q.id  = ".$params['question'];
                }else{
                    $whereClause .= " and q.id = ".$params['question'];
                }
            }
            if(isset($params['subject'])  && $params['subject'] != 0){
                if($whereClause != ""){
                    $whereClause .= " and q.subjectid = ".$params['subject'];
                }else{
                    $whereClause .= " where q.subjectid = ".$params['subject'];
                }
            }
            $query = "select s.subject_name,q.question,a.ans from questions as q inner join subject as s
                      on s.id = q.subjectid inner join answer as a on a.questionid = q.id".$whereClause;
            $result = $this->customSelect($query);
            return $result;
        }else{
            $result = $this->customSelect('select s.subject_name,q.question,a.ans from questions as q inner join subject as s
on s.id = q.subjectid inner join answer as a on a.questionid = q.id');
            return $result;
        }
    }
    public function AddQuestions($params){
        $result = $this->insert('questions',array('question' => $params['question'],'subjectid' => $params['subjectid']));
        return $result;
    }
    public function getAllQuestion(){
        $result = $this->select('questions',array('*'));
        return $result;
    }

    public function getCourseById($params){
        $result = $this->select('subject',array('*'),'where id = ? ',array($params['subjectid']));
        return $result;
    }


}
$mendetoryParam = array(
    'AddAnswers'   => array('questionid','a1'),
    'getAllSubject' => array(),
    'getAllQuestion' => array(),
    'AddSubject'    => array('subject'),
    'getquestion'   => array('subjectId'),
    'filter'        => array('subject','question'),
    'AddQuestions'   => array('subjectid','question'),
    'upload'        => array('subjectname'),
    'getCourseById' => array('subjectid')
);

/*print_r($_POST);
print_r($_FILES);*/

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
        $helperObj = new helper();
        $data = $_POST;
        $mathodToCall = (string)$_POST['call'];
        $response = $helperObj->$mathodToCall($data);
        echo json_encode($response);
    }
}else{
    /*echo json_encode(array('status'=>false,'error'=>'Invalid method called'));*/
}
?>