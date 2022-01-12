<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Transform;
use App\Services\Capitalizer;
use App\Services\Dasher;
use App\Services\Master;
use App\Services\Logger;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MessageController extends AbstractController
{
    private Transform $capitalizer;
    private Transform $dasher;

    /**
     * @param Transform $capitalizer
     * @param Transform $dasher
     */
    public function __construct(Transform $capitalizer, Transform $dasher)
    {
        $this->capitalizer = $capitalizer;
        $this->dasher = $dasher;
    }


    #[Route('/', name: 'message')]
    public function index(): Response
    {
        $form = $this->createFormBuilder()
            ->add('Message', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Submit'])
            ->getForm();


        return $this->renderForm('message/index.html.twig', [
            'form' => $form,
        ]);

//        return $this->render('message/index.html.twig', [
//            'controller_name' => 'MessageController',
//        ]);
    }
}
