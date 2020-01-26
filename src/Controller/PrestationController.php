<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Prestation;
use App\Form\PrestationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ProductType;
use App\Entity\Product;

class PrestationController extends AbstractController
{
    /**
     * @Route("/prestation", name="prestation")
     */
    public function index(Request $request,EntityManagerInterface $em)
    {
        $prestation = new Prestation();
        $form = $this->createForm(PrestationType::class, $prestation);
        $formTest = $this->createForm(ProductType::class);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($prestation);
            $em->flush();
        }
        return $this->render('prestation/index.html.twig', [
            'form' => $form->createView(),
            'form2' => $formTest->createView(), 
        ]);
    }
}
