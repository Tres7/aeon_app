<?php
namespace App\Service;

use App\Repository\PartieRepository;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use LogicException;
use App\Entity\Tour;
class TourService {
    private PartieRepository $partieRepository;
    private EntityManagerInterface $entityManagerInterface;
    public function __construct(PartieRepository $partieRepository, EntityManagerInterface $entityManagerInterface) {
        $this->entityManagerInterface = $entityManagerInterface;
        $this->partieRepository = $partieRepository;
    }

    public function getTourActuel(int $partieId) {
        $partie = $this->partieRepository->find($partieId);

        if (!$partie) {
            throw new InvalidArgumentException("Partie introuvable");
        }

        if ($partie->getTours()->isEmpty()) {
            throw new LogicException("La partie n'a pas encore été démarrée");
        }

        return $partie->getTours()->last();
    }

    public function tourSuivant(int $partieId) {
        $partie = $this->partieRepository->find($partieId);

        if (!$partie) {
            throw new InvalidArgumentException("Partie introuvable");
        }
    
        if ($partie->getTours()->isEmpty()) {
            throw new LogicException("La partie n'a pas encore été démarrée");
        }

        if ($partie->getEndedAt() !== null) {
            throw new LogicException("La partie est déjà terminée.");
        }

        $tourActuel = $partie->getTours()->last();

        if ($tourActuel->getNumero() >= $partie->getExtension()->getLimiteDeTour()) {
            throw new LogicException("Le nombre maximum de tours a été atteint.");

        }

        $nouveauTour = new Tour();
        $nouveauTour->setNumero($tourActuel->getNumero() + 1);
        $partie->addTour($nouveauTour);

        $this->entityManagerInterface->persist($nouveauTour);
        $this->entityManagerInterface->flush();

        return $nouveauTour;


    }
}