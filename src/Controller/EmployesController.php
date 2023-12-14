<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Entity\Entreprise;
use App\Entity\User;
use App\Enum\UserStatus;
use App\Form\EmployesType;
use App\Repository\EmployesRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class EmployesController extends AbstractController
{
    private $serializer;

    public function __construct()
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    #[Route('/all_employes', name: 'app_employes_index', methods: ['GET'])]
    public function index(EmployesRepository $employesRepository): Response
    {
        $employes = $employesRepository->findAll();

        $context = SerializationContext::create()->setGroups([
            'employes_id',
            'employes_Status',
            'employes_employes_entreprise',
            'employes',
            'default',
        ]);

        $employesJson = $this->serializer->serialize($employes, 'json', $context);

        return new Response($employesJson, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/count_employes', name: 'app_employes_count', methods: ['GET'])]
    public function count(EmployesRepository $employesRepository): Response
    {
        $employes = $employesRepository->findAll();

        $nombreTotalEmployes = count($employes);

        $responseData = [
            'nombreTotalEmployes' => $nombreTotalEmployes,
        ];

        $responseJson = json_encode($responseData);

        return new Response($responseJson, Response::HTTP_OK, ['Content-Type' => 'application/json']);

    }

    #[Route('/new_employe', name: 'app_employes_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        // Recherche de l'entreprise associée à l'employé
        $employeEntreprise = $entityManager->getRepository(Entreprise::class)->find($decoded->employes_entreprise_id);

        if (!$employeEntreprise) {
            return $this->json([
                'success' => false,
                'message' => 'L\'entreprise spécifiée n\'existe pas.',
            ]);
        }

        // Recherche de l'utilisateur ayant le rôle employé
        $userRepository = $entityManager->getRepository(User::class);
        $employeUser = $userRepository->findOneBy(['id' => $decoded->user_id, 'roles' => 'EMPLOYE']);

        if (!$employeUser) {
            return $this->json([
                'success' => false,
                'message' => 'L\'utilisateur employé spécifié n\'existe pas.',
            ]);
        }

        // Création d'un nouvel employé et association à l'entreprise et à l'utilisateur
        $newEmploye = new Employes();
        $newEmploye->setEmployesEntreprise($employeEntreprise);
        $newEmploye->setUser($employeUser);

        $entityManager->persist($newEmploye);
        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'Le nouvel employé a été ajouté avec succès.',
        ]);
    }

    #[Route('/{id}/show_employe', name: 'app_employes_show', methods: ['GET'])]
    public function show(Employes $employe): JsonResponse
    {
        $context = SerializationContext::create()->setGroups([
            'employes_id',
            'employes_Status',
            'employes_employes_entreprise',
            'employes',
            'default',
        ]);

        $employeJson = $this->serializer->serialize($employe, 'json', $context);

        return new JsonResponse(['employe' => json_decode($employeJson)], JsonResponse::HTTP_OK, ['Content-Type' => 'application/json']);
    }


    #[Route('/{id}/edit_employe', name: 'app_employes_edit', methods: ['POST'])]
    public function edit(Request $request, Employes $employe, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        // Recherche de l'entreprise associée à l'employé
        $employeEntreprise = $entityManager->getRepository(Entreprise::class)->find($decoded->employes_entreprise_id);

        if (!$employeEntreprise) {
            return $this->json([
                'success' => false,
                'message' => 'L\'entreprise spécifiée n\'existe pas.',
            ]);
        }

        // Recherche de l'utilisateur ayant le rôle employé
        $userRepository = $entityManager->getRepository(User::class);
        $employeUser = $userRepository->findOneBy(['id' => $decoded->user_id, 'roles' => 'EMPLOYE']);

        if (!$employeUser) {
            return $this->json([
                'success' => false,
                'message' => 'L\'utilisateur employé spécifié n\'existe pas.',
            ]);
        }

        // Mise à jour des informations de l'employé avec l'utilisateur associé
        $employe->setEmployesEntreprise($employeEntreprise);
        $employe->setUser($employeUser);

        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'Les informations de l\'employé ont été mises à jour avec succès.',
        ]);
    }


    #[Route('/{id}/delete_employe', name: 'app_employes_delete', methods: ['POST'])]
    public function delete(Request $request, Employes $employe, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($employe);
        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'L\'employé a été supprimé avec succès.',
        ]);
    }
}