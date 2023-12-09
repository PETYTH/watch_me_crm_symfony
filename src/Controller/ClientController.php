<?php

namespace App\Controller;

use DateTime;
use App\Entity\Client;
use App\Enum\UserStatus;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/client')]
class ClientController extends AbstractController
{
    #[Route('/', name: 'app_client_index', methods: ['GET'])]
    public function index(ClientRepository $clientRepository): JsonResponse
    {
        return $this->Json([
            'clients' => $clientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $nom = $decoded->nom;
        $prenom = $decoded->prenom;
        $dateNaissance = DateTime::createFromFormat('d-m-Y', $decoded->dateNaissance );

        if (!$dateNaissance instanceof \DateTime) {
            return $this->json([
                'message' => 'Format de date d\'anniversaire invalide. Utilisez le format jour-mois-année.',
                'success' => false,
            ]);
        }

        $dateNaissance1 = \DateTime::createFromFormat('d-m-Y', $decoded->dateNaissance)->format('Y-m-d');

        $email = $decoded->email;
        $telephone = $decoded->telephone;
        $adresse = $decoded->adresse;
        $codePostal = $decoded->codePostal;
        $ville = $decoded->ville;

        $selectedStatus = $decoded->status[0] ?? UserStatus::COMMERCIAL;


        $client = new Client();
        $client->setNom($nom);
        $client->setPrenom($prenom);
        $client->setDateNaissance(new \DateTime($dateNaissance1));
        $client->setEmail($email);
        $client->setTelephone($telephone);
        $client->setAdresse($adresse);
        $client->setCodePostal($codePostal);
        $client->setVille($ville);
        $client->setStatus($selectedStatus);

        $em->persist($client);
        $em->flush();

        return $this->json([
            'Message' => "Le client a bien été ajouté",
        ]);
    }

    #[Route('/{id}', name: 'app_client_show', methods: ['GET'])]
    public function show(Client $client): JsonResponse
    {
        return $this->Json([
            'client' => $client,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Client $client, EntityManagerInterface $entityManager): JsonResponse
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

        $selectedStatus = $decoded->status[0] ?? UserStatus::COMMERCIAL;

        $client->setNom($nom);
        $client->setPrenom($prenom);
        $client->setDateNaissance(new \DateTime($dateNaissanceFormatted));
        $client->setEmail($email);
        $client->setTelephone($telephone);
        $client->setAdresse($adresse);
        $client->setCodePostal($codePostal);
        $client->setVille($ville);
        $client->setStatus($selectedStatus);

        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'Les informations du client ont été mises à jour avec succès.',
        ]);
    }


    #[Route('/{id}', name: 'app_client_delete', methods: ['POST'])]
    public function delete(Request $request, Client $client, EntityManagerInterface $entityManager): JsonResponse
    {
        $csrfToken = $request->request->get('_token');

        if ($this->isCsrfTokenValid('delete' . $client->getId(), $csrfToken)) {
            $entityManager->remove($client);
            $entityManager->flush();

            return $this->json([
                'success' => true,
                'message' => 'Le client a bien été supprimé.',
            ]);
        }

        return $this->json([
            'success' => false,
            'message' => 'La suppression du client a échoué. CSRF token invalide.',
        ]);
    }

}