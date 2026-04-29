<?php

namespace App\Controller;

use InvalidArgumentException;
use LogicException;
use App\Service\PartieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class PartieController extends AbstractController
{

    #[Route('/partie', name: 'create_partie', methods:['POST'])]
    public function createPartie(Request $request, PartieService $partieService): JsonResponse
    {
        $data = json_decode($request->getContent(),true);
        $nbreJoueurs = $data['nbreJoueurs'] ?? null;
        $extensionId = $data['extensionId'] ?? null;

        if (!$nbreJoueurs) {
            return $this->json([
                'message' => 'Veuillez renseigner le nombre de joueurs'
            ],
            400
            );
        }

        if ($nbreJoueurs < 1) {
            return $this->json([
                'message' => 'Le nombre de joueurs doit être supérieur à 1'
            ],
            400
            );
        }

        if(!$extensionId) {
            return $this->json([
                'message' => "Vous n'avez pas sélectionné d'extension"
            ],
            400);
        }
       
        try {
            $partie = $partieService->createPartie($nbreJoueurs, $extensionId);
        } catch (InvalidArgumentException $e) {
            return $this->json(['message' => $e->getMessage()], 400);
        }

        return $this->json([
            'Success' => true,
            'numero' => $partie->getNumero(),
            'nombre de joueurs' => $partie->getNbreJoueurs(),
        ],
        201);
    }

    #[Route('/partie/{id}', name: 'get_partie', methods:['GET'])]
    public function getPartie(int $id, PartieService $partieService): JsonResponse {
        try {
            $partie = $partieService->getPartie($id);
        } catch (InvalidArgumentException $e) {
            return $this->json(['message' => $e->getMessage()], 404);
        }

        return $this->json(
            $partie, 
            200, 
            [], 
            [
                'groups' => ['partie:read']
            ]);
    }

    #[Route('/partie/{id}/demarrer', name: 'demarrer_partie', methods:['POST'])]
    public function demarrerPartie(int $id, PartieService $partieService): JsonResponse {
        try {
            $partie = $partieService->demarrerPartie($id);
        } catch (InvalidArgumentException $e) {
            return $this->json(['message' => $e->getMessage()], 404);
        }

        return $this->json(
            $partie, 
            200, 
            [], 
            [
                'groups' => ['partie:read']
            ]);
    }

    #[Route('/partie/{id}/terminer', name: 'terminer_partie', methods:['PATCH'])]
    public function terminerrPartie(int $id, PartieService $partieService): JsonResponse {
        try {
            $partie = $partieService->terminerPartie($id);
        } catch (InvalidArgumentException $e) {
            return $this->json(['message' => $e->getMessage()], 404);
        } catch (LogicException $e) {
            return $this->json(['message' => $e->getMessage()], 400);
        }

        return $this->json(
            $partie, 
            200, 
            [], 
            [
                'groups' => ['partie:read']
            ]);
    }

}
