<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Entity\Entreprise;
use App\Enum\UserStatus;
use App\Form\EmployesType;
use App\Repository\EmployesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', 'api_')]
class EmployesController extends AbstractController
{
    #[Route('/all_employes', name: 'app_employes_index', methods: ['GET'])]
    public function index(EmployesRepository $employesRepository): JsonResponse
    {
        return $this->Json([
            'employes' => $employesRepository->findAll(),
        ]);
    }

    #[Route('/new_employe', name: 'app_employes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $employe = new Employes();
        $employe_id = $entityManager->getRepository(Entreprise::class)->find($decoded->employes_entreprise_id);
        $employe->setEmployesEntreprise($employe_id);
        $selectedStatus = $decoded->status[0] ?? UserStatus::COMMERCIAL;
        $employe->setStatus($selectedStatus);

        $entityManager->persist($employe);
        $entityManager->flush();

        return $this->json([
            'message' => 'Le nouvel employé a été ajouté avec succès.',
            'success' => true,
        ]);
    }


    #[Route('/{id}/show_employe', name: 'app_employes_show', methods: ['GET'])]
    public function show(Employes $employe): JsonResponse
    {
        return $this->json([
            'employe' => [
                'id' => $employe->getId(),
                'Status' => $employe->getStatus(),
                'Employes_entreprise' => $employe->getEmployesEntreprise(),
            ],
        ], 200, [], ['groups' => 'employe']);
    }

    #[Route('/{id}/edit_employe', name: 'app_employes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Employes $employe, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $employe_id = $entityManager->getRepository(Entreprise::class)->find($decoded->employes_entreprise_id);
        $employe->setEmployesEntreprise($employe_id);
        $selectedStatus = $decoded->status[0] ?? UserStatus::COMMERCIAL;
        $employe->setStatus($selectedStatus);

        $entityManager->flush();

        return $this->json([
            'message' => 'Les informations de l\'employé ont été mises à jour avec succès.',
            'success' => true,
        ]);
    }

    #[Route('/{id}/delete_employe', name: 'app_employes_delete', methods: ['POST'])]
    public function delete(Request $request, Employes $employe, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($employe);
        $entityManager->flush();

        return $this->json([
            'message' => 'L\'employé a été supprimé avec succès.',
            'success' => true,
        ]);
    }
}
