<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[Route(path: '/api', name: 'api_')]
class SecurityController extends AbstractController
{
    private TokenStorageInterface $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
    $this->tokenStorage = $tokenStorage;
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): JsonResponse
    {
    // Détruire le token à la déconnexion
    $this->tokenStorage->setToken(null);

    return $this->json([
    'message' => 'Vous avez été déconnecté',
    'success' => true,
        ]);
    }
}
