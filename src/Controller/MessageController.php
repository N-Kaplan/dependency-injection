<?php

namespace App\Controller;

use App\Entity\Input;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Transform;
use App\Services\Capitalizer;
use App\Services\Dasher;
use App\Services\Master;
use App\Services\Logger;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MessageController extends AbstractController
{
    private Transform $capitalizer;
    private Transform $dasher;
    private Logger $logger;

    /**
     * @param Transform $capitalizer
     * @param Transform $dasher
     */
    public function __construct(Transform $capitalizer, Transform $dasher, Logger $logger)
    {
        $this->capitalizer = $capitalizer;
        $this->dasher = $dasher;
        $this->logger = $logger;
    }


    #[Route('/', name: 'message')]
    public function index(Request $request): Response
    {
        $master = new Master($this->capitalizer, $this->dasher, $this->logger);

        $input = new Input();
        $output = $input->getInputText();
        $transformation = $input->getTransformation();

        $form = $this->createFormBuilder()
            ->add('message', TextType::class)
            ->add('transformation', ChoiceType::class, [
                'choices' => [
                    'Capitalize odd letters' => 'capitalize',
                    'Dashes replace spaces' => 'dash'
                ]
            ])
            ->add('save', SubmitType::class, ['label' => 'Submit'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $input = $form->getData();
            var_dump($input);


        }

        return $this->renderForm('message/index.html.twig', [
            'form' => $form,
//            'transformation' => $transformation,
//            'output' => $output,
        ]);

//        return $this->render('message/index.html.twig', [
//            'controller_name' => 'MessageController',
//        ]);
    }
}
