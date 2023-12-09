<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ProduitsType;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produits')]
class ProduitsController extends AbstractController
{
    #[Route('/', name: 'app_produits_index', methods: ['GET'])]
    public function index(ProduitsRepository $produitsRepository): JsonResponse
    {
        return $this->json([
            'produits' => $produitsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_produits_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $produit = new Produits();
        $produit->setProduitStock($decoded->produit_stock_id);
        $produit->setNom($decoded->nom);
        $produit->setPrix($decoded->prix);
        $produit->setImage($decoded->image);

        $form = $this->createForm(ProduitsType::class, $produit);
        $form->submit((array) $decoded);

        if ($form->isValid()) {
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->json([
                'success' => true,
                'message' => 'Le nouveau produit a été ajouté avec succès.',
            ]);
        }

        return $this->json([
            'success' => false,
            'message' => 'La création du produit a échoué. Veuillez vérifier les données fournies.',
        ]);
    }

    #[Route('/{id}', name: 'app_produits_show', methods: ['GET'])]
    public function show(Produits $produit): JsonResponse
    {
        return $this->json([
            'produit' => [
                'id' => $produit->getId(),
                'produit_stock_id' => $produit->getProduitStock(),
                'nom' => $produit->getNom(),
                'prix' => $produit->getPrix(),
                'image' => $produit->getImage(),
            ],
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produits_edit', methods: ['POST'])]
    public function edit(Request $request, Produits $produit, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $produit->setProduitStock($decoded->produit_stock_id);
        $produit->setNom($decoded->nom);
        $produit->setPrix($decoded->prix);
        $produit->setImage($decoded->image);

        $form = $this->createForm(ProduitsType::class, $produit);
        $form->submit((array) $decoded);

        if ($form->isValid()) {
            $entityManager->flush();

            return $this->json([
                'success' => true,
                'message' => 'Les informations du produit ont été mises à jour avec succès.',
            ]);
        }

        return $this->json([
            'success' => false,
            'message' => 'La mise à jour du produit a échoué. Veuillez vérifier les données fournies.',
        ]);
    }

    #[Route('/{id}', name: 'app_produits_delete', methods: ['POST'])]
    public function delete(Request $request, Produits $produit, EntityManagerInterface $entityManager): JsonResponse
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();

            return $this->json([
                'success' => true,
                'message' => 'Le produit a été supprimé avec succès.',
            ]);
        }

        return $this->json([
            'success' => false,
            'message' => 'La suppression du produit a échoué. Veuillez vérifier le jeton CSRF.',
        ]);
    }
}
