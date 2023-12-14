<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

#[Route('/forgot', name: 'app_forgot')]
class ForgetPasswordController extends AbstractController
{
    #[Route('/forgot-password', name: 'app_forgot_password', methods: ['POST'])]
    public function forgetPassword(Request $request, MailPerso $mailSender, EntityManagerInterface $entityManager, TokenGeneratorInterface $tokenGenerator): JsonResponse {
        $decoded = json_decode($request->getContent());
        $email = $decoded->email;


        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        if ($user) {
            $name = $user->getName(); // Méthode pour récupérer le nom depuis l'entité User
            $firstname = $user->getFirstName();
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
        $name = $user->getName();
        $firstname = $user->getFirstName();
        $email = $user->getEmail();

        $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
        $user->setPassword($hashedPassword);
        $user->setResetToken(null);
        $user->setModifiedAt(new \DateTime());

        $entityManager->persist($user);
        $entityManager->flush();

        $subject = 'Réinitialisation de mot de passe';
        $message = 'Votre mot de passe a été réinitialisé avec succès';

        $mailSender->ConfirmedResetPassword($email, $subject, $message, $name, $firstname);
        return $this->json([
            'message' => 'Mot de passe réinitialisé avec succès',
            'success' => true
        ]);
    }


}
