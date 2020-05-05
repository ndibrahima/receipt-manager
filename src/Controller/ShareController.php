<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SwiftmailerBundle\Swiftmailer;
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
use App\Form\ShareType;
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
    public function index(Request $request, \Swift_Mailer $mailer) {  
    
   
    $form = $this->createForm(ShareType::class);
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
        $share = $form->getData(); 

        $message = (new \Swift_Message('Hello Receipt'))

        //on attribut l'expéditeur
        ->setFrom('ouibay666@gmail.com')

        // on attribut le destinataire
        ->setTo($share['email'])

        //on crée body du message avec la vue Twig
         ->setBody(
             $this->renderView(
                 'emails/share.html.twig', compact('share')
             ),
             'text/html'
          )
          ;  
          //on envoie le message
          $mailer->send($message);

          $this->addFlash('message', 'Le message a été bien envoyé');
          return $this->redirectToRoute('app_homepage');
    }

    return $this->render('share/index.html.twig', [
        'shareForm' => $form->createView(),
        
    ]);

            
}   
    
}
