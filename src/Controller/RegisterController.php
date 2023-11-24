<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Enum\UserRole;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $email = $decoded->email;
        $name = $decoded->name;
        $firstname = $decoded->firstname;
        $birthday = DateTime::createFromFormat('d-m-Y', $decoded->birthday);

        // Vérifier si la conversion a réussi
        if (!$birthday instanceof \DateTime) {
            return $this->json([
                'message' => 'Format de date d\'anniversaire invalide. Utilisez le format jour-mois-année.',
                'success' => false,
            ]);
        }

        // Utiliser la chaîne formatée pour créer une nouvelle instance de \DateTime
        $birthday1 = \DateTime::createFromFormat('d-m-Y', $decoded->birthday)->format('Y-m-d');

        $plainPassword = $decoded->password;

        // Par defaut mettre le role à : UserRole::EMPLOYE
        $selectedRole = $decoded->roles[0] ?? UserRole::EMPLOYE;

        $user = new User();
        $hashedPassword = $passwordHasher->hashPassword(
            $user, $plainPassword
        );
        $user->setEmail($email);
        $user->setPassword($hashedPassword);
        $user->setRoles([$selectedRole]);
        $user->setName($name);

        $user->setBirthday(new \DateTime($birthday1));
        $user->setFirstname($firstname);
        $user->setCreatedAt(new \DateTime());

        $em->persist($user);
        $em->flush();

        return $this->json([
            'message' => 'Vous avez été ajouté',
            'success' => true,
        ]);

    }


}
