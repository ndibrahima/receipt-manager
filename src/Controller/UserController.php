<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormTypeInterface;
use App\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserController extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('username', TextType::class)
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }

    /**
	 * @Route("/user", name="user_list")
	 * @param UserRepository $userRepository
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
    public function index(UserRepository $userRepository)
    {
        $user= $this->getDoctrine()->getRepository
        (User::class)->findAll();

        return $this->render('user/index.html.twig', array ('user' => $user));
    }

	/**
	 * @Route("user/{id}", name="user_show")
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function show($id)
	{
		$user = $this->getDoctrine()
			->getRepository(User::class)
			->find($id);

		return $this->render('user/show.html.twig', [
			'user' => $user
		]);
    }

    /**
     * @Route("/user/update/{id}", methods={"GET", "POST"}, name="user_update")
     */
    public function updateUser(Request $request, $id) {

        $user = new User();
        $user = $this->getDoctrine()->getRepository
       (User::class)->find($id);

        $form = $this->createFormBuilder($user)
        ->add('username', TextType::class)
        ->add('password', PasswordType::class)
        ->add('email', EmailType::class)
        ->add('save', SubmitType::class, ['label' => 'Modifier'])
        ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
        
                return $this->redirectToRoute('user_list');
            }

            return $this->render('user/update.html.twig', [
                'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/user/delete/{id}", methods={"DELETE"}, name="user_delete")
     * 
     */ 

    public function deleteUser(Request $request, $id){
        $user = $this->getDoctrine()-> getRepository(User::class)->find($id);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();
    
        $response = new Response();
        $response->send();
    
        }
    
    
}
