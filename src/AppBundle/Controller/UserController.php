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
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\DBAL\DBALException;
/**
 * Description of UserController
 *
 * @author yuwah
 */
class UserController extends Controller{
    //put your code here
    /**
     * @Route("/user/register")
     * @Method("POST")
     */
    public function registerAction(Request $request) {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');

        $user = new User();
        $content = $request->getContent();
        $param = json_decode($content,true);
        $jsonContent = $serializer->serialize($param, 'json');
        $user = $serializer->deserialize($jsonContent, 'AppBundle\Entity\User', 'json');
        
        $email = $user->getUEmail();
        $uid = $user->getUId();

        $curdate = new \DateTime("now");
        $user->setUCreatedate($curdate);
        $user->setUModifydate($curdate);
        
        $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
        $user->setUPassword($password);
        
        $em = $this->getDoctrine()->getManager();
        $existuseremail = $em->getRepository('AppBundle:User')
            ->checkmailalreadyexist($email,$uid);
        if(!is_null($existuseremail)){
            return $response->setData(array("status"=>"fail","message"=>"Email already exist."));
        }

        try{
            $existuser = new User();
            $existuser = $em->getRepository('AppBundle:User')
                ->findById($uid);
            if(is_null($existuser)){
                $em->persist($user);
                $em->flush();
            }
            else{
                $existuser->setUName($user->getUName());
                $existuser->setUUserName($user->getUUserName());
                $existuser->setUPhone($user->getUPhone());
                $existuser->setUEmail($user->getUEmail());
                $existuser->setUAddress($user->getUAddress());
                $existuser->setURole($user->getURole());
                $existuser->setUGender($user->getUGender());
                $existuser->setUDob($user->getUDob());
                $existuser->setUActive($user->getUActive());
                $existuser->setUPassword($password);
                $existuser->setUModifydate($curdate);
                $existuser->setUModifyuid($user->getUModifyuid());
                $em->flush();
            }
        }catch (DBALException $e)
        {
            return $response->setData(array("status"=>"fail","message"=>$e->getMessage()));
        }
        
        return $response->setData(array("status"=>"success","message"=>$user->getUId()));
        
    }
    

    /**
     * @Route("/user/login")
     * @Method("GET")
     */
    public function loginAction(Request $request){
        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');
 	
        $user = new User();
        $email = $request->query->get("email");
	    $password = $request->query->get("password");

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')
            ->findByMail($email);      
        
        
        if(is_null($user)){
            return $response->setData(array("status"=> "fail","message"=>"Wrong Email"));            

        }
        else{
            $factory = $this->get('security.encoder_factory');
            
            $encoder = $factory->getEncoder($user);
            $salt = $user->getSalt();

            if($encoder->isPasswordValid($user->getUPassword(), $password, $salt)) {
                return $response->setData(array("status"=>"success","message"=>$user->getUEmail(),"uid"=>$user->getUId(),"urid"=>$user->getURole()));
            } else {
                return $response->setData(array("status"=> "fail","message"=>"Wrong Password",$user->getUPassword()));
            }
            
        }
    }
    
    /**
     * @Route("/user/delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request){
        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');
 	 
        $user = new User();
        $id = $request->query->get("id");
        $uid = $request->query->get("uid");

        try{
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('AppBundle:User')
                ->findById($id);
            if(is_null($user)){
                return $response->setData(array("status"=> "fail","message"=>"User not exists."));
            }

            $curdate = new \DateTime("now");
            $user->setUModifydate($curdate);
            $user->setUModifyuid($uid);
            $user->setUActive(0);
            $em->flush();
        }catch (DBALException $e)
        {
            return $response->setData(array("status"=>"fail","message"=>"Delete not success."));
        }

        return $response->setData(array("status"=>"success","message"=>"Successfully Deleted."));
    }
    
    /**
     * @Route("/user/listuser")
     * @Method("GET")
     */
    public function listUserAction(){
        
        //serialization
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
                
        $response = new JsonResponse();
	    $response->headers->set('Access-Control-Allow-Origin', '*');
        
        $em = $this->getDoctrine()->getManager();
        $userList = $em->getRepository('AppBundle:User')
            ->listuser();   
        
        $jsonContent = $serializer->serialize($userList, 'json');
                        
        if(is_null($userList)){
            return $response->setData(array("status"=>"fail","message"=>"No lists to show"));
        }else{
	      return $response->setContent($jsonContent);
        }     
    }
    
    /**
     * @Route("/user/listbyrole")
     * @Method("GET")
     */
    public function listUserRoleAction(Request $request){

        //serialization
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $urole = $request->query->get("urole");
        $searchtxt = $request->query->get("searchtxt");

        $response = new JsonResponse();
	    $response->headers->set('Access-Control-Allow-Origin', '*');

        $em = $this->getDoctrine()->getManager();
        $userList = $em->getRepository('AppBundle:User')
            ->listbyrole($urole,$searchtxt);

        $jsonContent = $serializer->serialize($userList, 'json');

        if(is_null($userList) || empty($userList)){
            return $response->setData(array("status"=>"fail","message"=>"No lists to show"));
        }else{
            return $response->setContent($jsonContent);
        }
    }
}