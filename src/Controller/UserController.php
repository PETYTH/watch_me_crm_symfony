<?php

namespace App\Controller;

use DateTime;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Entity\Employes;
use App\Enum\UserRole;
use App\Enum\UserStatus;
use App\Repository\EntrepriseRepository;
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
    public function register(EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $passwordHasher,  MailPerso $mailSender,  EntrepriseRepository $entrepriseRepository   ): JsonResponse
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
        $selectedStatus = $decoded->status[0] ?? UserStatus::COMMERCIAL;

        $entrepriseId = $decoded->entrepriseId; // À adapter à la façon dont vous récupérez l'ID de l'entreprise
        $entreprise = $entrepriseRepository->find($entrepriseId);

        if (!$entreprise) {
            return $this->json([
                'message' => 'L\'entreprise spécifiée n\'existe pas.',
                'success' => false,
            ]);
        }

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

        // Création de l'employé associé à l'utilisateur et à l'entreprise
        $employe = new Employes();
        $employe->setEmployesEntreprise($entreprise);
        $employe->setStatus($selectedStatus);
        $employe->setUser($user);

        $em->persist($user);
        $em->persist($employe);
        $em->flush();

        // Envoi d'un e-mail à l'utilisateur avec son identifiant (email) et le mot de passe
        $subject = 'Confirmation d\'inscription';
        $mailSender->sendMailRegister($email, $subject, $firstname, $name, $plainPassword);


        return $this->json([
            'message' => 'Inscription réussie. Un e-mail de confirmation a été envoyé avec vos identifiants de connexion.',
            'success' => true,
        ]);

    }

    #[Route('/{id}/show_user', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): JsonResponse
    {
        return $this->json([
            'user' => $user,
        ]);
    }


    #[Route('/{id}/user_edit', name: 'app_user_edit', methods: ['POST'])]
    public function edit(int $id, EntityManagerInterface $em, Request $request, MailPerso $mailSender, EntrepriseRepository $entrepriseRepository, UserPasswordHasherInterface $passwordHasher): JsonResponse
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
        $selectedStatus = $decoded->status[0] ?? UserStatus::COMMERCIAL;


        // Récupérer les données de l'entreprise et vérifier si elle existe
        $entrepriseId = $decoded->entrepriseId; // À adapter à la façon dont vous récupérez l'ID de l'entreprise
        $entreprise = $entrepriseRepository->find($entrepriseId);

        if (!$entreprise) {
            return $this->json([
                'message' => 'L\'entreprise spécifiée n\'existe pas.',
                'success' => false,
            ]);
        }

        // Garder le mot de passe existant de l'utilisateur
        $plainPassword = $user->getPassword();

        // Mise à jour des données utilisateur
        $user->setEmail($email);
        $user->setRoles([$selectedRole]);
        $user->setName($name);
        $user->setBirthday(new \DateTime($birthdayFormatted));
        $user->setFirstname($firstname);
        $user->setModifiedAt(new \DateTime());

        // Utilisation de l'ancien mot de passe stocké en base de données
        $user->setPassword($plainPassword);

        $employe = new Employes();
        $employe->setEmployesEntreprise($entreprise);
        $employe->setStatus($selectedStatus);
        $employe->setUser($user);


        $em->persist($user);
        $em->persist($employe);

        $em->flush();

        $subject = 'Mise à jour des vos informations, Nous avons enregistré les modifications que vous avez apportées à votre profil';
        $message = 'Vos informations ont été mises à jour avec succès.';

        // Utilisation de la méthode sendMailResetPassword de MailPerso
        $mailSender->sendMessage($email, $subject, $message, $name, $firstname);

        return $this->json([
            'message' => 'Utilisateur mis à jour avec succès',
            'success' => true,
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

