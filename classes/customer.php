<?php

class customer extends pdocrudhandler{
    public function getAllQuestions(){
        $result = $this->select('questions',array('*'));

        
        return $result;
        
        

        /*{
            "success": true,
                "payload": {
                         Application-specific data would go here.
                            }
        }*/
        /*
         * {
              "success": false,
                    "payload": {
                        Application-specific data would go here.
                                },
                    "error": {
                        "code": 123,
                        "message": "An error occurred!"
                            }
            }
        */
    }
    public function getAllSubject(){
        $result = $this->select('subject',array('*'));
        return $result;
    }

    public function getAnswer_By_QuestionId($id){
        $result = $this->select('answer',array('*'),'where questionid = ?',array($id));
        return $result;
    }
    public function getAnswerStatus($qid,$aid){
        $result = $this->select('answer',array('*'),'where id = ? and questionid = ? and status = ?',array($aid,$qid,'true'));
        return $result;
    }
}



?>