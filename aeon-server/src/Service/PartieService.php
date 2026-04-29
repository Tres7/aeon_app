<?php
namespace App\Service;


use InvalidArgumentException;
use App\Repository\ExtensionRepository;
use App\Repository\PartieRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Partie;

class PartieService {
    private ExtensionRepository $extensionRepository;
    private EntityManagerInterface $entityManagerInterface;

    private PartieRepository $partieRepository;

    public function __construct(ExtensionRepository $extensionRepository, EntityManagerInterface $entityManagerInterface, PartieRepository $partieRepository) {
        $this->extensionRepository = $extensionRepository;
        $this->entityManagerInterface = $entityManagerInterface;
        $this->partieRepository = $partieRepository;
    }

    public function createPartie(int $nbreJoueurs, int $extensionId) {
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

    public function getPartie(int $partieId) {
        $partie = $this->partieRepository->find($partieId);

        if (!$partie) {
            throw new InvalidArgumentException("Partie introuvable");
        }

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
