<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController
{
    /**
     * @Route("/hello/world", name="hello_world")
     */
    public function index(): Response
    {
        // get the user information and notifications somehow
        $userFirstName = 'my-awesome-username';
        $userNotifications = ['notification1', 'notifaction2'];

        // the template path is the relative file path from `templates/`
        return $this->render('test/hello-world.html.twig', [
            'user_first_name' => $userFirstName,
            'notifications' => $userNotifications,
        ]);
    }
}
