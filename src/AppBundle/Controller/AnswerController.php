<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use AppBundle\Entity\Answer;
use AppBundle\DAO\QueryDAO;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\DBAL\DBALException;

class AnswerController extends Controller {
     /**
     * @Route("/student/answercreate")
     * @Method("POST")
     */
    public function AnswerAction(Request $request) {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');

        $answer = new Answer();
//        $answer->getAId();
//        $answer->setLId($lId);
//        $answer->setQId($qId);
//        $answer->setUId($uId);
//        $answer->setAAnswer($aAnswer);
//        $answer->setACreatedate($aCreatedate);
//        $answer->setACreateuid($aCreateuid);
//        $answer->setAModifyuid($aModifyuid);
//        $answer->setAModifydate($aModifydate);
        
        $content = $request->getContent();
        $param = json_decode($content,true);
        $jsonContent = $serializer->serialize($param, 'json');
        $answer = $serializer->deserialize($jsonContent, 'AppBundle\Entity\Answer', 'json');
        
        $curdate = new \DateTime("now");
        $answer->setACreatedate($curdate);
        $answer->setAModifydate($curdate);
        
        try{
            $em = $this->getDoctrine()->getManager();
            if ($answer->getAId() == 0){
                $em->persist($answer);
                $em->flush();
            }
            else{
                $existanswer = new Answer();
                $existanswer = $em->getRepository('AppBundle:Answer')
                ->findbyanswer($answer->getLId(),$answer->getQId(),$answer->getUId());
                
                if(is_null($existanswer)){
                    return $response->setData(array("status"=> "fail","message"=>$existanswer->getLId()));
                }
                
                $existanswer->setAAnswer($answer->getAAnswer());
                $existanswer->setAModifyuid($answer->getAModifyuid());
                $existanswer->setAModifydate($curdate);
                $em->flush();
        }
        }catch (DBALException $e)
        {
            return $response->setData(array("status"=>"fail","message"=>$e->getMessage()));
        }
        
        return $response->setData(array("status"=>"success","message"=>$answer->getAId()));
        
    }
    
    /**
     * @Route("/student/answerdelete")
     * @Method("GET")
     */
    public function deleteAction(Request $request){
        $response = new JsonResponse();
        $response->headers->set('Access-Control-Allow-Origin','*');
 	 
        $id = $request->query->get("id");
        $uid = $request->query->get("uid");

        try{
            $em = $this->getDoctrine()->getManager();
            $existanswer = new Answer();
            $existanswer = $em->getRepository('AppBundle:Answer')
                ->find($id);
            if(is_null($existquestion)){
                return $response->setData(array("status"=> "fail","message"=>"Answer not exists."));
            }

            $curdate = new \DateTime("now");
            $em->remove($existanswer);
            $em->flush();
        }catch (DBALException $e)
        {
            return $response->setData(array("status"=>"fail","message"=>"Delete not success."));
        }

        return $response->setData(array("status"=>"success","message"=>"Successfully Deleted."));
    }
    
    /**
     * @Route("/student/listanswer")
     * @Method("GET")
     */
    public function listContentAction(){
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
                
        $response = new JsonResponse();
	$response->headers->set('Access-Control-Allow-Origin', '*');
        
        $em = $this->getDoctrine()->getManager();
        $answerlist = $em->getRepository('AppBundle:Answer')
            ->listanswer();   
        
        $jsonContent = $serializer->serialize($answerlist, 'json');
                        
        if(is_null($answerlist)){
            return $response->setData(array("status"=>"fail","message"=>"No lists to show"));
        }else{
	      return $response->setContent($jsonContent);
        }     
    }
    
    /**
     * @Route("/student/studentresult")
     * @Method("GET")
     */
    public function studentresultAction(Request $request){
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
                
        $response = new JsonResponse();
	$response->headers->set('Access-Control-Allow-Origin', '*');
        
        $uid = $request->query->get("uid");
        $lid = $request->query->get("lid");
        $con = $this->getDoctrine()->getEntityManager()->getConnection();
        $qDAO = new QueryDAO($con);
        $studentresult = $qDAO->studentresult($uid,$lid);
        $jsonContent = $serializer->serialize($studentresult, 'json');
                        
        if(is_null($studentresult)){
            return $response->setData(array("status"=>"fail","message"=>"No lists to show"));
        }else{
	      return $response->setContent($jsonContent);
        }     
    }
}
