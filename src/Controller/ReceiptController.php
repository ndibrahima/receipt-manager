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
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
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
     * @Route("/receipt_list", methods={"GET"}, name="receipt_list")
     * 
     */ 
    public function index() {

        $receipt= $this->getDoctrine()->getRepository
        (Receipt::class)->findAll();

        return $this->render('receipt/index.html.twig', array ('receipt' => $receipt));
     }
     
    /**
     * @Route("/acceuil", methods={"GET"}, name="app_homepage")
     * 
     */ 
    public function ReceiptAll(Request $request) {

        $receipt= $this->getDoctrine()->getRepository
        (Receipt::class)->findAll();

      
        return $this->render('receipt/allreceipt.html.twig', array ('receipt' => $receipt));
     }

     /**
     * @Route("/bestreceipt", methods={"GET"}, name="after_login_route_name")
     * 
     */ 
    public function BestReceipt(Request $request) {

        $receipt= $this->getDoctrine()->getRepository
        (Receipt::class)->findAll();


        return $this->render('receipt/bestreceipt.html.twig', array ('receipt' => $receipt));
     }



    /**
     * @Route("/receipt/add", name="receipt_add")
     */
    public function addReceipt(Request $request) {

        $receipt = new Receipt();

        $form = $this->createFormBuilder($receipt)
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('instruction', TextType::class)
            ->add('preparation', TextareaType::class)
            ->add('level',      NumberType::class)
            ->add('imageFile', FileType::class)
            ->add('ingrediant', EntityType::class, array(
                'class'=>'App\Entity\Ingrediant',
                'choice_label'=>'name',
                'expanded'=>false,
                'multiple'=>true
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
    public function updateReceipt(Request $request, $id, cacheManager $cacheManager, UploaderHelper $helper) {

        $receipt = new Receipt();
        $receipt = $this->getDoctrine()->getRepository
       (Receipt::class)->find($id);
        $form = $this->createFormBuilder($receipt)
        ->add('name', TextType::class, array('data_class' => null))
        ->add('description', TextType::class, array('data_class' => null))
        ->add('instruction', TextareaType::class, array('data_class' => null))
        ->add('preparation', TextareaType::class, array('data_class' => null))
        ->add('level',      NumberType::class, array('data_class' => null))
        ->add('imageFile', FileType::class, array('data_class' => null))
        ->add('ingrediant', EntityType::class, array(
            'class'=>'App\Entity\Ingrediant',
            'choice_label'=>'name',
            'expanded'=>false,
            'multiple'=>true
        ))
        ->add('save', SubmitType::class, ['label' => 'Update Receipt'])
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
        
                return $this->redirectToRoute('receipt_list');
            }

            if ($receipt->getImageFile() instanceof UploadedFile) {
                $cacheManager->remove($helper->asset($receipt.'imageFile'));
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

    //share recipe by id

    /**
     * @Route("receipt/share/{id}", methods={"GET", "POST"}, name="share")
     */
    public function share(Request $request, \Swift_Mailer $mailer, $id) {  
    

        $share = $this->getDoctrine()->getRepository
        (Share::class)->find($id);
    
        $form = $this->createForm(ShareType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $share = $form->getData(); 
    
            $message = (new \Swift_Message('Hello Receipt'))
    
            //Assign sender
            ->setFrom('ouibay666@gmail.com')
    
            // assign recipient
            ->setTo($share['email'])
    
    
            //create the body of message with Twig view
             ->setBody(
                 $this->renderView(
                     'emails/share.html.twig', compact('share')
                 ),
                 'text/html'
              )
              ;  
    
              //send the message
              $mailer->send($message);
              
    
              $this->addFlash('message', 'Your receipt sahre was succesfuly');
              return $this->redirectToRoute('app_homepage');
        }
    
        return $this->render('share/index.html.twig', [
            'shareForm' => $form->createView(), array 
            ('share' => $share)
            
        ]);
    
                
    }   
}
