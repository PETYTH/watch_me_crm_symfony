<?php

namespace App\Controller;

use App\Entity\Stocks;
use App\Form\StocksType;
use App\Repository\StocksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/stocks')]
class StocksController extends AbstractController
{
    #[Route('/', name: 'app_stocks_index', methods: ['GET'])]
    public function index(StocksRepository $stocksRepository): JsonResponse
    {
        return $this->json([
            'stocks' => $stocksRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_stocks_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $stock = new Stocks();
        $stock->setNumero($decoded->numero);
        $stock->setNombre($decoded->nombre);

        $form = $this->createForm(StocksType::class, $stock);
        $form->submit((array) $decoded);

        if ($form->isValid()) {
            $entityManager->persist($stock);
            $entityManager->flush();

            return $this->json([
                'success' => true,
                'message' => 'Le nouveau stock a été ajouté avec succès.',
            ]);
        }

        return $this->json([
            'success' => false,
            'message' => 'La création du stock a échoué. Veuillez vérifier les données fournies.',
        ]);
    }

    #[Route('/{id}', name: 'app_stocks_show', methods: ['GET'])]
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

    #[Route('/{id}/edit', name: 'app_stocks_edit', methods: ['POST'])]
    public function edit(Request $request, Stocks $stock, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $stock->setNumero($decoded->numero);
        $stock->setNombre($decoded->nombre);

        $form = $this->createForm(StocksType::class, $stock);
        $form->submit((array) $decoded);

        if ($form->isValid()) {
            $entityManager->flush();

            return $this->json([
                'success' => true,
                'message' => 'Les informations du stock ont été mises à jour avec succès.',
            ]);
        }

        return $this->json([
            'success' => false,
            'message' => 'La mise à jour du stock a échoué. Veuillez vérifier les données fournies.',
        ]);
    }

    #[Route('/{id}', name: 'app_stocks_delete', methods: ['POST'])]
    public function delete(Request $request, Stocks $stock, EntityManagerInterface $entityManager): JsonResponse
    {
        if ($this->isCsrfTokenValid('delete'.$stock->getId(), $request->request->get('_token'))) {
            $entityManager->remove($stock);
            $entityManager->flush();

            return $this->json([
                'success' => true,
                'message' => 'Le stock a été supprimé avec succès.',
            ]);
        }

        return $this->json([
            'success' => false,
            'message' => 'La suppression du stock a échoué. Veuillez vérifier le jeton CSRF.',
        ]);
    }
}
