<?php

namespace App\Controller;

use App\Entity\Expense;
use App\Form\ExpenseType;
use App\Repository\ExpenseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/expense')]
class ExpenseController extends AbstractController
{
    #[Route('/', name: 'expense_index', methods: ['GET'])]
    public function index(ExpenseRepository $expenseRepository): Response
    {
        return $this->render('expense/index.html.twig', [
            'expenses' => $expenseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'expense_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $expense = new Expense();
        $form = $this->createForm(ExpenseType::class, $expense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle file upload
            $receiptFile = $form->get('receipt')->getData();
            if ($receiptFile) {
                $receiptsDirectory = $this->getParameter('receipts_directory');
                $originalFilename = pathinfo($receiptFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = uniqid().'.'.$receiptFile->guessExtension();

                // Move the file to the directory where receipts are stored
                try {
                    $receiptFile->move($receiptsDirectory, $newFilename);
                    $expense->setReceipt($newFilename);
                } catch (FileException $e) {
                    // Handle exception if something happens during file upload
                    $this->addFlash('error', 'Failed to upload receipt.');
                    return $this->redirectToRoute('expense_new');
                }
            }

            $entityManager->persist($expense);
            $entityManager->flush();

            return $this->redirectToRoute('expense_index');
        }

        return $this->render('expense/new.html.twig', [
            'expense' => $expense,
            'form' => $form->createView(),
        ]);
    }

  

    #[Route('/edit/{id}', name: 'expense_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, ExpenseRepository $expenseRepository, $id): Response
    {
        $expense = $expenseRepository->find($id);
        if (!$expense) {
            throw $this->createNotFoundException('Expense not found');
        }

        $form = $this->createForm(ExpenseType::class, $expense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('expense_index');
        }

        return $this->render('expense/edit.html.twig', [
            'expense' => $expense,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'expense_delete', methods: ['POST'])]
    public function delete(Request $request, Expense $expense, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$expense->getId(), $request->request->get('_token'))) {
            $entityManager->remove($expense);
            $entityManager->flush();
        }

        return $this->redirectToRoute('expense_index');
    }
}
