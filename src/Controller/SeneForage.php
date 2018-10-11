<?php
namespace App\Entity;
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Compteur;
use App\Entity\Abonnement;
use App\Entity\Village;
use App\Entity\Client;
use App\Entity\Facture;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Form\AbonnementType;
use App\Form\VillageType;
use App\Form\ClientType;
use App\Form\FactureType;


class SeneForage extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'SeneForage',
        ]);
    }
 /**
     * @Route("/clients", name="clients")
     */
public function clients(Request $request, ObjectManager $manager ){
            $client=new Client();
           // $client=new Client();
          //  $form = $this->createFormBuilder()
                           /* ->add('numero_client', TextType::class)
                            ->add('nom_client', TextType::class)
                            ->add('telephone', TextType::class)
                            ->add('numero_village', TextType::class)
                            ->add('nom_village', TextType::class)
                            ->add('nom_chefvillage', TextType::class)
                             ->add('prenom_chefvillage', TextType::class)
                             ->add('telephone', TextType::class)*
                           // ->add('new \DateTime()')
                            //->add('enregistre',SubmitType::class, ['label'=>'Enregistrer'])
           // ->add('save', SubmitType::class, array('label' => 'Create Task'))
                            ->getForm();*/
           $form=$this->createForm(ClientType::class, $client);
            $form->handleRequest($request);
            //dump($compteur);
            if ($form->isSubmitted() && $form->isValid()) {
               // $abonnement->setDateAbonnement(new \DateTime());s
                $manager->persist($client);
                $manager->flush();
                # code...
            }

           // $form->handleRequest($request);
          //  dump($client);
           /* if ($form->isSubmitted() && $form->isValid()) {
               // $compteur->setDateReleve(new \DateTime());
                $manager->persist($client);
                $manager->persist($village);
               
                # code...
            }
             $manager->flush(); */
return $this->render('blog/clients.html.twig',['formClient' =>$form->createView() 
            ]);
        }
    /** 
    * @Route("/abonnes", name="abonnes")
      * @Route("/abonnes/{id}", name="edit")
    */
    public function abonnes(Abonnement $abonnement=null, Request $request, ObjectManager $manager ){
/*Gestion des abonnement*/
      // $client=new Client();
                      if (!$abonnement) {
                            $abonnement=new Abonnement();
                                }

          /*  $form = $this->createFormBuilder($abonnement)
                            ->add('numero_abonnement', TextType::class)
                            ->add('Description', TextType::class)
                            ->add('date_abonnement', DateType::class)
                            ->add('client', EntityType::class, [
                                'class'=>Client::class,  'choice_label' => 'numero_client'])
                            
                            //->add('enregistre',SubmitType::class, ['label'=>'Enregistrer'])
           // ->add('save', SubmitType::class, array('label' => 'Create Task'))
                            ->getForm();*/
            $form=$this->createForm(AbonnementType::class, $abonnement);
            $form->handleRequest($request);
            //dump($compteur);
            if ($form->isSubmitted() && $form->isValid()) {
               // $abonnement->setDateAbonnement(new \DateTime());s
                $manager->persist($abonnement);
                $manager->flush();
                # code...
            }
    	return $this->render('blog/abonnes.html.twig',['formAbonnement' =>$form->createView(),
            'modifierbouton'=>$abonnement->getId() !==null
            
            ]);
    }
    /** 
    * @Route("/consommation", name="consommation")
    */

    public function consommation(Request $request, ObjectManager $manager ){
            $compteur=new Compteur();
            $form = $this->createFormBuilder($compteur)
                            ->add('Numero_compteur', TextType::class)
                            ->add('Ancien_Releve', TextType::class)
                            ->add('Nouveau_Releve', TextType::class)
                            ->add('date_releve', DateType::class)
                           // ->add('new \DateTime()')
                            ->add('Consommation',TextType::class)
                            ->add('abonnement', EntityType::class, [
                                'class'=>Abonnement::class,  'choice_label' => 'numero_abonnement'])
                            //->add('enregistre',SubmitType::class, ['label'=>'Enregistrer'])
           // ->add('save', SubmitType::class, array('label' => 'Create Task'))
                            ->getForm();
            $form->handleRequest($request);
            //dump($compteur);
            if ($form->isSubmitted() && $form->isValid()) {
               // $compteur->setDateReleve(new \DateTime());
                $manager->persist($compteur);
                $manager->flush();
                # code...
            }



        /*    $compteur->setNumeroCompteur($request->request->get('numero_compteur'))
                      ->setAncienReleve($request->request->get('ancien_releve'))
                      ->setNouveauReleve($request->request->get('nouveau_releve'))
                      ->setDateReleve($request->request->get('date_releve'))
                      ->setConsommation($request->request->get('consommation'));
            $manager->persist($compteur);
            $manager->flush();
*/

    	return $this->render('blog/consommation.html.twig',['formCompteur' =>$form->createView()
            ]);
    }
  

      /** 
    * @Route("/facture", name="facture")
      * @Route("/facture/{id}", name="modifier")
    */
    public function facturation(Facture $facture=null, Request $request, ObjectManager $manager ){
      
                      if (!$facture) {
                            $facture=new Facture();
                                }

    //Creation du formulaire Facture
            $form=$this->createForm(FactureType::class, $facture);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager->persist($facture);
                $manager->flush();
            }
      return $this->render('blog/facturation.html.twig',['formFacturation' =>$form->createView(),
            'changerbouton'=>$facture->getId() !==null
            
            ]);
    }
}
