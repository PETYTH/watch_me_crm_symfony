<?php

namespace App\Controller;

use App\Entity\Commandes;
use App\Enum\ClientStatus;
use App\Repository\EmployesRepository;
use App\Repository\EntrepriseRepository;
use DateTime;
use App\Entity\Client;
use App\Entity\Employes;
use App\Entity\Entreprise;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name:'api_')]
class ClientController extends AbstractController
{
    private $serializer;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    #[Route('/all_client', name: 'app_client_index', methods: ['GET'])]
    public function index(ClientRepository $clientRepository): Response
    {
        $clients = $clientRepository->findAll();
        $context = SerializationContext::create()->setGroups(['clients', 'default', 'commandes']);
        $clientsJson = $this->serializer->serialize($clients, 'json', $context);

        return new Response($clientsJson, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/new_client', name: 'app_client_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $em, EntrepriseRepository $entrepriseRepository, EmployesRepository $employesRepository): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $nom = $decoded->nom;
        $prenom = $decoded->prenom;
        $dateNaissance = DateTime::createFromFormat('d-m-Y', $decoded->dateNaissance);

        if (!$dateNaissance instanceof \DateTime) {
            return $this->json([
                'message' => 'Format de date d\'anniversaire invalide. Utilisez le format jour-mois-année.',
                'success' => false,
            ]);
        }

        $dateNaissanceFormatted = \DateTime::createFromFormat('d-m-Y', $decoded->dateNaissance)->format('Y-m-d');

        $email = $decoded->email;
        $telephone = $decoded->telephone;
        $adresse = $decoded->adresse;
        $codePostal = $decoded->codePostal;
        $ville = $decoded->ville;

        $selectedStatus = $decoded->status[0] ?? ClientStatus::CLIENT;

        $entrepriseId = $decoded->entrepriseId;
        $entreprise = $entrepriseRepository->find($entrepriseId);

        if (!$entreprise) {
            return $this->json([
                'message' => 'L\'entreprise spécifiée n\'existe pas.',
                'success' => false,
            ]);
        }

        // Récupérez l'ID de l'employé existant que vous souhaitez lier au client
        $employeId = $decoded->employeId;
        $employe = $employesRepository->find($employeId);

        if (!$employe) {
            return $this->json([
                'message' => 'L\'employé spécifié n\'existe pas.',
                'success' => false,
            ]);
        }

        // Création du client
        $client = new Client();
        $client->setNom($nom);
        $client->setPrenom($prenom);
        $client->setDateNaissance(new \DateTime($dateNaissanceFormatted));
        $client->setEmail($email);
        $client->setTelephone($telephone);
        $client->setAdresse($adresse);
        $client->setCodePostal($codePostal);
        $client->setVille($ville);
        $client->setStatus($selectedStatus);
        $client->setEntreprise($entreprise);

        // Lier le client à l'employé existant
        $client->setEmploye($employe);

        $em->persist($client);
        $em->flush();

        return $this->json([
            'Message' => "Le client a été créé et lié à l'employé spécifié.",
        ]);
    }



    #[Route('/{id}/show_client', name: 'app_client_show', methods: ['GET'])]
    public function show(Client $client): JsonResponse
    {
        $context = SerializationContext::create()->setGroups([
            'clients',
            'default',
            'commandes',
        ]);

        $clientJson = $this->serializer->serialize($client, 'json', $context);

        return new JsonResponse(['client' => json_decode($clientJson)], JsonResponse::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/{id}/edit_client', name: 'app_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Client $client, EntityManagerInterface $entityManager, EntrepriseRepository $entrepriseRepository, EmployesRepository $employesRepository): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $nom = $decoded->nom;
        $prenom = $decoded->prenom;
        $dateNaissance = DateTime::createFromFormat('d-m-Y', $decoded->dateNaissance);

        if (!$dateNaissance instanceof \DateTime) {
            return $this->json([
                'message' => 'Format de date d\'anniversaire invalide. Utilisez le format jour-mois-année.',
                'success' => false,
            ]);
        }

        $dateNaissanceFormatted = \DateTime::createFromFormat('d-m-Y', $decoded->dateNaissance)->format('Y-m-d');

        $email = $decoded->email;
        $telephone = $decoded->telephone;
        $adresse = $decoded->adresse;
        $codePostal = $decoded->codePostal;
        $ville = $decoded->ville;

        $selectedStatus = $decoded->status[0] ?? ClientStatus::CLIENT;

        $entrepriseId = $decoded->entrepriseId;
        $entreprise = $entrepriseRepository->find($entrepriseId);

        if (!$entreprise) {
            return $this->json([
                'message' => 'L\'entreprise spécifiée n\'existe pas.',
                'success' => false,
            ]);
        }

        // Récupérez l'ID de l'employé existant que vous souhaitez lier au client
        $employeId = $decoded->employeId;
        $employe = $employesRepository->find($employeId);

        if (!$employe) {
            return $this->json([
                'message' => 'L\'employé spécifié n\'existe pas.',
                'success' => false,
            ]);
        }

        $client->setNom($nom);
        $client->setPrenom($prenom);
        $client->setDateNaissance(new \DateTime($dateNaissanceFormatted));
        $client->setEmail($email);
        $client->setTelephone($telephone);
        $client->setAdresse($adresse);
        $client->setCodePostal($codePostal);
        $client->setVille($ville);
        $client->setStatus($selectedStatus);
        $client->setEntreprise($entreprise);
        $client->setEmploye($employe);

        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'Les informations du client ont été mises à jour avec succès.',
        ]);
    }



    #[Route('/{id}/delete_client', name: 'app_client_delete', methods: ['POST'])]
    public function delete(Request $request, int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $client = $entityManager->getRepository(Client::class)->find($id);
        $commande = $entityManager->getRepository(Commandes::class)->findOneBy(['Commande_client' => $id]);

        if (!$client) {
            return new JsonResponse(['message' => 'client non trouvé'], Response::HTTP_NOT_FOUND);
        }

        if ($commande) {
            $entityManager->remove($commande);
        }
        $entityManager->remove($client);
        $entityManager->flush();;
        return $this->json([
            'success' => true,
            'message' => 'Le client a bien été supprimé.',
        ]);
    }


}