<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity;
use App\Entity\Ingrediant;
use App\Entity\Receipt;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ReceiptController extends AbstractController
{
    /**
     * @Route("/receipt_list", methods={"GET"}, name="app_homepage")
     * 
     */ 
    public function index() {

        $receipt= $this->getDoctrine()->getRepository
        (Receipt::class)->findAll();

        return $this->render('receipt/index.html.twig', array ('receipt' => $receipt));
     }
    
    /**
     * @Route("/receipt/add", name="receipt_add")
     */
    public function addReceipt(Request $request) {

        $receipt = new Receipt();

        $form = $this->createFormBuilder($receipt)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('instruction', TextareaType::class)
            ->add('preparation', NumberType::class)
            ->add('preparation', NumberType::class)
            ->add('preparation', NumberType::class)
            ->add('level',      NumberType::class)
            ->add('picture', FileType::class)
            ->add('ingrediants', EntityType::class, array(
                'class'=>'App\Entity\Ingrediant',
                'choice_label'=>'name',
                'expanded'=>false,
                'multiple'=>false
            ))
            ->add('save', SubmitType::class, ['label' => 'Add Receipt'])
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                
                $receipt = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($receipt);
                $entityManager->flush();
                return $this->redirectToRoute('receipt_list');
            }

            return $this->render('receipt/new.html.twig', [
                'form' => $form->createView(),
            ]);
    }


     /**
     * @Route("/receipt/update/{id}", methods={"GET", "POST"}, name="receipt_update")
     */
    public function updateReceipt(Request $request, $id) {

        $receipt = new Receipt();
        $receipt = $this->getDoctrine()->getRepository
       (Receipt::class)->find($id);
        $form = $this->createFormBuilder($receipt)
        ->add('name', TextType::class)
        ->add('description', TextType::class)
        ->add('instruction', TextareaType::class)
        ->add('preparation', NumberType::class)
        ->add('preparation', NumberType::class)
        ->add('preparation', NumberType::class)
        ->add('level',      NumberType::class)
        ->add('picture', FileType::class)
        ->add('ingrediants', EntityType::class, array(
            'class'=>'App\Entity\Ingrediant',
            'choice_label'=>'name',
            'expanded'=>false,
            'multiple'=>false
        ))
        ->add('save', SubmitType::class, ['label' => 'Update Receipt'])
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
        
                return $this->redirectToRoute('receipt_list');
            }

            return $this->render('receipt/update.html.twig', [
                'form' => $form->createView(),
            ]);
    }



    /**
     * @Route("/receipt/{id}", name="receipt_show")
     */ 
    public function showReceipt($id) {
       $receipt = $this->getDoctrine()->getRepository
       (Receipt::class)->find($id);

       return $this->render('receipt/show.html.twig', array 
       ('receipt' => $receipt));
      
    }
    

    /**
     * @Route("/receipt/delete/{id}", methods={"DELETE"}, name="receipt_delete")
     * 
     */ 

    public function deleteReceipt(Request $request, $id){
    $receipt= $this->getDoctrine()-> getRepository(Receipt::class)->find($id);
    
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($receipt);
    $entityManager->flush();

    $response = new Response();
    $response->send();

    }
}
