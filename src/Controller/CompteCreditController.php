<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CompteCredit;
use App\Repository\CompteCreditRepository;
use App\Form\CompteCreditType;
use Doctrine\ORM\EntityManagerInterface;

class CompteCreditController extends AbstractController
{
    private $entityManager;
    private $compteCreditRepository;

    public function __construct(EntityManagerInterface $entityManager, CompteCreditRepository $compteCreditRepository)
    {
        $this->entityManager = $entityManager;
        $this->compteCreditRepository = $compteCreditRepository;
    }

    #[Route('/comptes-credits', name: 'comptes_credits')]
    public function index(): Response
    {
        $comptes = $this->compteCreditRepository->findAll();

        return $this->render('compte_credit/index.html.twig', [
            'comptes' => $comptes,
        ]);
    }

    #[Route('/comptes/credits/ajouter', name: 'comptes_credits_ajouter')]
    public function ajouter(Request $request): Response
    {
        $compteCredit = new CompteCredit();

        $compteCredit->setCreatedAt(new \DateTime());
        $compteCredit->setUpdatedAt(new \DateTime());

        $form = $this->createForm(CompteCreditType::class, $compteCredit);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($compteCredit);
            $this->entityManager->flush();
            return $this->redirectToRoute('comptes_credits');
        }

        return $this->render('compte_credit/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/comptes/credits/{id}/modifier', name: 'comptes_credits_modifier', methods: ['GET', 'POST'])]
    public function modifier($id, Request $request): Response
    {
        $compteCredit = $this->compteCreditRepository->find($id);

        if (!$compteCredit) {
            throw $this->createNotFoundException('Le compte de crédit avec cet ID n\'existe pas.');
        }

        $form = $this->createForm(CompteCreditType::class, $compteCredit);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compteCredit->setUpdatedAt(new \DateTime());

            $this->entityManager->flush();
            return $this->redirectToRoute('comptes_credits');
        }

        return $this->render('compte_credit/modifier.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/comptes/credits/{id}/supprimer', name: 'comptes_credits_supprimer', methods: ['GET','POST'])]
    public function supprimer($id, Request $request): Response
    {
        $compteCredit = $this->compteCreditRepository->find($id);

        if (!$compteCredit) {
            throw $this->createNotFoundException('Le compte de crédit avec cet ID n\'existe pas.');
        }
        
        if ($request->isMethod('POST')){
            $compteCredit = $this->compteCreditRepository->find($id);
            $this->entityManager->remove($compteCredit);
            $this->entityManager->flush();
            return $this->redirectToRoute('comptes_credits');
        }

    
        return $this->render('compte_credit/confirm_delete.html.twig', ['item' => ['id' => $id]]);
    }

 
}
