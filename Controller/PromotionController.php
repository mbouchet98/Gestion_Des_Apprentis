<?php

namespace ApprentisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ApprentisBundle\Entity\Promotion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

class PromotionController extends Controller
{
	public function indexAction($id = 0)
    {
		//echo $id;
        $monEnregistrement = $this->getDoctrine()->getManager();
		
		$mesProm = $monEnregistrement->getRepository('ApprentisBundle:Promotion')->findBy(array(),array('proPromotion'=>'asc'));
		//$mesProm = $monEnregistrement->getRepository('ApprentisBundle:Promotion')->find($id);
		/*foreach($mesProm as $unepromo){
			echo $unepromo->getProPromotion();
		}*/
		//$mesVilles = $monEnregistrement->getRepository('ApprentisBundle:Ville')->findAll();
		/*echo('<pre>');
		print_r($mesProm->getInsApprenti());
		echo('</pre>');*/
        return $this->render('@Apprentis/Promotion/index.html.twig', array('mesProm' =>$mesProm));
		
    }
	
	public function viewAction($id, Request $request)
    {
		$monEnregistrement = $this->getDoctrine()->getManager();
		
		$maProm = $monEnregistrement->getRepository('ApprentisBundle:Promotion')->find($id);
		
		$formPromAdd=$this->get('form.factory')->createBuilder(FormType::class,$maProm);
		
		$formPromAdd
			->add('pro_promotion', IntegerType::class, array('disabled' => 'true'))
			->add('Modifier',SubmitType::class)
			->add('Supprimer',SubmitType::class)
		;
			
		$formView = $formPromAdd->getForm();	

		if($request->isMethod('POST')){
			$formView->handleRequest($request);
			if($formView->isValid()){
				if(isset($_POST['form']['Modifier'])){
					return $this->redirectToRoute('Promotion_update',array('id' => $id));
				}
				else{
					return $this->redirectToRoute('Promotion_delete',array('id' => $id));
				}
			}
			
			
		}
		
        return $this->render('@Apprentis/Promotion/view.html.twig', array('formView'=>$formView->createView(),'maProm'=>$maProm));
    }
	
	public function addAction(Request $request)
    {
		$maProm = new Promotion();
		
		$formPromAdd=$this->get('form.factory')->createBuilder(FormType::class,$maProm);
		
		$formPromAdd
			->add('pro_promotion', IntegerType::class,array(
                 'widget' => 'choice',
                 'years' => range(date('Y'), date('Y')+100)
               ))
			->add('pro_promotion', IntegerType::class)
			->add('Enregistrer',SubmitType::class)
		;
			
		$form = $formPromAdd->getForm();
		
		
		
		if($request->isMethod('POST')){
			$form->handleRequest($request);
			if($form->isValid()){
				$monEnregistrement = $this->getDoctrine()->getManager();
				$monEnregistrement->persist($maProm);
				$monEnregistrement->flush();
				
				$request->getSession()->getFlashBag()->add('Promotion','enregistrement ok');
				
				return $this->redirectToRoute('Promotion_index');
			}
			
		}
		
        return $this->render('@Apprentis/Promotion/add.html.twig', array('form'=>$form->createView()));
    }
	
	public function updateAction($id, Request $request)
    {	
		$monEnregistrement = $this->getDoctrine()->getManager();
		
		$maProm = $monEnregistrement->getRepository('ApprentisBundle:Promotion')->find($id);
		
		$formPromAdd=$this->get('form.factory')->createBuilder(FormType::class,$maProm);
		
		$formPromAdd
			->add('pro_promotion', IntegerType::class)
			->add('Enregistrer',SubmitType::class)
		;
			
		$form = $formPromAdd->getForm();
		
		
		if($request->isMethod('POST')){
			$form->handleRequest($request);
			if($form->isValid()){
				$monEnregistrement = $this->getDoctrine()->getManager();
				$monEnregistrement->persist($maProm);
				$monEnregistrement->flush();
				
				$request->getSession()->getFlashBag()->add('Promotion','enregistrement ok');
				
				return $this->redirectToRoute('Promotion_index');
			}
			
		}
		
        return $this->render('@Apprentis/Promotion/update.html.twig', array('form'=>$form->createView()));
    }
	
	
	public function deleteAction($id,Request $request)
    {
		$monEnregistrement = $this->getDoctrine()->getManager();
		
		$maProm = $monEnregistrement->getRepository('ApprentisBundle:Promotion')->find($id);
		
		$monEnregistrement->remove($maProm);
		$monEnregistrement->flush();
		
		return $this->redirectToRoute('Promotion_index');
    }
}
