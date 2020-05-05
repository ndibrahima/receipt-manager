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
use Knp\Component\Pager\PaginatorInterface; 


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
    public function ReceiptAll(Request $request, PaginatorInterface $paginator) {

        $receipt= $this->getDoctrine()->getRepository
        (Receipt::class)->findAll();

        $receipt = $paginator->paginate(
        $receipt, // Requête contenant les données à paginer (ici nos articles)
        $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
        6 // Nombre de résultats par page
        );

        return $this->render('receipt/allreceipt.html.twig', array ('receipt' => $receipt));
     }

     /**
     * @Route("/bestreceipt", methods={"GET"}, name="app_bestreceipt")
     * 
     */ 
    public function BestReceipt(Request $request, PaginatorInterface $paginator) {

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
    public function updateReceipt(Request $request, $id, cacheManager $cacheManager, UploaderHelper $helper) {

        $receipt = new Receipt();
        $receipt = $this->getDoctrine()->getRepository
       (Receipt::class)->find($id);
        $form = $this->createFormBuilder($receipt)
        ->add('name', TextType::class, array('data_class' => null))
        ->add('description', TextType::class, array('data_class' => null))
        ->add('instruction', TextareaType::class, array('data_class' => null))
        ->add('preparation', NumberType::class, array('data_class' => null))
        ->add('preparation', TextareaType::class, array('data_class' => null))
        ->add('level',      NumberType::class, array('data_class' => null))
        ->add('picture', FileType::class, array('data_class' => null))
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
}
