<?php

namespace App\Controller;

use App\Repository\CarteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarteController extends AbstractController
{

    #[Route('/inventaire/details/{idCarte}', name: 'get_details_carte', methods: ['GET'])]
    public function getDetailsCarte(int $idCarte, CarteRepository $carteRepository, Request $request): JsonResponse
    {
        return $this->json([
            'details' => $carteRepository->findDetails($idCarte),
        ], Response::HTTP_CREATED);
    }
}
