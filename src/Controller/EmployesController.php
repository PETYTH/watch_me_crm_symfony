<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Entity\Entreprise;
use App\Form\EmployesType;
use App\Repository\EmployesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class EmployesController extends AbstractController
{
    #[Route('/all_employes', name: 'app_employes_index', methods: ['GET'])]
    public function index(EmployesRepository $employesRepository): JsonResponse
    {
        return $this->json([
            'employes' => $employesRepository->findAll(),
        ]);
    }

    #[Route('/new_employe', name: 'app_employes_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $employe = new Employes();
        $employe_id = $entityManager->getRepository(Entreprise::class)->find($decoded->employes_entreprise_id);
        $employe->setEmployesEntreprise($employe_id);
        $employe->setStatus($decoded->status);

        $entityManager->persist($employe);
        $entityManager->flush();

        return $this->json([
            'success' => true,
            'message' => 'Le nouvel employé a été ajouté avec succès.',
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


    #[Route('/{id}/edit_employe', name: 'app_employes_edit', methods: ['POST'])]
    public function edit(Request $request, Employes $employe, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $employe_id = $entityManager->getRepository(Entreprise::class)->find($decoded->employes_entreprise_id);
        $employe->setEmployesEntreprise($employe_id);
        $employe->setStatus($decoded->status);

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
