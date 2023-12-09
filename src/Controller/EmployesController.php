<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Form\EmployesType;
use App\Repository\EmployesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/employes')]
class EmployesController extends AbstractController
{
    #[Route('/', name: 'app_employes_index', methods: ['GET'])]
    public function index(EmployesRepository $employesRepository): JsonResponse
    {
        return $this->json([
            'employes' => $employesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_employes_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $employe = new Employes();
        $employe->setEmployesEntreprise($decoded->employes_entreprise_id);
        $employe->setStatus($decoded->status);

        $form = $this->createForm(EmployesType::class, $employe);
        $form->submit((array) $decoded);

        if ($form->isValid()) {
            $entityManager->persist($employe);
            $entityManager->flush();

            return $this->json([
                'success' => true,
                'message' => 'Le nouvel employé a été ajouté avec succès.',
            ]);
        }

        return $this->json([
            'success' => false,
            'message' => 'La création de l\'employé a échoué. Veuillez vérifier les données fournies.',
        ]);
    }

    #[Route('/{id}', name: 'app_employes_show', methods: ['GET'])]
    public function show(Employes $employe): JsonResponse
    {
        return $this->json([
            'employe' => [
                'id' => $employe->getId(),
                'employes_entreprise_id' => $employe->getEmployesEntreprise(),
                'status' => $employe->getStatus(),
            ],
        ]);
    }

    #[Route('/{id}/edit', name: 'app_employes_edit', methods: ['POST'])]
    public function edit(Request $request, Employes $employe, EntityManagerInterface $entityManager): JsonResponse
    {
        $decoded = json_decode($request->getContent());

        $employe->setEmployesEntreprise($decoded->employes_entreprise_id);
        $employe->setStatus($decoded->status);

        $form = $this->createForm(EmployesType::class, $employe);
        $form->submit((array) $decoded);

        if ($form->isValid()) {
            $entityManager->flush();

            return $this->json([
                'success' => true,
                'message' => 'Les informations de l\'employé ont été mises à jour avec succès.',
            ]);
        }

        return $this->json([
            'success' => false,
            'message' => 'La mise à jour de l\'employé a échoué. Veuillez vérifier les données fournies.',
        ]);
    }

    #[Route('/{id}', name: 'app_employes_delete', methods: ['POST'])]
    public function delete(Request $request, Employes $employe, EntityManagerInterface $entityManager): JsonResponse
    {
        if ($this->isCsrfTokenValid('delete'.$employe->getId(), $request->request->get('_token'))) {
            $entityManager->remove($employe);
            $entityManager->flush();

            return $this->json([
                'success' => true,
                'message' => 'L\'employé a été supprimé avec succès.',
            ]);
        }

        return $this->json([
            'success' => false,
            'message' => 'La suppression de l\'employé a échoué. Veuillez vérifier le jeton CSRF.',
        ]);
    }
}
