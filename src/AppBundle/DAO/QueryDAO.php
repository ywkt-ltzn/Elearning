<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\DAO;
/**
 * Description of QueryDAO
 *
 * @author yuwah
 */
class QueryDAO {
    private $con;
    
    public function __construct($con) {
        $this->con = $con;
    }
    
    public function listquestionbystu($uid){
        $les_arr = array();
        
        $query = 'Select * From lesson'; 
        $stmt = $this->con->executeQuery($query);
        $lessons = $stmt->fetchAll();
        foreach  ($lessons as $lesson){
            $data = array();
            $data['lid'] = $lesson['l_id'];
            $data['ltitle'] = $lesson['l_title'];
            
            $query2 = 'SELECT q.q_id,q.q_question,q.q_option1,q.q_option2,q.q_option3,q.q_option4,q.q_right_number,a.a_id,a.a_answer FROM question q Left Join  
            (SELECT * From answer an WHERE an.u_id= '. $uid .' ) a On a.q_id=q.q_id Where q.l_id = ' . $lesson['l_id'];
            $stmt = $this->con->executeQuery($query2);
            $questions = $stmt->fetchAll();
            $con_arr = array();
            foreach ($questions as $question){
                array_push($con_arr, $question);
            }
            $data['question'] = $con_arr;
            array_push($les_arr, $data);
        }
        return $les_arr;
    }
    
    public function studentresult($uid,$lid){
         $query = 'Select Sum(b.ranswer) ranswer,count(b.ranswer) tanswer,b.u_id,b.l_id,l.l_title,u.u_name From
                (Select case when r.q_right_number=r.a_answer Then 1 Else 0 End as ranswer,r.u_id ,r.l_id From
                (SELECT q.q_id,q.q_right_number,q.l_id,a.a_id,a.a_answer,a.u_id FROM question q Inner Join  
                (SELECT * From answer an ) a On a.q_id=q.q_id ) r) b 
                Inner Join lesson l on l.l_id=b.l_id 
                Inner Join user u on u.u_id = b.u_id Where ranswer = ranswer ';
                
         
        if ($uid != 0){
            $query = $query .' AND b.u_id= '.$uid;
        }
        if ($lid != 0){
            $query = $query .' AND b.l_id= '.$lid;
        }
        
        $query =$query . ' Group By b.u_id,b.l_id';
        
        $stmt = $this->con->executeQuery($query);
        return $stmt->fetchAll();
    }
}
