<?php

namespace App\Controller;

use App\Controller\MailPerso;
use DateTime;
use App\Repository\UserRepository;
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
class UserController extends AbstractController
{
    #[Route('/all_user', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): JsonResponse
    {
        return $this->json([
            'users' => $userRepository->findAll(),
        ]);
    }


    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $passwordHasher,  MailPerso $mailSender  ): JsonResponse
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

        // Envoi d'un e-mail à l'utilisateur avec son identifiant (email) et le mot de passe
        $subject = 'Confirmation d\'inscription';
        $mailSender->sendMailRegister($email, $subject, $firstname, $name, $plainPassword);

        $em->persist($user);
        $em->flush();

        return $this->json([
            'message' => 'Inscription réussie. Un e-mail de confirmation a été envoyé avec vos identifiants de connexion.',
            'success' => true,
        ]);

    }

    #[Route('/{id}/show', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): JsonResponse
    {
        return $this->json([
            'user' => $user,
        ]);
    }

    #[Route('/{id}/user_edit', name: 'app_user_edit', methods: ['POST'])]
    public function edit(int $id, EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $user = $em->getRepository(User::class)->find($id);

        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $decoded = json_decode($request->getContent());
        $email = $decoded->email;
        $name = $decoded->name;
        $firstname = $decoded->firstname;
        $birthday = DateTime::createFromFormat('d-m-Y', $decoded->birthday);

        if (!$birthday instanceof \DateTime) {
            return $this->json([
                'message' => 'Format de date d\'anniversaire invalide. Utilisez le format jour-mois-année.',
                'success' => false,
            ]);
        }

        $birthdayFormatted = $birthday->format('Y-m-d');
        $plainPassword = $decoded->password;
        $selectedRole = $decoded->roles[0] ?? UserRole::EMPLOYE;

        $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
        $user->setEmail($email);
        $user->setPassword($hashedPassword);
        $user->setRoles([$selectedRole]);
        $user->setName($name);
        $user->setBirthday(new \DateTime($birthdayFormatted));
        $user->setFirstname($firstname);
        $user->setModifiedAt(new \DateTime());

        $em->flush();

        return $this->json([
            'message' => 'Utilisateur mis à jour avec succès',
            'success' => true,
        ]);
    }

    #[Route('/{id}/user_delete', name: 'app_user_delete', methods: ['POST'])]
    public function delete(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->json([
            'message' => 'Utilisateur supprimé avec succès',
            'success' => true,
        ]);
    }
}
