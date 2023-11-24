<?php

namespace App\Controller;

use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api/client', name: 'client')]
class ClientController extends AbstractController
{
    #[Route('/add', name: 'client_add')]
    public function add(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $nom = $decoded->nom;
        $prenom = $decoded->prenom;
        $email = $decoded->email;
        $status = $decoded->status;
        $telephone = $decoded->telephone;
        $adresse = $decoded->adresse;
        $code_postel = $decoded->codePostal;
        $ville = $decoded->ville;
        $date_naissance = \DateTime::createFromFormat('Y-m-d', $decoded->dateNaissance);

        $client = new Client();
        $client->setNom($nom);
        $client->setPrenom($prenom);
        $client->setEmail($email);
        $client->setStatus($status);
        $client->setTelephone($telephone);
        $client->setAdresse($adresse);
        $client->setCodePostal($code_postel);
        $client->setVille($ville);
        $client->setDateNaissance($date_naissance);

        $em->persist($client);
        $em->flush();

        return $this->json([
            'message' => 'Client Created',
            'sucess' => true
        ]);
    }
}