<?php

namespace App\Controller;

use App\Entity\Commandes;
use App\Form\CommandesType;
use App\Repository\CommandesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commandes')]
class CommandesController extends AbstractController
{
    #[Route('/', name: 'app_commandes_index', methods: ['GET'])]
    public function index(CommandesRepository $commandesRepository): JsonResponse
    {
        return $this->json([
            'commandes' => $commandesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_commandes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $commande = new Commandes();
        $commande->setNumero($decoded->numero);
        $commande->setDate(DateTimeImmutable::createFromFormat('Y-m-d', $decoded->date));
        $commande->setPaiement($decoded->paiement);
        $commande->setAdresse($decoded->adresse);
        $commande->setCodePostal($decoded->code_postal);
        $commande->setVille($decoded->ville);
        $commande->setStatus($decoded->status);

        $entityManager->persist($commande);
        $entityManager->flush();

        return $this->json([
            'Message' => 'La nouvelle commande a été ajoutée avec succès.',
        ]);
    }


    #[Route('/{id}', name: 'app_commandes_show', methods: ['GET'])]
    public function show(Commandes $commande): JsonResponse
    {
        return $this->json([
            'commande' => [
                'id' => $commande->getId(),
                'commande_client_id' => $commande->getCommandeClient(),
                'numero' => $commande->getNumero(),
                'date' => $commande->getDate()->format('Y-m-d'),
                'paiement' => $commande->getPaiement(),
                'adresse' => $commande->getAdresse(),
                'code_postal' => $commande->getCodePostal(),
                'ville' => $commande->getVille(),
                'status' => $commande->getStatus(),
            ],
        ]);
    }


    #[Route('/{id}/edit', name: 'app_commandes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commandes $commande, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $commande->setCommandeClient($decoded->commande_client_id);
        $commande->setNumero($decoded->numero);
        $commande->setDate(DateTime::createFromFormat('Y-m-d', $decoded->date));
        $commande->setPaiement($decoded->paiement);
        $commande->setAdresse($decoded->adresse);
        $commande->setCodePostal($decoded->code_postal);
        $commande->setVille($decoded->ville);
        $commande->setStatus($decoded->status);

        $entityManager->flush();

        return $this->json([
            'Message' => 'Les informations de la commande ont été mises à jour avec succès.',
        ]);
    }

    #[Route('/{id}', name: 'app_commandes_delete', methods: ['POST'])]
    public function delete(Request $request, Commandes $commande, EntityManagerInterface $entityManager): JsonResponse
    {
        if ($this->isCsrfTokenValid('delete'.$commande->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commande);
            $entityManager->flush();

            return $this->json([
                'success' => true,
                'message' => 'La commande a été supprimée avec succès.',
            ]);
        }

        return $this->json([
            'success' => false,
            'message' => 'La suppression de la commande a échoué. Veuillez vérifier le jeton CSRF.',
        ]);
    }

}
