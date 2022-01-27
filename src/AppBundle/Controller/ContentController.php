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
use AppBundle\Entity\Content;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\DBAL\DBALException;

class ContentController extends Controller{
    /**
     * @Route("/course/contentcreate")
     * @Method("POST")
     */
    public function ContentAction(Request $request) {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');

        $coursecontent = new Content();
        
        $content = $request->getContent();
        $param = json_decode($content,true);
        $jsonContent = $serializer->serialize($param, 'json');
        $coursecontent = $serializer->deserialize($jsonContent, 'AppBundle\Entity\Content', 'json');
        
        $curdate = new \DateTime("now");
        $coursecontent->setCCreatedate($curdate);
        $coursecontent->setCModifydate($curdate);
        
        try{
            $em = $this->getDoctrine()->getManager();
            if ($coursecontent->getCId() == 0){
                $em->persist($coursecontent);
                $em->flush();
            }
            else{
                $existcontent = new Content();
                $existcontent = $em->getRepository('AppBundle:Content')
                ->find($coursecontent->getCId());
                
                $existcontent->setLId($coursecontent->getLId());
                $existcontent->setCImg($coursecontent->getCImg());
                $existcontent->setCNote($coursecontent->getCNote());
                $existcontent->setCTitle($coursecontent->getCTitle());
                $existcontent->setCVideo($coursecontent->getCVideo());
                $existcontent->setCCreatedate($curdate);
                $existcontent->setCModifydate($curdate);
                $em->flush();
        }
        }catch (DBALException $e)
        {
            return $response->setData(array("status"=>"fail","message"=>$e->getMessage()));
        }
        
        return $response->setData(array("status"=>"success","message"=>$coursecontent->getCId()));
        
    }
    
    /**
     * @Route("/course/contentdelete")
     * @Method("GET")
     */
    public function deleteAction(Request $request){
        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');
 	 
        $id = $request->query->get("id");
        $uid = $request->query->get("uid");

        try{
            $em = $this->getDoctrine()->getManager();
            $existcontent = new Content();
            $existcontent = $em->getRepository('AppBundle:Content')
                ->find($id);
            if(is_null($existcontent)){
                return $response->setData(array("status"=> "fail","message"=>"Content not exists."));
            }

            $curdate = new \DateTime("now");
            $em->remove($existcontent);
            $em->flush();
        }catch (DBALException $e)
        {
            return $response->setData(array("status"=>"fail","message"=>"Delete not success."));
        }

        return $response->setData(array("status"=>"success","message"=>"Successfully Deleted."));
    }
    
    /**
     * @Route("/course/listcontent")
     * @Method("GET")
     */
    public function listContentAction(){
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
                
        $response = new JsonResponse();
	$response->headers->set('Access-Control-Allow-Origin', '*');
        
        $em = $this->getDoctrine()->getManager();
        $contentlist = $em->getRepository('AppBundle:Content')
            ->listcontent();   
        
        $jsonContent = $serializer->serialize($contentlist, 'json');
                        
        if(is_null($contentlist)){
            return $response->setData(array("status"=>"fail","message"=>"No lists to show"));
        }else{
	      return $response->setContent($jsonContent);
        }     
    }
    
    /**
     * @Route("/course/listcontent2")
     * @Method("GET")
     */
    public function listContent2Action(){
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
                
        $response = new JsonResponse();
	$response->headers->set('Access-Control-Allow-Origin', '*');
        
        $em = $this->getDoctrine()->getManager();
        $contentlist = $em->getRepository('AppBundle:Content')
            ->listcontent2();   
        
        $jsonContent = $serializer->serialize($contentlist, 'json');
                        
        if(is_null($contentlist)){
            return $response->setData(array("status"=>"fail","message"=>"No lists to show"));
        }else{
	      return $response->setContent($jsonContent);
        }     
    }
}

//ALTER TABLE elearning.content
//    ADD  FOREIGN KEY (l_id)
//      REFERENCES elearning.lesson(l_id)
//      ON UPDATE CASCADE ON DELETE RESTRICT;
