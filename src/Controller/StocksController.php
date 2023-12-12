<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Entity\Stocks;
use App\Form\StocksType;
use App\Repository\StocksRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class StocksController extends AbstractController
{
    private $serializer;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    #[Route('/all_stocks', name: 'app_stocks_index', methods: ['GET'])]
    public function index(StocksRepository $stocksRepository): Response
    {
        $stocks = $stocksRepository->findAll();

        $context = SerializationContext::create()->setGroups([
            'stock_id',
            'stock_numero',
            'stock_nombre',
            'stock_produit',
            'default',
        ]);

        $stocksJson = $this->serializer->serialize($stocks, 'json', $context);

        return new Response($stocksJson, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/new_stock', name: 'app_stocks_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $stock = new Stocks();
        $stock->setNumero($decoded->numero);
        $stock->setNombre($decoded->nombre);

        $entityManager->persist($stock);
        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'Le nouveau stock a été ajouté avec succès.',
        ]);

    }

    #[Route('/{id}/show_stock', name: 'app_stocks_show', methods: ['GET'])]
    public function show(Stocks $stock): JsonResponse
    {
        $context = SerializationContext::create()->setGroups([
            'stock_id',
            'stock_numero',
            'stock_nombre',
            'stock_produit',
            'default',
        ]);

        $stockJson = $this->serializer->serialize($stock, 'json', $context);

        return new JsonResponse(['stock' => json_decode($stockJson)], JsonResponse::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/{id}/edit_stock', name: 'app_stocks_edit', methods: ['POST'])]
    public function edit(Request $request, Stocks $stock, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $stock->setNumero($decoded->numero);
        $stock->setNombre($decoded->nombre);

        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'Les informations du stock ont été mises à jour avec succès.',
        ]);
    }

    #[Route('/{id}/delete_stock', name: 'app_stocks_delete', methods: ['POST'])]
    public function delete(Request $request, Stocks $stock, EntityManagerInterface $entityManager): JsonResponse
    {
        $produit = $entityManager->getRepository(Produits::class)->findOneBy(['produit_stock' => $stock]);

        if ($produit) {
            $entityManager->remove($produit);
        }
        $entityManager->remove($stock);
        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'Le stock a été supprimé avec succès.',
        ]);
    }
}
