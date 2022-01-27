<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use AppBundle\Entity\Question;
use AppBundle\DAO\QueryDAO;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\DBAL\DBALException;

class QuestionController extends Controller {
     /**
     * @Route("/course/questioncreate")
     * @Method("POST")
     */
    public function QuestionAction(Request $request) {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');

        $question = new Question();
        
        $content = $request->getContent();
        $param = json_decode($content,true);
        $jsonContent = $serializer->serialize($param, 'json');
        $question = $serializer->deserialize($jsonContent, 'AppBundle\Entity\Question', 'json');
        
        $curdate = new \DateTime("now");
        $question->setQCreatedate($curdate);
        $question->setQModifydate($curdate);
        
        try{
            $em = $this->getDoctrine()->getManager();
            if ($question->getqId() == 0){
                $em->persist($question);
                $em->flush();
            }
            else{
                $existquestion = new Question();
                $existquestion = $em->getRepository('AppBundle:Question')
                ->find($question->getqId());
                
                $existquestion->setLId($question->getLId());
                $existquestion->setQQuestion($question->getQQuestion());
                $existquestion->setQOption1( $question->getQOption1());
                $existquestion->setQOption2($question->getQOption2());
                $existquestion->setQOption3($question->getQOption3());
                $existquestion->setQOption4($question->getQOption4());
                $existquestion->setQRightNumber($question->getQRightNumber());
                $existquestion->setQModifyuid($question->getQModifyuid());
                $existquestion->setQModifydate($question->getQModifydate());
                $em->flush();
        }
        }catch (DBALException $e)
        {
            return $response->setData(array("status"=>"fail","message"=>$e->getMessage()));
        }
        
        return $response->setData(array("status"=>"success","message"=>$question->getqId()));
        
    }
    
    /**
     * @Route("/course/questiondelete")
     * @Method("GET")
     */
    public function deleteAction(Request $request){
        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');
 	 
        $id = $request->query->get("id");
        $uid = $request->query->get("uid");

        try{
            $em = $this->getDoctrine()->getManager();
            $existquestion = new Question();
            $existquestion = $em->getRepository('AppBundle:Question')
                ->find($id);
            if(is_null($existquestion)){
                return $response->setData(array("status"=> "fail","message"=>"Question not exists."));
            }

            $curdate = new \DateTime("now");
            $em->remove($existquestion);
            $em->flush();
        }catch (DBALException $e)
        {
            return $response->setData(array("status"=>"fail","message"=>"Delete not success."));
        }

        return $response->setData(array("status"=>"success","message"=>"Successfully Deleted."));
    }
    
    /**
     * @Route("/course/listquestion")
     * @Method("GET")
     */
    public function listContentAction(){
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
                
        $response = new JsonResponse();
	$response->headers->set('Access-Control-Allow-Origin', '*');
        
        $em = $this->getDoctrine()->getManager();
        $questionlist = $em->getRepository('AppBundle:Question')
            ->listquestion();   
        
        $jsonContent = $serializer->serialize($questionlist, 'json');
                        
        if(is_null($questionlist)){
            return $response->setData(array("status"=>"fail","message"=>"No lists to show"));
        }else{
	      return $response->setContent($jsonContent);
        }     
    }
    
    /**
     * @Route("/course/listquestion2")
     * @Method("GET")
     */
    public function listContent2Action(Request $request){
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
                
        $response = new JsonResponse();
	$response->headers->set('Access-Control-Allow-Origin', '*');
        
        $uid = $request->query->get("uid");
//        $em = $this->getDoctrine()->getManager();
//        $questionlist = $em->getRepository('AppBundle:Question')
//            ->listquestion2($uid);   
        $con = $this->getDoctrine()->getEntityManager()->getConnection();
        $qDAO = new QueryDAO($con);
        $questionlist = $qDAO->listquestionbystu($uid);
        $jsonContent = $serializer->serialize($questionlist, 'json');
                        
        if(is_null($questionlist)){
            return $response->setData(array("status"=>"fail","message"=>"No lists to show"));
        }else{
	      return $response->setContent($jsonContent);
        }     
    }
}

//ALTER TABLE elearning.question
//ADD  FOREIGN KEY (l_id)
//REFERENCES elearning.lesson(l_id)
//ON UPDATE CASCADE ON DELETE RESTRICT;