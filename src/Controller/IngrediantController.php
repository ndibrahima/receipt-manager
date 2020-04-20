<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity;
use App\Entity\Receipt;
use App\Entity\Ingrediant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class IngrediantController extends AbstractController
{
    /**
     * @Route("/ingrediant_list", methods={"GET"}, name="ingrediant_list")
     * 
     */ 
    public function index() {

        $ingrediant= $this->getDoctrine()->getRepository
        (Ingrediant::class)->findAll();

        return $this->render('ingrediant/index.html.twig', array ('ingrediant' => $ingrediant));
     }

      /**
     * @Route("/ingrediant/add", name="ingrediant_add")
     */
    public function addIngrediant(Request $request) {

        $ingrediant = new Ingrediant();

        $form = $this->createFormBuilder($ingrediant)
            ->add('name', TextType::class)
            ->add('price', MoneyType::class)
            ->add('save', SubmitType::class, ['label' => 'Add ingrediant'])
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $ingrediant = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($ingrediant);
                $entityManager->flush();
        
                return $this->redirectToRoute('ingrediant_list');
            }

            return $this->render('ingrediant/new.html.twig', [
                'form' => $form->createView(),
            ]);
    }


     /**
     * @Route("/ingrediant/update/{id}", methods={"GET", "POST"}, name="ingrediant_update")
     */
    public function updateIngrediant(Request $request, $id) {

        $ingrediant = new Ingrediant();
        $ingrediant = $this->getDoctrine()->getRepository
       (Ingrediant::class)->find($id);
       

        $form = $this->createFormBuilder($ingrediant)
            ->add('name', TextType::class)
            ->add('price', MoneyType::class)
            ->add('save', SubmitType::class, ['label' => 'Update ingrediant'])
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
        
                return $this->redirectToRoute('ingrediant_list');
            }

            return $this->render('ingrediant/update.html.twig', [
                'form' => $form->createView(),
            ]);
    }



    /**
     * @Route("/ingrediant/{id}", name="ingrediant_show")
     */ 
    public function showIngrediant($id) {
       $ingrediant = $this->getDoctrine()->getRepository
       (Ingrediant::class)->find($id);

       return $this->render('ingrediant/show.html.twig', array 
       ('ingrediant' => $ingrediant));
      
    }
    
    /**
     * @Route("/ingrediant/delete/{id}", methods={"DELETE"}, name="ingrediant_delete")
     * 
     */ 

    public function deleteIngrediant(Request $request, $id){
    $ingrediant = $this->getDoctrine()-> getRepository(Ingrediant::class)->find($id);
    
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($ingrediant);
    $entityManager->flush();

    $response = new Response();
    $response->send();

    }


}
