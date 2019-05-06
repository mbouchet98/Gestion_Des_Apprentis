<?php

namespace ApprentisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ApprentisBundle\Entity\Apprenti;
use ApprentisBundle\Entity\Promotion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ApprentisController extends Controller
{
	public function indexAction()
    {
        $monEnregistrement = $this->getDoctrine()->getManager();
		// affiche tout les promos
		$lesPromo = $monEnregistrement->getRepository('ApprentisBundle:Promotion')->findAll();
		// affiche tout les apprentis
		$mesApp = $monEnregistrement->getRepository('ApprentisBundle:Apprenti')->findBy(array(),array('appNom'=>'asc'));
		// recupe une promotion par rapport au select
		//$laPromotion = $monEnregistrement->getRepository('ApprentisBundle:Promotion')->findOneBy('proPromotion'=>$unePromo);
		// affiche les apprentis par promotion
		$maProm = $monEnregistrement->getRepository('ApprentisBundle:Promotion')->findOneBy(array('proPromotion'=>2020));
		//$maProm = $monEnregistrement->getRepository('ApprentisBundle:Promotion')->findByInsApprenti($laPromotion);
		
        
		return $this->render('@Apprentis/Apprentis/index.html.twig', array('lesPromo'=>$lesPromo, 'mesApp' =>$mesApp, 'maProm'=>$maProm));
    }
	
	public function viewAction($id, Request $request)
    {
		$monEnregistrement = $this->getDoctrine()->getManager();
		
		$monApp = $monEnregistrement->getRepository('ApprentisBundle:Apprenti')->find($id);
		//$lesPromo = $monEnregistrement->getRepository('ApprentisBundle:Promotion')->findAll();
		//$mesVilles = $monApp->getRepository('ApprentisBundle:Ville')->findBy(array('maville' => $monApp));
		
		$formAppAdd=$this->get('form.factory')->createBuilder(FormType::class,$monApp);
		
		$formAppAdd
			->add('app_nom', TextType::class, array('disabled' => 'true'))
			->add('app_prenom',TextType::class, array('disabled' => 'true'))
			->add('app_rue', TextType::class, array('disabled' => 'true'))
			->add('app_complement',TextType::class, array('disabled' => 'true'))
			->add('app_datenaissance', BirthdayType::class, array('disabled' => 'true'))
			->add('app_telephone',TextType::class, array('disabled' => 'true'))
			->add('app_mail', TextType::class, array('disabled' => 'true'))
			->add('app_ville', EntityType::class, array('class' => 'ApprentisBundle:Ville','choice_label' => function ($ville) {
				return $ville->getVilLibelle(); },'disabled' => 'true' ))
			->add('app_lieu_naissance', EntityType::class, array('class' => 'ApprentisBundle:Ville','choice_label' => function ($ville) {
				return $ville->getVilLibelle(); },'disabled' => 'true'))
			->add('app_titre',EntityType::class, array('class' => 'ApprentisBundle:Titre','choice_label' => function ($titre) {
				return $titre->getTitLibelle(); },'disabled' => 'true'))
			->add('app_promotion',EntityType::class, array('class' => 'ApprentisBundle:Promotion','choice_label' => function ($lesPromo) {
				return $Promotion->getProPromotion(); },'disabled' => 'true'))
			->add('Modifier',SubmitType::class)
			->add('Supprimer',SubmitType::class)
		;
			
		$formView = $formAppAdd->getForm();	

		if($request->isMethod('POST')){
			$formView->handleRequest($request);
			if($formView->isValid()){
				if(isset($_POST['form']['Modifier'])){
					return $this->redirectToRoute('Apprentis_update',array('id' => $id));
				}
				else{
					return $this->redirectToRoute('Apprentis_delete',array('id' => $id));
				}
			}
			
			
		}
		
        return $this->render('@Apprentis/Apprentis/view.html.twig', array('formView'=>$formView->createView(),'mesApp'=>$monApp));
    }
	
	public function addAction(Request $request)
    {
		$momApprenti = new Apprenti();
		
		$formApprentiAdd=$this->get('form.factory')->createBuilder(FormType::class,$momApprenti);
		
		$formApprentiAdd
			->add('app_nom', TextType::class)
			->add('app_prenom',TextType::class)
			->add('app_rue', TextType::class)
			->add('app_complement',TextType::class, array('required' => false))
			->add('app_datenaissance', BirthdayType::class)
			->add('app_telephone',TextType::class)
			->add('app_mail', TextType::class)
			->add('app_ville', EntityType::class, array('class' => 'ApprentisBundle:Ville','choice_label' => function ($ville) {return $ville->getVilLibelle(); }))
			->add('app_lieu_naissance', EntityType::class, array('class' => 'ApprentisBundle:Ville','choice_label' => function ($ville) {return $ville->getVilLibelle();}))
			->add('app_titre',EntityType::class, array('class' => 'ApprentisBundle:Titre','choice_label' => function ($titre) {return $titre->getTitLibelle(); }))
			->add('Enregistrer',SubmitType::class)
		;
			
		$form = $formApprentiAdd->getForm();
		
		$maProm = new Promotion();
		$formPromotion = $this->get('form.factory')->createBuilder(FormType::class,$maProm);
		$formPromotion->add('pro_promotion',EntityType::class, array('class' => 'ApprentisBundle:Promotion','choice_label' => function ($Promotion) {return $Promotion->getProPromotion(); }));
		$form2 = $formPromotion->getForm();
		
		if($request->isMethod('POST')){
			$form->handleRequest($request);
			if($form->isValid()){
				$monEnregistrement = $this->getDoctrine()->getManager();
				$monEnregistrement->persist($momApprenti);
				$monEnregistrement->flush();
				
				$request->getSession()->getFlashBag()->add('Apprenti','enregistrement ok');
				
				//$maProm->addInsApprenti($monApprenti);
				//echo $maProm->getProPromotion();
				
				//return $this->redirectToRoute('Apprentis_index');
			}
			
		}
		
        return $this->render('@Apprentis/Apprentis/add.html.twig', array('form'=>$form->createView(),'form2'=>$form2->createView()));
    }
	
	public function updateAction($id, Request $request)
    {	
		$monEnregistrement = $this->getDoctrine()->getManager();
		
		$momApprenti = $monEnregistrement->getRepository('ApprentisBundle:Apprenti')->find($id);
		
		$formAppAdd=$this->get('form.factory')->createBuilder(FormType::class,$momApprenti);
		
		$formAppAdd
			->add('app_nom', TextType::class)
			->add('app_prenom',TextType::class)
			->add('app_rue', TextType::class)
			->add('app_complement',TextType::class, array('required' => false))
			->add('app_datenaissance', BirthdayType::class)
			->add('app_telephone',TextType::class)
			->add('app_mail', TextType::class)
			->add('app_ville', EntityType::class, array('class' => 'ApprentisBundle:Ville','choice_label' => function ($ville) {return $ville->getVilLibelle(); }))
			->add('app_lieu_naissance', EntityType::class, array('class' => 'ApprentisBundle:Ville','choice_label' => function ($ville) {return $ville->getVilLibelle();}))
			->add('app_titre',EntityType::class, array('class' => 'ApprentisBundle:Titre','choice_label' => function ($titre) {return $titre->getTitLibelle(); }))
			->add('Enregistrer',SubmitType::class)
		;
			
		$form = $formAppAdd->getForm();
		
		
		if($request->isMethod('POST')){
			$form->handleRequest($request);
			if($form->isValid()){
				$monEnregistrement = $this->getDoctrine()->getManager();
				$monEnregistrement->persist($momApprenti);
				$monEnregistrement->flush();
				
				$request->getSession()->getFlashBag()->add('Apprenti','enregistrement ok');
				
				return $this->redirectToRoute('Apprentis_index');
			}
			
		}
		
        return $this->render('@Apprentis/Apprentis/update.html.twig', array('form'=>$form->createView()));
    }
	
	public function deleteAction($id,Request $request)
    {
		$monEnregistrement = $this->getDoctrine()->getManager();
		
		$mesApp = $monEnregistrement->getRepository('ApprentisBundle:Apprenti')->find($id);
		
		$monEnregistrement->remove($mesApp);
		$monEnregistrement->flush();
		
		return $this->redirectToRoute('Apprentis_index');
    }
}
