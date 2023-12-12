<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Entity\Stocks;
use App\Form\ProduitsType;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class ProduitsController extends AbstractController
{
    private $serializer;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    #[Route('/all_produits', name: 'app_produits_index', methods: ['GET'])]
    public function index(ProduitsRepository $produitsRepository): Response
    {
        $produits = $produitsRepository->findAll();

        $context = SerializationContext::create()->setGroups([
            'produit_id',
            'produit_nom',
            'produit_prix',
            'produit_image',
            'produit_produit_stock',
            'default',
        ]);

        $produitsJson = $this->serializer->serialize($produits, 'json', $context);

        return new Response($produitsJson, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/new_produit', name: 'app_produits_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $produit = new Produits();
        $produitStockId = $entityManager->getRepository(Stocks::class)->find($decoded->produit_stock_id);
        $produit->setProduitStock($produitStockId);
        $produit->setNom($decoded->nom);
        $produit->setPrix($decoded->prix);
        $produit->setImage($decoded->image);

        $entityManager->persist($produit);
        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'Le nouveau produit a été ajouté avec succès.',
        ]);
    }

    #[Route('/{id}/show_produit', name: 'app_produits_show', methods: ['GET'])]
    public function show(Produits $produit): JsonResponse
    {
        $context = SerializationContext::create()->setGroups([
            'produit_id',
            'produit_nom',
            'produit_prix',
            'produit_image',
            'produit_produit_stock',
            'default',
        ]);

        $produitJson = $this->serializer->serialize($produit, 'json', $context);

        return new JsonResponse(['produit' => json_decode($produitJson)], JsonResponse::HTTP_OK, ['Content-Type' => 'application/json']);
    }


    #[Route('/{id}/edit_produit', name: 'app_produits_edit', methods: ['POST'])]
    public function edit(Request $request, Produits $produit, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $produitStockId = $entityManager->getRepository(Stocks::class)->find($decoded->produit_stock_id);
        $produit->setProduitStock($produitStockId);
        $produit->setNom($decoded->nom);
        $produit->setPrix($decoded->prix);
        $produit->setImage($decoded->image);

        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'Les informations du produit ont été mises à jour avec succès.',
        ]);
    }

    #[Route('/{id}/delete_produit', name: 'app_produits_delete', methods: ['POST'])]
    public function delete(Produits $produit, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($produit);
        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'Le produit a été supprimé avec succès.',
        ]);
    }
}
