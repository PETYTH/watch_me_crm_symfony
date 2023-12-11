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
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use function Webmozart\Assert\Tests\StaticAnalysis\false;
use Symfony\Component\HttpFoundation\RequestStack;



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
    public function edit(int $id, EntityManagerInterface $em, Request $request, MailPerso $mailSender): JsonResponse
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
        $selectedRole = $decoded->roles[0] ?? UserRole::EMPLOYE;

        // Utilisation de l'ancien mot de passe de la base de données sans le modifier
        $oldPassword = $user->getPassword();

        $user->setEmail($email);
        $user->setRoles([$selectedRole]);
        $user->setName($name);
        $user->setBirthday(new \DateTime($birthdayFormatted));
        $user->setFirstname($firstname);
        $user->setModifiedAt(new \DateTime());

        // Utilisation de l'ancien mot de passe stocké en base de données
        $user->setPassword($oldPassword);

        $em->persist($user);
        $em->flush();

        $subject = 'Mise à jour des vos informations Nous avons enregistré les modifications que vous avez apportées à votre profil';
        $message = 'Vos informations ont été mises à jour.';

        // Utilisation de la méthode sendMailResetPassword de MailPerso
        $mailSender->sendMessage($email, $subject, $message, $name, $firstname);
        return $this->json([
            'message' => 'Utilisateur mis à jour avec succès',
            'success' => true,
        ]);
    }

    #[Route('/forgot-password', name: 'app_forgot_password', methods: ['POST'])]
    public function forgetPassword(Request $request, MailPerso $mailSender, EntityManagerInterface $entityManager, TokenGeneratorInterface $tokenGenerator): JsonResponse {
        $decoded = json_decode($request->getContent());
        $email = $decoded->email;
        $name = $decoded->name;
        $firstname = $decoded->firstname;

        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        if ($user) {
            $token = $tokenGenerator->generateToken();
            $user->setResetToken($token);
            $entityManager->persist($user);
            $entityManager->flush();

            $resetUrl = 'http://localhost:4200/auth/forget/form?token=' . $token; // Utilisation de RequestStack pour obtenir l'URL complète

            $subject = 'Réinitialisation de mot de passe';
            $message = $resetUrl;

            // Utilisation de la méthode sendMailResetPassword de MailPerso
            $mailSender->sendMailResetPassword($email, $subject, $message, $name, $firstname);

            return $this->json([
                'message' => 'Un e-mail de réinitialisation a été envoyé à votre adresse.',
                'success' => true,
            ]);
        }
        return $this->json([
            'message' => 'Aucun compte associé à cet e-mail.',
            'success' => false,
        ]);
    }

    #[Route('/reset-password', name: 'app_reset_password', methods: ['POST'])]
    public function resetPassword(Request $request, UserPasswordHasherInterface $passwordHasher, MailPerso $mailSender, EntityManagerInterface $entityManager): JsonResponse {
        $decoded = json_decode($request->getContent(), true);
        $token = $decoded['token'];
        $newPassword = $decoded['newPassword'];
        $email = $decoded->email;
        $name = $decoded->name;
        $firstname = $decoded->firstname;

        if (!$token || !$newPassword) {
            return $this->json([
                'message' => 'Token ou nouveau mot de passe manquant',
                'success'=>false,
                ]);
        }

        $user = $entityManager->getRepository(User::class)->findOneBy(['resetToken' => $token]);

        if (!$user) {
            return $this->json([
            'message' => 'Aucun utilisateur trouvé pour ce token',
                'success'=>false,
            ]);
        }

        // Réinitialisation du mot de passe pour l'utilisateur
        $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
        $user->setPassword($hashedPassword);
        $user->setResetToken(null); // Effacement du token après réinitialisation du mot de passe
        $user->setModifiedAt(new \DateTime());

        $entityManager->persist($user);
        $entityManager->flush();

        $subject = 'Réinitialisation de mot de passe';
        $message = 'Votre mot de passe a été réinitialisé avec succès';

        // Utilisation de la méthode sendMailResetPassword de MailPerso
        $mailSender->ConfirmedResetPassword($email, $subject, $message, $name, $firstname);
        return $this->json([
        'message' => 'Mot de passe réinitialisé avec succès',
            'success' => true
        ]);
    }

    #[Route('/{id}/user_delete', name: 'app_user_delete', methods: ['GET', 'POST'])]
    public function delete(int $id, Request $request, EntityManagerInterface $entityManager, MailPerso $mailSender): JsonResponse{
        $decoded = json_decode($request->getContent());
        $email = $decoded->email;
        $name = $decoded->name;
        $firstname = $decoded->firstname;
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
        }
        $entityManager->remove($user);
        $entityManager->persist($user);
        $entityManager->flush();

        $subject = 'Suppression de votre compte';
        $message = 'Votre compte a été supprimé';

        // Utilisation de la méthode sendMailResetPassword de MailPerso
        $mailSender->ConfirmedDelete($email, $subject, $message, $name, $firstname);
        return $this->json([
            'message' => 'Utilisateur supprimé avec succès',
            'success' => true,
        ]);
    }

}

