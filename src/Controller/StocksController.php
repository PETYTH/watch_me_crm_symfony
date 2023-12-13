<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Entity\Stocks;
use App\Repository\StocksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', 'api_')]
class StocksController extends AbstractController
{
    #[Route('/all_stocks', name: 'app_stocks_index', methods: ['GET'])]
    public function index(StocksRepository $stocksRepository): JsonResponse
    {
        return $this->Json([
            'stocks' => $stocksRepository->findAll(),
        ]);
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
        return $this->json([
            'stock' => [
                'id' => $stock->getId(),
                'numero' => $stock->getNumero(),
                'nombre' => $stock->getNombre(),
            ],
        ]);
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
