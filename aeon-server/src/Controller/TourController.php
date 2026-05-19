<?php

namespace App\Controller;

use App\Service\TourService;
use InvalidArgumentException;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class TourController extends AbstractController
{
    #[Route('/partie/{id}/tour-actuel', name: 'get_tour_actuel')]
    public function getTourActuel(int $id, TourService $tourService): JsonResponse
    {
        try {
            $tour = $tourService->getTourActuel($id);
        } catch (InvalidArgumentException $e) {
            return $this->json(['message' => $e->getMessage()], 404);
        } catch (LogicException $e) {
            return $this->json(['message' => $e->getMessage()], 400);
        }

        return $this->json($tour, 
        200, 
        [], 
        ['groups' => ['partie:read']]);
    }

    #[Route('/partie/{id}/tours/suivant', name: 'tour_suivant', methods: ['POST'])]
    public function tourSuivant(int $id, TourService $tourService): JsonResponse
    {
        try {
            $tour = $tourService->tourSuivant($id);
        } catch (InvalidArgumentException $e) {
            return $this->json(['message' => $e->getMessage()], 404);
        } catch (LogicException $e) {
            return $this->json(['message' => $e->getMessage()], 400);
        }

        return $this->json($tour, 201, [], ['groups' => ['partie:read']]);
    }
}
