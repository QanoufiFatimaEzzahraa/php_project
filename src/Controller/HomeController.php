<?php

// src/Controller/RegistrationController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface; // Importer l'interface EntityManagerInterface

use App\Entity\Event;
use App\Repository\EventRepository;
use App\Form\EventType;
use App\Form\DateTime;
use DateTimeImmutable;

class HomeController extends AbstractController{

    #[Route('/home', name:"app_home")]
    public function index():Response{


        return $this->render('home/index.html.twig');
    }

}