<?php

namespace ApprentisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ApprentisBundle\Entity\Ville;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

class VilleController extends Controller
{
	public function indexAction()
    {
        $monEnregistrement = $this->getDoctrine()->getManager();
		
		$mesVilles = $monEnregistrement->getRepository('ApprentisBundle:Ville')->findBy(array(),array('vilLibelle'=>'asc'));
		//$mesVilles = $monEnregistrement->getRepository('ApprentisBundle:Ville')->findAll();

        return $this->render('@Apprentis/Ville/index.html.twig', array('mesVilles' =>$mesVilles));
    }
	
	public function viewAction($id, Request $request)
    {
		$monEnregistrement = $this->getDoctrine()->getManager();
		
		$maVille = $monEnregistrement->getRepository('ApprentisBundle:Ville')->find($id);
		
		$formVilleAdd=$this->get('form.factory')->createBuilder(FormType::class,$maVille);
		
		$formVilleAdd
			->add('vil_cp', TextType::class, array('disabled' => 'true'))
			->add('vil_libelle',TextType::class, array('disabled' => 'true'))
			->add('Modifier',SubmitType::class)
			->add('Supprimer',SubmitType::class)
		;
			
		$formView = $formVilleAdd->getForm();	

		if($request->isMethod('POST')){
			$formView->handleRequest($request);
			if($formView->isValid()){
				if(isset($_POST['form']['Modifier'])){
					return $this->redirectToRoute('Ville_update',array('id' => $id));
				}
				else{
					return $this->redirectToRoute('Ville_delete',array('id' => $id));
				}
			}
			
			
		}
		
        return $this->render('@Apprentis/Ville/view.html.twig', array('formView'=>$formView->createView(),'maVille'=>$maVille));
    }
	
	
	public function addAction(Request $request)
    {
		$maVille = new Ville();
		
		$formVilleAdd=$this->get('form.factory')->createBuilder(FormType::class,$maVille);
		
		$formVilleAdd
			->add('vil_cp', TextType::class)
			->add('vil_libelle',TextType::class)
			->add('Enregistrer',SubmitType::class)
		;
			
		$form = $formVilleAdd->getForm();
		
		
		
		if($request->isMethod('POST')){
			$form->handleRequest($request);
			if($form->isValid()){
				$monEnregistrement = $this->getDoctrine()->getManager();
				$monEnregistrement->persist($maVille);
				$monEnregistrement->flush();
				
				$request->getSession()->getFlashBag()->add('Ville','enregistrement ok');
				
				return $this->redirectToRoute('Ville_index');
			}
			
		}
		
        return $this->render('@Apprentis/Ville/add.html.twig', array('form'=>$form->createView()));
    }
	
	public function updateAction($id, Request $request)
    {	
		$monEnregistrement = $this->getDoctrine()->getManager();
		
		$maVille = $monEnregistrement->getRepository('ApprentisBundle:Ville')->find($id);
		
		$formVilleAdd=$this->get('form.factory')->createBuilder(FormType::class,$maVille);
		
		$formVilleAdd
			->add('vil_cp', TextType::class)
			->add('vil_libelle',TextType::class)
			->add('Enregistrer',SubmitType::class)
		;
			
		$form = $formVilleAdd->getForm();
		
		
		if($request->isMethod('POST')){
			$form->handleRequest($request);
			if($form->isValid()){
				$monEnregistrement = $this->getDoctrine()->getManager();
				$monEnregistrement->persist($maVille);
				$monEnregistrement->flush();
				
				$request->getSession()->getFlashBag()->add('Ville','enregistrement ok');
				
				return $this->redirectToRoute('Ville_index');
			}
			
		}
		
        return $this->render('@Apprentis/Ville/update.html.twig', array('form'=>$form->createView()));
    }
		
	public function deleteAction($id,Request $request)
    {
		$monEnregistrement = $this->getDoctrine()->getManager();
		
		$maVille = $monEnregistrement->getRepository('ApprentisBundle:Ville')->find($id);
		
		$monEnregistrement->remove($maVille);
		$monEnregistrement->flush();
		
		return $this->redirectToRoute('Ville_index');
    }
}
