<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class EntrepriseController extends AbstractController
{
    private $serializer;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    #[Route('/all_clients_entreprise/{entrepriseId}', name: 'app_all_clients', methods: ['GET'])]
    public function getAllClientsByEntreprise(int $entrepriseId, EntrepriseRepository $entrepriseRepository): JsonResponse
    {
        $entreprise = $entrepriseRepository->findClientsByEntreprise($entrepriseId);

        if (!$entreprise) {
            return new JsonResponse(['error' => 'Entreprise non trouvée'], Response::HTTP_NOT_FOUND);
        }

        $clients = $entreprise->getClients(); // Supposons que vous avez une méthode "getClients" dans votre entité Entreprise

        $context = SerializationContext::create()->setGroups([
            'clients', // Ajoutez ici les groupes de sérialisation pour les clients
            'default',
        ]);

        $clientsJson = $this->serializer->serialize($clients, 'json', $context);

        return new JsonResponse(['clients' => json_decode($clientsJson)], Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/count_clients_entreprise/{entrepriseId}', name: 'app_count_clients', methods: ['GET'])]
    public function countClientsByEntreprise(int $entrepriseId, EntrepriseRepository $entrepriseRepository): JsonResponse
    {
        $countsByStatus = $entrepriseRepository->countClientsByStatus($entrepriseId);

        return new JsonResponse(['countsByStatus' => $countsByStatus], Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }


    #[Route('/all_entreprises', name: 'app_entreprise_index', methods: ['GET'])]
    public function index(EntrepriseRepository $entrepriseRepository): Response
    {
        $entreprises = $entrepriseRepository->findAll();

        $context = SerializationContext::create()->setGroups([
            'entreprise_id',
            'entreprise_nom',
            'entreprise_numero_siret',
            'entreprise_adresse',
            'entreprise_code_postal',
            'entreprise_ville',
            'entreprise_chiffre_affaire',
            'entreprise_entreprise',
            'entreprise_employes_entreprise',
            'entreprise_entreprise_client',
            'default',
        ]);

        $entreprisesJson = $this->serializer->serialize($entreprises, 'json', $context);

        return new Response($entreprisesJson, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/count_entreprises', name: 'app_entreprises_count', methods: ['GET'])]
    public function count(EntrepriseRepository $entrepriseRepository): Response
    {
        $entreprise = $entrepriseRepository->findAll();

        $nombreTotalEntreprises = count($entreprise);

        $responseData = [
            'nombreTotalEntreprises' => $nombreTotalEntreprises,
        ];

        $responseJson = json_encode($responseData);

        return new Response($responseJson, Response::HTTP_OK, ['Content-Type' => 'application/json']);

    }

    #[Route('/new_entreprise', name: 'app_entreprise_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $entreprise = new Entreprise();
        $entreprise->setNom($decoded->nom);
        $entreprise->setNumeroSiret($decoded->numero_siret);
        $entreprise->setAdresse($decoded->adresse);
        $entreprise->setCodePostal($decoded->code_postal);
        $entreprise->setVille($decoded->ville);
        $entreprise->setChiffreAffaire($decoded->chiffre_affaire);

        $entityManager->persist($entreprise);
        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'La nouvelle entreprise a été ajoutée avec succès.',
        ]);
    }

    #[Route('/{id}/show_entreprise', name: 'app_entreprise_show', methods: ['GET'])]
    public function show(Entreprise $entreprise): JsonResponse
    {
        $context = SerializationContext::create()->setGroups([
            'entreprise_id',
            'entreprise_nom',
            'entreprise_numero_siret',
            'entreprise_adresse',
            'entreprise_code_postal',
            'entreprise_ville',
            'entreprise_chiffre_affaire',
            'entreprise_entreprise',
            'entreprise_employes_entreprise',
            'entreprise_entreprise_client',
            'default',
        ]);

        $entrepriseJson = $this->serializer->serialize($entreprise, 'json', $context);

        return new JsonResponse(['entreprise' => json_decode($entrepriseJson)], JsonResponse::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/{id}/edit_entreprise', name: 'app_entreprise_edit', methods: ['POST'])]
    public function edit(Request $request, Entreprise $entreprise, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $entreprise->setNom($decoded->nom);
        $entreprise->setNumeroSiret($decoded->numero_siret);
        $entreprise->setAdresse($decoded->adresse);
        $entreprise->setCodePostal($decoded->code_postal);
        $entreprise->setVille($decoded->ville);
        $entreprise->setChiffreAffaire($decoded->chiffre_affaire);

        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'Les informations de l\'entreprise ont été mises à jour avec succès.',
        ]);
    }

    #[Route('/{id}/delete_entreprise', name: 'app_entreprise_delete', methods: ['POST'])]
    public function delete(Request $request, Entreprise $entreprise, EntityManagerInterface $entityManager): JsonResponse
    {
        $employe = $entityManager->getRepository(Employes::class)->findOneBy(['Employes_entreprise' => $entreprise]);
        if ($employe) {
            $entityManager->remove($employe);
        }
        $entityManager->remove($entreprise);
        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'L\'entreprise a été supprimée avec succès.',
        ]);
    }
}