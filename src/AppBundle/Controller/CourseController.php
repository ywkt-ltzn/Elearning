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
use AppBundle\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\DBAL\DBALException;

/**
 * Description of UserController
 *
 * @author yuwah
 */
class CourseController extends Controller{
    //put your code here
    /**
     * @Route("/course/coursecreate")
     * @Method("POST")
     */
    
    public function courseAction(Request $request) {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');

        $course = new Course();
        $content = $request->getContent();
        $param = json_decode($content,true);
        $jsonContent = $serializer->serialize($param, 'json');
        $course = $serializer->deserialize($jsonContent, 'AppBundle\Entity\Course', 'json');
        
        $curdate = new \DateTime("now");
        $course->setCouCreatedate($curdate);
        $course->setCouModifydate($curdate);
        
        try{
            $em = $this->getDoctrine()->getManager();
            if ($course->getCouId() == 0){
                $em->persist($course);
                $em->flush();
            }
            else{
                $existcourse = new Course();
                $existcourse = $em->getRepository('AppBundle:Course')
                ->find($course->getCouId());

                $existcourse ->setCouName($course ->getCouName());
                $existcourse ->setUId($course->getUId());
                $existcourse ->setCouModifydate($curdate);
                $existcourse ->setCouModifyuid($course->getCouModifyuid());
                $em->flush();
        }
        }catch (DBALException $e)
        {
            return $response->setData(array("status"=>"fail","message"=>$e->getMessage()));
        }
        
        return $response->setData(array("status"=>"success","message"=>$course->getCouId()));
        
    }
    
    /**
     * @Route("/course/coursedelete")
     * @Method("GET")
     */
    public function deleteAction(Request $request){
        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');
 	 
        $id = $request->query->get("id");
        $uid = $request->query->get("uid");

        try{
            $em = $this->getDoctrine()->getManager();
            $existcourse = new Course();
            $existcourse = $em->getRepository('AppBundle:Course')
                ->find($id);
            if(is_null($existcourse)){
                return $response->setData(array("status"=> "fail","message"=>"Course not exists."));
            }

            $curdate = new \DateTime("now");
            $existcourse->setCouModifydate($curdate);
            $existcourse->setCouModifyuid($uid);
            $em->remove($existcourse);
            $em->flush();
        }catch (DBALException $e)
        {
            return $response->setData(array("status"=>"fail","message"=>"Delete not success."));
        }

        return $response->setData(array("status"=>"success","message"=>"Successfully Deleted."));
    }
    
    /**
     * @Route("/course/listcourse")
     * @Method("GET")
     */
    public function listCourseAction(){
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
                
        $response = new JsonResponse();
	    $response->headers->set('Access-Control-Allow-Origin', '*');
        
        $em = $this->getDoctrine()->getManager();
        $courseList = $em->getRepository('AppBundle:Course')
            ->listcourse();   
        
        $jsonContent = $serializer->serialize($courseList, 'json');
                        
        if(is_null($courseList)){
            return $response->setData(array("status"=>"fail","message"=>"No lists to show"));
        }else{
	      return $response->setContent($jsonContent);
        }     
    }
}