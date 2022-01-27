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
use AppBundle\Entity\Lesson;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\DBAL\DBALException;
/**
 * Description of LessonController
 *
 * @author yuwah
 */
class LessonController extends Controller {
    /**
     * @Route("/course/lessoncreate")
     * @Method("POST")
     */
    public function LessonAction(Request $request) {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');

        $lesson = new Lesson();
        
        $content = $request->getContent();
        $param = json_decode($content,true);
        $jsonContent = $serializer->serialize($param, 'json');
        $lesson = $serializer->deserialize($jsonContent, 'AppBundle\Entity\Lesson', 'json');
        
        $curdate = new \DateTime("now");
        $lesson->setLCreatedate($curdate);
        $lesson->setLModifydate($curdate);
        
        try{
            $em = $this->getDoctrine()->getManager();
            if ($lesson->getLId() == 0){
                $em->persist($lesson);
                $em->flush();
            }
            else{
                $existlesson = new Lesson();
                $existlesson = $em->getRepository('AppBundle:Lesson')
                ->find($lesson->getLId());
                
                $existlesson->setCouId($lesson->getCouId());
                $existlesson->setLTitle($lesson->getLTitle());
                $existlesson->setLModifydate($curdate);
                $existlesson->setLModifyuid($lesson->getLModifyuid());
                $em->flush();
        }
        }catch (DBALException $e)
        {
            return $response->setData(array("status"=>"fail","message"=>$e->getMessage()));
        }
        
        return $response->setData(array("status"=>"success","message"=>$lesson->getLId()));
        
    }
    
    /**
     * @Route("/course/lessondelete")
     * @Method("GET")
     */
    public function deleteAction(Request $request){
        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');
 	 
        $id = $request->query->get("id");
        $uid = $request->query->get("uid");

        try{
            $em = $this->getDoctrine()->getManager();
            $existlesson = new Lesson();
            $existlesson = $em->getRepository('AppBundle:Lesson')
                ->find($id);
            if(is_null($existlesson)){
                return $response->setData(array("status"=> "fail","message"=>"Lesson not exists."));
            }

            $curdate = new \DateTime("now");
            $em->remove($existlesson);
            $em->flush();
        }catch (DBALException $e)
        {
            return $response->setData(array("status"=>"fail","message"=>"Delete not success."));
        }

        return $response->setData(array("status"=>"success","message"=>"Successfully Deleted."));
    }
    
    /**
     * @Route("/course/listlesson")
     * @Method("GET")
     */
    public function listLessonAction(){
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
                
        $response = new JsonResponse();
	    $response->headers->set('Access-Control-Allow-Origin', '*');
        
        $em = $this->getDoctrine()->getManager();
        $lessonList = $em->getRepository('AppBundle:Lesson')
            ->listlesson();   
        
        $jsonContent = $serializer->serialize($lessonList, 'json');
                        
        if(is_null($lessonList)){
            return $response->setData(array("status"=>"fail","message"=>"No lists to show"));
        }else{
	      return $response->setContent($jsonContent);
        }     
    }
}

//ALTER TABLE elearning.lesson
//    ADD  FOREIGN KEY (cou_id)
//      REFERENCES elearning.course(cou_id)
//      ON UPDATE CASCADE ON DELETE RESTRICT;
