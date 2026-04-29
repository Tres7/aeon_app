<?php
namespace App\Service;


use App\Entity\Tour;
use DateTimeImmutable;
use InvalidArgumentException;
use App\Repository\ExtensionRepository;
use App\Repository\PartieRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Partie;
use LogicException;

class PartieService {
    private ExtensionRepository $extensionRepository;
    private EntityManagerInterface $entityManagerInterface;

    private PartieRepository $partieRepository;

    public function __construct(ExtensionRepository $extensionRepository, EntityManagerInterface $entityManagerInterface, PartieRepository $partieRepository) {
        $this->extensionRepository = $extensionRepository;
        $this->entityManagerInterface = $entityManagerInterface;
        $this->partieRepository = $partieRepository;
    }

    public function createPartie(int $nbreJoueurs, int $extensionId): Partie {
        $extension = $this->extensionRepository->find($extensionId);

        if (!$extension) {
            throw new InvalidArgumentException("Extension introuvable");
        }

        $partie = new Partie();
        $partie->setNumero($this->generateNumeroPartie());
        $partie->setCreatedAt(new \DateTimeImmutable);
        $partie -> setNbreJoueurs($nbreJoueurs);
        $partie->setExtension($extension);

        $this->entityManagerInterface->persist($partie);
        $this->entityManagerInterface->flush();

        return $partie;
    }

    public function getPartie(int $partieId): Partie {
        $partie = $this->partieRepository->find($partieId);

        if (!$partie) {
            throw new InvalidArgumentException("Partie introuvable");
        }

        return $partie;
    }  

    public function demarrerPartie (int $id): Partie {
        $partie = $this->partieRepository->find($id);

        if (!$partie) {
            throw new InvalidArgumentException("Partie introuvable.");
        }

        if (!$partie->getTours()->isEmpty()) {
            throw new LogicException ("La partie a déjà été démarrée.");
        }

        $tour = new Tour();
        $tour->setNumero(1);
        $partie->addTour($tour);

        $this->entityManagerInterface->persist($tour);
        $this->entityManagerInterface->flush();

        return $partie;

    }

    public function terminerPartie (int $id): Partie {
        $partie = $this->partieRepository->find($id);

        if (!$partie) {
            throw new InvalidArgumentException("Partie introuvable.");
        }

        if ($partie->getTours()->isEmpty()) {
            throw new LogicException ("La partie n'a pas été démarrée.");
        }

        if ($partie->getEndedAt() !== null) {
            throw new LogicException("La partie est déjà terminée.");
        }

        $partie->setEndedAt(new DateTimeImmutable());

        $this->entityManagerInterface->flush();

        return $partie;

    }

    private function generateNumeroPartie(int $longueur = 10): string
    {
        $caracteres = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $maxIndex = strlen($caracteres) - 1;
        $numero = '';

        for ($i = 0; $i < $longueur; $i++) {
            $numero .= $caracteres[random_int(0, $maxIndex)];
        }

        return $numero;
    }

}
