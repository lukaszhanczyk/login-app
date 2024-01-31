<?php

namespace App\Controller;

use App\Request\LoginRequest;
use App\Request\RegisterRequest;
use App\Service\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    #[Route('/login', name: 'login_auth')]
    public function login(LoginRequest $request): JsonResponse
    {
        if ($request->validate()){
            return $this->json(['errors' => $request->validate()],500);
        }

        $parameters = json_decode($request->getRequest()->getContent(), true);

        if (!$this->authService->login($parameters)){
            return $this->json([
                'error' => 'Login or password are incorrect!',
            ], 500);
        }

        return $this->json([
            'message' => 'Login success',
        ], 200);
    }

    #[Route('/register', name: 'register_auth')]
    public function register(RegisterRequest $request): JsonResponse
    {
        if ($request->validate()){
            return $this->json(['errors' => $request->validate()],500);
        }

        $parameters = json_decode($request->getRequest()->getContent(), true);

        try {
            $this->authService->register($parameters);
        } catch (\Exception $e){
            return $this->json([
                'error' => $e->getMessage(),
            ], 500);
        }
        return $this->json([
            'message' => 'Registration success',
        ], 200);

    }
}
