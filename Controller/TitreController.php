<?php

namespace ApprentisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ApprentisBundle\Entity\Titre;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

class TitreController extends Controller
{
	public function indexAction()
    {
        $monEnregistrement = $this->getDoctrine()->getManager();
		
		$mesTitres = $monEnregistrement->getRepository('ApprentisBundle:Titre')->findBy(array(),array('titLibelle'=>'asc'));
		//$mesVilles = $monEnregistrement->getRepository('ApprentisBundle:Ville')->findAll();

        return $this->render('@Apprentis/Titre/index.html.twig', array('mesTitres' =>$mesTitres));
    }
	
	public function viewAction($id, Request $request)
    {
		$monEnregistrement = $this->getDoctrine()->getManager();
		
		$monTitre = $monEnregistrement->getRepository('ApprentisBundle:Titre')->find($id);
		
		$formTitreAdd=$this->get('form.factory')->createBuilder(FormType::class,$monTitre);
		
		$formTitreAdd
			->add('tit_libelle',TextType::class, array('disabled' => 'true'))
			->add('Modifier',SubmitType::class)
			->add('Supprimer',SubmitType::class)
		;
			
		$formView = $formTitreAdd->getForm();	

		if($request->isMethod('POST')){
			$formView->handleRequest($request);
			if($formView->isValid()){
				if(isset($_POST['form']['Modifier'])){
					return $this->redirectToRoute('Titre_update',array('id' => $id));
				}
				else{
					return $this->redirectToRoute('Titre_delete',array('id' => $id));
				}
			}
			
			
		}
		
        return $this->render('@Apprentis/Titre/view.html.twig', array('formView'=>$formView->createView(),'monTitre'=>$monTitre));
    }
	
	
	public function addAction(Request $request)
    {
		$monTitre = new Titre();
		
		$formTitreAdd=$this->get('form.factory')->createBuilder(FormType::class,$monTitre);
		
		$formTitreAdd
			->add('tit_libelle', TextType::class)
			->add('Enregistrer',SubmitType::class)
		;
			
		$form = $formTitreAdd->getForm();
		
		
		
		if($request->isMethod('POST')){
			$form->handleRequest($request);
			if($form->isValid()){
				$monEnregistrement = $this->getDoctrine()->getManager();
				$monEnregistrement->persist($monTitre);
				$monEnregistrement->flush();
				
				$request->getSession()->getFlashBag()->add('Titre','enregistrement ok');
				
				return $this->redirectToRoute('Titre_index');
			}
			
		}
		
        return $this->render('@Apprentis/Titre/add.html.twig', array('form'=>$form->createView()));
    }
	
	public function updateAction($id, Request $request)
    {	
		$monEnregistrement = $this->getDoctrine()->getManager();
		
		$monTitre = $monEnregistrement->getRepository('ApprentisBundle:Titre')->find($id);
		
		$formTitreAdd=$this->get('form.factory')->createBuilder(FormType::class,$monTitre);
		
		$formTitreAdd
			->add('tit_libelle',TextType::class)
			->add('Enregistrer',SubmitType::class)
		;
			
		$form = $formTitreAdd->getForm();
		
		
		if($request->isMethod('POST')){
			$form->handleRequest($request);
			if($form->isValid()){
				$monEnregistrement = $this->getDoctrine()->getManager();
				$monEnregistrement->persist($monTitre);
				$monEnregistrement->flush();
				
				$request->getSession()->getFlashBag()->add('Titre','enregistrement ok');
				
				return $this->redirectToRoute('Titre_index');
			}
			
		}
		
        return $this->render('@Apprentis/Titre/update.html.twig', array('form'=>$form->createView()));
    }
		
	public function deleteAction($id,Request $request)
    {
		$monEnregistrement = $this->getDoctrine()->getManager();
		
		$monTitre = $monEnregistrement->getRepository('ApprentisBundle:Titre')->find($id);
		
		$monEnregistrement->remove($monTitre);
		$monEnregistrement->flush();
		
		return $this->redirectToRoute('Titre_index');
    }
}
