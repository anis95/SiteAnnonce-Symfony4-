<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Annonce;
use App\Entity\Images;
use App\Entity\Categories;
use App\Entity\Region;
use App\Form\AnnonceFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\Common\Persistence\ObjectManager;


class AdController extends AbstractController
{
  /**
     * @Route("/base", name="base")
     */
    public function base()
    {
    	return $this->render('base.html.twig');
    }
    /**
     * @Route("/", name="accueil")
     */
    public function accueil()
    {
        $annonce = $this->getDoctrine()
        ->getRepository(Annonce::class)
        ->findAll();
   

        return $this->render('ad/accueil.html.twig', ['annonce' => $annonce]);
    }

     /**
     * @Route("/location", name="location")
     */
    public function location()
    {
          $repository=$this->getDoctrine()
          ->getRepository(Annonce::class);
          $annonce=$repository->findBy(['categories'=>1]);
       

        return $this->render('ad/location.html.twig', ['annonce' => $annonce]);
      
    }

     /**
     * @Route("/souslocation", name="souslocation")
     */
    public function souslocation()
    {
        $repository=$this->getDoctrine()
        ->getRepository(Annonce::class);
          $annonce=$repository->findBy(['categories'=>2]);
       

        return $this->render('ad/sous-location.html.twig', ['annonce' => $annonce]);
       
    }

    /**
     * @Route("/collocation", name="collocation")
     */
    public function collocation()
    {    $repository=$this->getDoctrine()
        ->getRepository(Annonce::class);
          $annonce=$repository->findBy(['categories'=>3]);
       

    	return $this->render('ad/collocation.html.twig', ['annonce' => $annonce]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */
     public function show($id)
    {   

         $repository=$this->getDoctrine()->getRepository(Annonce::class);
         $annonce=$repository->findBy(['id'=>$id]);
        if ($annonce) {
       return $this->render('ad/aboutannonce.html.twig',['annonce' => $annonce]);
        
    }
      
      
    }

    /**
    * @Route("/delete/{id}",name="delete")  
    * 
    */
    public function supprimerAnnonce($id, ObjectManager $manager)
    {
    $repository = $this->getDoctrine()->getManager()->getRepository(Annonce::class);

    $annonce = $repository->find($id);
    $manager->remove($annonce);
    $manager->flush();
    return $this->redirectToRoute('accueil');
    }

  
    

    /**
     * @Route("/annonce", name="annonce")
     */
    public function index()
    {
        return $this->render('ad/index.html.twig', [
            'controller_name' => 'AdController',
        ]);
    }


   
   /**
     * @Route("/deposerannonce", name="deposerannonce")
     * @Route("/deposerannonce/{id}/modifier", name="edit")
     */
    public function form( Annonce $annonce= null , Request $request , ObjectManager $manager){
            

            if(!$annonce){
                $annonce = new Annonce();
           
            }

            $form = $this->createForm(AnnonceFormType::class, $annonce);
        $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){

           
            $image = new Images();
            
            $image->setName('aa.jpg');
            $image->setAlt('aa');
           


            $annonce->setImages($image);
            $manager->persist($annonce);
            $manager->flush();
            return $this->redirectToRoute('accueil', ['id' => $annonce->getId()]);

       }

        return $this->render('ad/deposerannonce.html.twig' , ['formAnnonce' => $form->createView(), 'editMode' => $annonce->getId()!==null]);
    }
   
  
}
