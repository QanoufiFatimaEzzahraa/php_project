<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CompteBancaire;
use App\Repository\CompteBancaireRepository;
use App\Form\CompteBancaireType;
use Doctrine\ORM\EntityManagerInterface; 

class CompteBancaireController extends AbstractController
{
    private $entityManager;
    private $compteBancaireRepository;

    public function __construct(EntityManagerInterface $entityManager, CompteBancaireRepository $compteBancaireRepository)
    {
        $this->entityManager = $entityManager;
        $this->compteBancaireRepository = $compteBancaireRepository;
    }

    #[Route('/comptes-bancaires', name: 'comptes_bancaires')]
    public function index(): Response
    {
        $comptes = new CompteBancaire();
        $comptes = $this->compteBancaireRepository->findAll();

        return $this->render('compte_bancaire/index.html.twig', [
            'comptes' => $comptes,
        ]);
    }

    #[Route('/comptes/bancaires/ajouter', name: 'comptes_bancaires_ajouter')]
public function ajouterCompteBancaire(Request $request): Response
{
    $compteBancaire = new CompteBancaire();
    
    $compteBancaire->setDateCreation(new \DateTime());
    $compteBancaire->setUpdatedAt(new \DateTime());
    
    $form = $this->createForm(CompteBancaireType::class, $compteBancaire);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $this->entityManager->persist($compteBancaire);
        $this->entityManager->flush();
        return $this->redirectToRoute('comptes_bancaires');
    }

    return $this->render('compte_bancaire/ajouter.html.twig', [
        'form' => $form->createView(),
    ]);
}


    #[Route('/comptes/bancaires/{id}/modifier', name: 'comptes_bancaires_modifier', methods:['GET', 'POST'])]
public function modifierCompteBancaire($id, Request $request, CompteBancaireRepository $compteBancaireRepository, EntityManagerInterface $entityManager): Response
{
    $compteBancaire = $compteBancaireRepository->find($id);

    if (!$compteBancaire) {
        throw $this->createNotFoundException('Le compte bancaire avec cet ID n\'existe pas.');
    }
    $compteBancaire->setUpdatedAt(new \DateTime()); 
    $form = $this->createForm(CompteBancaireType::class, $compteBancaire);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();
        return $this->redirectToRoute('comptes_bancaires');
    }

    return $this->render('compte_bancaire/modifier.html.twig', [
        'form' => $form->createView(),
    ]);
}

    #[Route('/comptes/bancaires/{id}/supprimer', name: 'comptes_bancaires_supprimer', methods:['GET', 'POST'])]
    public function supprimerCompteBancaire($id, Request $request, CompteBancaireRepository $compteBancaireRepository, EntityManagerInterface $entityManager): Response
    {   
        if ($request->isMethod('POST')){
            $compteBancaire = $compteBancaireRepository->find($id);
            $entityManager->remove($compteBancaire);
            $entityManager->flush();

            return $this->redirectToRoute('comptes_bancaires');
        }
        
        return $this->render('compte_bancaire/confirm_delete.html.twig', ['item' => ['id' => $id]]);
    }

    
}
