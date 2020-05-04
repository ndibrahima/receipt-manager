<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity;
use App\Entity\Share;
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



class ShareController extends AbstractController
{
    /**
     * @Route("/share", name="share")
     */
    public function index(Request $request)
    {

            $share = new Share();
            $share->setSubject('Receipt');
            $share->setRecipient('Hello friend i share you this receipt from receipt-manager.com');
    
            $form = $this->createFormBuilder($share)
                ->add('subject', TextType::class)
                ->add('recipient', TextType::class)
                ->add('message', TextType::class)
                ->add('user', EntityType::class, array(
                    'class'=>'App\Entity\User',
                    'choice_label'=>'email',
                    'expanded'=>false,
                    'multiple'=>false
                ))
                ->add('save', SubmitType::class, ['label' => 'Share'])
                ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                
                $receipt = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($share);
                $entityManager->flush();
                return $this->redirectToRoute('receipt_list');
            }

            return $this->render('receipt/new.html.twig', [
                'form' => $form->createView(),
            ]);
    
    }
}
