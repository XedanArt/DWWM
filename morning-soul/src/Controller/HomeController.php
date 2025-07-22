<?php

namespace App\Controller ;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    // une méthode == une page de ton site 
    #[Route("/" , name:"home")]
    public function home()
    {
        return new Response("bonjour"); 
    }

    #[Route("/forum" , name:"forum")]
    public function forum()
    {
        $sujets = [
            "armes",
            "boss",
            "niveaux",
            "farmer"
        ];
        return $this->render("forum/index.html.twig", [ 
            "sujets" => $sujets
         ]);
    }
}