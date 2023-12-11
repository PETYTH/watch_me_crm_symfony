<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Commandes;
use App\Enum\CommandeStatus;
use App\Form\CommandesType;
use App\Repository\CommandesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class CommandesController extends AbstractController
{
    #[Route('/all_commandes', name: 'app_commandes_index', methods: ['GET'])]
    public function index(CommandesRepository $commandesRepository): JsonResponse
    {
        return $this->json([
            'commandes' => $commandesRepository->findAll(),
        ]);
    }

    #[Route('/new_commande', name: 'app_commandes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $date = \DateTime::createFromFormat('d-m-Y', $decoded->date)->format('Y-m-d');

        $commande = new Commandes();
        $commandeClientId = $entityManager->getRepository(Client::class)->find($decoded->commande_client_id);
        $commande->setCommandeClient($commandeClientId);
        $commande->setNumero($decoded->numero);
        $commande->setDate(new \DateTime($date));
        $commande->setPaiement($decoded->paiement);
        $commande->setAdresse($decoded->adresse);
        $commande->setCodePostal($decoded->code_postal);
        $commande->setVille($decoded->ville);
        $selectedStatus = $decoded->status[0] ?? CommandeStatus::en_cours;
        $commande->setStatus($selectedStatus);

        $entityManager->persist($commande);
        $entityManager->flush();

        return $this->json([
            'Message' => 'La nouvelle commande a été ajoutée avec succès.',
        ]);
    }


    #[Route('/{id}/show_commande', name: 'app_commandes_show', methods: ['GET'])]
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
        ], 200, [], ['groups' => 'commande']);
    }


    #[Route('/{id}/edit_commande', name: 'app_commandes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commandes $commande, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $date = \DateTime::createFromFormat('d-m-Y', $decoded->date)->format('Y-m-d');

        $commandeClientId = $entityManager->getRepository(Client::class)->find($decoded->commande_client_id);
        $commande->setCommandeClient($commandeClientId);
        $commande->setNumero($decoded->numero);
        $commande->setDate(new \DateTime($date));
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

    #[Route('/{id}/delete_commande', name: 'app_commandes_delete', methods: ['POST'])]
    public function delete(Request $request, Commandes $commande, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($commande);
        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'La commande a été supprimée avec succès.',
        ]);
    }

}
