<?php

namespace App\Controller;

use App\Entity\Input;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Transform;
use App\Services\Capitalizer;
use App\Services\Dasher;
use App\Services\Master;
//use App\Services\Logger;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MessageController extends AbstractController
{
    private Transform $capitalizer;
    private Transform $dasher;
//    private Logger $logger;


    /**
     * @param Transform $capitalizer
     * @param Transform $dasher
//     * @param Logger $logger
     */
    public function __construct(Transform $capitalizer, Transform $dasher)
    {
        $this->capitalizer = $capitalizer;
        $this->dasher = $dasher;
//        $this->logger = $logger;
    }

    #[Route('/', name: 'message')]
    public function index(Request $request): Response
    {
        $input = new Input();
        $output = '';

        //using Monolog Logger: https://github.com/Seldaek/monolog
        $logger = new Logger('MonoLogger');
        $logger->pushHandler(new StreamHandler('../var/log/log.info', Logger::ALERT));
//        $master = new Master($this->capitalizer, $this->dasher, 'test message');

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
            $master = new Master($this->capitalizer, $this->dasher, $input['message']);
            $logger->alert($input['message']);
            $output =  $input['transformation'] === 'capitalize' ? $master->capitalize(): $master->dash();
        }

        return $this->renderForm('message/index.html.twig', [
            'form' => $form,
            'output' => $output,
        ]);
    }
}
