<?php

namespace Urbanet\CvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Urbanet\CvBundle\Entity\CVArt;
use Urbanet\CvBundle\Form\CVArtType;
use Urbanet\CvBundle\Entity\Spectacle;
use Urbanet\CvBundle\Form\SpectacleType;

class DefaultController extends Controller
{
    public function cvAction()
    {
        return $this->render('UrbanetCvBundle:Default:cv.html.twig');
    }
    
    public function voirAction($id)
    {
        if(!$id)
            return $this->redirect($this->generateUrl("urbanet_cv_ajouter"));
            
        $em = $this->getDoctrine()->getEntityManager();
        $CVArt = $em->getRepository("UrbanetCvBundle:CVArt")->findOneById($id);

        $Spectacle = $CVArt->getSpectacle();
        if(isset($Spectacle)){
        foreach($Spectacle as $Spectacle){
            $Spectacle->getId();
            }
        }

        return $this->render('UrbanetCvBundle:Default:voir.html.twig', array(
            'CVArt' => $CVArt,
            'Spectacle' => $Spectacle->getId(),
            ));
        
    }        


    public function ajouterAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $CVArt = new CVArt();
        $form = $this->createForm(new CVArtType(), $CVArt);
        $request = $this->getRequest();
        
        if($request->isMethod('POST'))
        {
            $form->bindRequest($request);
            
            if ($form->isValid()){

                $CVArt = $form->getData();
                $em->persist($CVArt);
                $em->flush();
            
                return $this->redirect($this->generateUrl("urbanet_cv_voir", array(
                            'id' => $CVArt->getId(),	
                            )));
            }
            
        }
        
        
        return $this->render('UrbanetCvBundle:Default:ajouter.html.twig', array(
            'id'   => $CVArt->getId(),
            'form' => $form->createView(),
        ));
    }

    public function editerAction(CVArt $CVArt)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm(new CVArtType(), $CVArt);
        $request = $this->getRequest();
        
        if($request->isMethod('POST'))
        {
            $form->bindRequest($request);
            
            if ($form->isValid()){

                $CVArt = $form->getData();
                $em->persist($CVArt);
                $em->flush();
            
                return $this->redirect(
                		$this->generateUrl("urbanet_cv_voir", array(
                            'id' => $CVArt->getId(),    
                            )));
            }
        }
            
        return $this->render('UrbanetCvBundle:Default:editer.html.twig', array(
            'id'   => $CVArt->getId(),
            'form' => $form->createView(),
        ));
    }



    public function ajouter_spectacleAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $Spectacle = new Spectacle();
        $CVArt = $em->getRepository("UrbanetCvBundle:CVArt")->findOneById($id);

        $form = $this->createForm(new SpectacleType(), $Spectacle);
        $request = $this->getRequest();
        
        if($request->isMethod('POST'))
        {
            $form->bindRequest($request);
            
            if ($form->isValid()){

                $Spectacle = $form->getData();
                $em->persist($Spectacle);
                $CVArt->addSpectacle($Spectacle);
                $Spectacle->addCVArt($CVArt);

                $em->flush();
            
                return $this->redirect($this->generateUrl("urbanet_cv_voir", array(
                            'id' => $CVArt->getId(),    
                            )));
            }
            
        }
       return $this->render('UrbanetCvBundle:Default:ajouter_spectacle.html.twig', array(
            'id'   => $CVArt->getId(),
            'form' => $form->createView(),
        ));
   }

    public function editer_spectacleAction(Spectacle $Spectacle)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm(new SpectacleType(), $Spectacle);
        $request = $this->getRequest();

        $CVArt=$Spectacle->getCVArt();
        foreach ($CVArt as $CVArt){
            $CVArt->getId();
        }

        if($request->isMethod('POST'))
        {
            $form->bindRequest($request);
            
            if ($form->isValid()){

                $Spectacle = $form->getData();
                $em->persist($Spectacle);
                $em->flush();

                $CVArt=$Spectacle->getCVArt();
                foreach ($CVArt as $CVArt){
                    $CVArt->getId();
                }
                return $this->redirect(
                        $this->generateUrl("urbanet_cv_voir", array(
                            'id' =>$CVArt->getId(),    
                            )));
            }
        }
        
        return $this->render('UrbanetCvBundle:Default:editer_spectacle.html.twig', array(
            'CVArtId' => $CVArt->getId(),  
            'SpectacleId' => $Spectacle->getId(),
            'form' => $form->createView(),
        ));
    }
}
