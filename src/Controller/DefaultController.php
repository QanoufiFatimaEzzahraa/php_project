<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/choix-type-compte', name: 'choix_type_compte')]
    public function choixTypeCompte(): Response
    {
        return $this->render('comptes\choix_type_compte.html.twig');
    }

    #[Route('/options_compte_bancaire', name: 'options_compte_bancaire')]
    public function choixCompteBancaire(): Response
    {
        return $this->render('comptes\options_compte_bancaire.html.twig');
    }

    #[Route('/modifierId', name: 'modifierId', methods:['GET', 'POST'])]
    public function modifierId(Request $request): Response
    {   if ($request->isMethod('POST')){
        $compteId = $request->request->get('compte_id');
        return $this->redirectToRoute('comptes_bancaires_modifier', ['id' => $compteId]);
    }
    return $this->render('comptes/modiferId.html.twig');
        
    }

    #[Route('/supprimerId', name: 'supprimerId', methods:['GET', 'POST'])]
    public function supprimerId(Request $request): Response
    {   if ($request->isMethod('POST')){
        $compteId = $request->request->get('compte_id');
        return $this->redirectToRoute('comptes_bancaires_supprimer', ['id' => $compteId]);
    }
    return $this->render('comptes/supprimerId.html.twig');
        
    }




    
    #[Route('/options_compte_caisse', name: 'options_compte_caisse')]
    public function choixCompteCaisse(): Response
    {
        return $this->render('comptes/options_compte_caisse.html.twig');
    }

    #[Route('/modifierId', name: 'modifier_Id', methods:['GET', 'POST'])]
    public function modifier_Id(Request $request): Response
    {   if ($request->isMethod('POST')){
        $compteId = $request->request->get('compte_id');
        return $this->redirectToRoute('comptes_caisses_modifier', ['id' => $compteId]);
    }
    return $this->render('comptes/modiferId_caisse.html.twig');
        
    }

    #[Route('/supprimerId', name: 'supprimer_Id', methods:['GET', 'POST'])]
    public function supprimer_Id(Request $request): Response
    {   if ($request->isMethod('POST')){
        $compteId = $request->request->get('compte_id');
        return $this->redirectToRoute('comptes_caisses_supprimer', ['id' => $compteId]);
    }
    return $this->render('comptes/supprimerId_caisse.html.twig');
        
    }





    #[Route('/options_compte_credit', name: 'options_compte_credit')]
    public function choixCompteCredit(): Response
    {
        return $this->render('comptes/options_compte_credit.html.twig');
    }

    #[Route('/modifierIdCredit', name: 'modifier_Id_credit', methods:['GET', 'POST'])]
    public function modifier_Id_credit(Request $request): Response
    {   
        if ($request->isMethod('POST')){
            $compteId = $request->request->get('compte_id');
            return $this->redirectToRoute('comptes_credits_modifier', ['id' => $compteId]);
        }
        return $this->render('comptes/modiferId_credit.html.twig');
    }

    #[Route('/supprimerIdCredit', name: 'supprimer_Id_credit', methods:['GET', 'POST'])]
    public function supprimer_Id_credit(Request $request): Response
    {   
        if ($request->isMethod('POST')){
            $compteId = $request->request->get('compte_id');
            return $this->redirectToRoute('comptes_credits_supprimer', ['id' => $compteId]);
        }
        return $this->render('comptes/supprimerId_credit.html.twig');
    }
}
