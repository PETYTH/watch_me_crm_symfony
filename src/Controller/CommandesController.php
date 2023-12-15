<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Commandes;
use App\Entity\Produits;
use App\Enum\CommandeStatus;
use App\Form\CommandesType;
use App\Repository\CommandesRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Monolog\DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class CommandesController extends AbstractController
{
    private $serializer;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    #[Route('/all_commandes', name: 'app_commandes_index', methods: ['GET'])]
    public function index(CommandesRepository $commandesRepository): Response
    {
        $commandes = $commandesRepository->findAll();

        $context = SerializationContext::create()->setGroups([
            'commandes_id',
            'commandes_numero',
            'commandes_date',
            'commandes_paiement',
            'commandes_adresse',
            'commandes_Code_postal',
            'commandes_ville',
            'commandes_status',
            'commandes',
            'default',
        ]);

        $commandesJson = $this->serializer->serialize($commandes, 'json', $context);

        return new Response($commandesJson, Response::HTTP_OK, ['Content-Type' => 'application/json']);
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

        $commandeProduitId = $entityManager->getRepository(Produits::class)->find($decoded->produit_id);
        $commande->setProduit($commandeProduitId);

        // Décrémenter la quantité de produit dans le stock si le statut est "payé"
        if ($selectedStatus === CommandeStatus::effectue) {
            $produit = $commande->getProduit();
            if ($produit) {
                $stock = $produit->getProduitStock();
                if ($stock) {
                    $quantiteActuelle = $stock->getNombre();
                    $quantiteDecrementee = 1;

                    // Vérification de disponibilité
                    if ($quantiteActuelle >= $quantiteDecrementee) {
                        $nouvelleQuantite = max($quantiteActuelle - $quantiteDecrementee, 0);
                        $stock->setNombre($nouvelleQuantite);
                        $entityManager->flush();
                    } else {
                        // Gérer le cas où la quantité est insuffisante
                        return $this->json([
                            'error' => 'Quantité insuffisante en stock',
                        ]);
                    }
                }
            }
        }
        $entityManager->persist($commande);
        $entityManager->flush();

        return $this->json([
            'Message' => 'La nouvelle commande a été ajoutée avec succès.',
        ]);
    }



    #[Route('/{id}/show_commande', name: 'app_commandes_show', methods: ['GET'])]
    public function show(Commandes $commande): JsonResponse
    {
        $context = SerializationContext::create()->setGroups([
            'commandes_id',
            'commandes_numero',
            'commandes_date',
            'commandes_paiement',
            'commandes_adresse',
            'commandes_Code_postal',
            'commandes_ville',
            'commandes_status',
            'commandes',
            'default',
        ]);

        $commandeJson = $this->serializer->serialize($commande, 'json', $context);

        return new JsonResponse(['commande' => json_decode($commandeJson)], JsonResponse::HTTP_OK, ['Content-Type' => 'application/json']);
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
        $selectedStatus = $decoded->status[0] ?? CommandeStatus::en_cours;
        $commande->setStatus($selectedStatus);

        // Décrémenter la quantité de produit dans le stock si le statut est "payé"
        if ($selectedStatus === CommandeStatus::effectue) {
            $produit = $commande->getProduit();
            if ($produit) {
                $stock = $produit->getProduitStock();
                if ($stock) {
                    $quantiteActuelle = $stock->getNombre();
                    $quantiteDecrementee = 1;

                    // Vérification de disponibilité
                    if ($quantiteActuelle >= $quantiteDecrementee) {
                        $nouvelleQuantite = max($quantiteActuelle - $quantiteDecrementee, 0);
                        $stock->setNombre($nouvelleQuantite);
                        $entityManager->flush();
                    } else {
                        // Gérer le cas où la quantité est insuffisante
                        return $this->json([
                            'error' => 'Quantité insuffisante en stock',
                        ]);
                    }
                }
            }
        }

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