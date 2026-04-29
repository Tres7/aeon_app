<?php

namespace App\Controller;

use InvalidArgumentException;
use PartieService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class PartieController extends AbstractController
{

    #[Route('/partie', name: 'create_part', methods:['POST'])]
    public function createPart(Request $request, PartieService $partieService): JsonResponse
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
            $partie = $partieService->createPart($nbreJoueurs, $extensionId);
        } catch (InvalidArgumentException $e) {
            return $this->json(['message' => $e->getMessage()], 400);
        }

        return $this->json([
            'Success' => true,
            'numero' => $partie->getNumero(),
            'nombre de joueurs' => $partie->getNbreJoueurs(),
        ]);
    }

}
