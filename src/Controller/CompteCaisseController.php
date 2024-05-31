<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CompteCaisse;
use App\Repository\CompteCaisseRepository;
use App\Form\CompteCaisseType;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Builder\Method;

class CompteCaisseController extends AbstractController
{
    private $entityManager;
    private $compteCaisseRepository;

    public function __construct(EntityManagerInterface $entityManager, CompteCaisseRepository $compteCaisseRepository)
    {
        $this->entityManager = $entityManager;
        $this->compteCaisseRepository = $compteCaisseRepository;
    }

    #[Route('/comptes-caisses', name: 'comptes_caisses')]
    public function index(): Response
    {   
        $comptes = $this->compteCaisseRepository->findAll();

        return $this->render('compte_caisse/index.html.twig', [
            'comptes' => $comptes,
        ]);
    }

    #[Route('/comptes/caisses/ajouter', name: 'comptes_caisses_ajouter', methods:['GET', 'POST'])]
    public function ajouterCompteCaisse(Request $request): Response
    {
        $compteCaisse = new CompteCaisse();
        $compteCaisse->setDateCreation(new \DateTime());
        $compteCaisse->setUpdatedAt(new \DateTime());
        $form = $this->createForm(CompteCaisseType::class, $compteCaisse);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($compteCaisse);
            $this->entityManager->flush();
            return $this->redirectToRoute('comptes_caisses');
        }

        return $this->render('compte_caisse/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/comptes/caisses/{id}/modifier', name: 'comptes_caisses_modifier', methods: ['GET', 'POST'])]
    public function modifierCompteCaisse($id, Request $request): Response
    {
        $compteCaisse = $this->compteCaisseRepository->find($id);

        if (!$compteCaisse) {
            throw $this->createNotFoundException('Le compte de caisse avec cet ID n\'existe pas.');
        }
        $compteCaisse->setUpdatedAt(new \DateTime());
        $form = $this->createForm(CompteCaisseType::class, $compteCaisse);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('comptes_caisses');
        }

        return $this->render('compte_caisse/modifier.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/comptes/caisses/{id}/supprimer', name: 'comptes_caisses_supprimer', methods: ['GET', 'POST'])]
    public function supprimerCompteCaisse($id, Request $request): Response
    {
        $compteCaisse = $this->compteCaisseRepository->find($id);

        if (!$compteCaisse) {
            throw $this->createNotFoundException('Le compte de caisse avec cet ID n\'existe pas.');
        }
        if ($request->isMethod('POST')){
            $compteCaisse = $this->compteCaisseRepository->find($id);
            $this->entityManager->remove($compteCaisse);
            $this->entityManager->flush();
            return $this->redirectToRoute('comptes_caisses');
        }
        
        return $this->render('compte_caisse/confirm_delete.html.twig', ['item' => ['id' => $id]]);
    }
}
