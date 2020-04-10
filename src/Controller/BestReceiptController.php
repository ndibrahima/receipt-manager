<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BestReceiptController extends AbstractController
{
    /**
     * @Route("/best/receipt", name="best_receipt")
     */
    public function index()
    {
        return $this->render('best_receipt/index.html.twig', [
            'controller_name' => 'BestReceiptController',
        ]);
    }
}
