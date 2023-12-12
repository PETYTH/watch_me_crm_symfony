<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class EntrepriseController extends AbstractController
{
    #[Route('/all_entreprises', name: 'app_entreprise_index', methods: ['GET'])]
    public function index(EntrepriseRepository $entrepriseRepository): JsonResponse
    {
        return $this->json([
            'entreprises' => $entrepriseRepository->findAll(),
        ]);
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
        return $this->json([
            'entreprise' => [
                'id' => $entreprise->getId(),
                'nom' => $entreprise->getNom(),
                'numero_siret' => $entreprise->getNumeroSiret(),
                'adresse' => $entreprise->getAdresse(),
                'code_postal' => $entreprise->getCodePostal(),
                'ville' => $entreprise->getVille(),
                'chiffre_affaire' => $entreprise->getChiffreAffaire(),
            ],
        ]);
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
