<?php

use App\Repository\ExtensionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Partie;

class PartieService {
    private ExtensionRepository $extensionRepository;
    private EntityManagerInterface $entityManagerInterface;

    public function __construct(ExtensionRepository $extensionRepository, EntityManagerInterface $entityManagerInterface) {
        $this->extensionRepository = $extensionRepository;
        $this->entityManagerInterface = $entityManagerInterface;
    }

    public function createPart(int $nbreJoueurs, int $extensionId) {
        $extension = $this->extensionRepository->find($extensionId);

        if (!$extensionId) {
            throw new InvalidArgumentException("Extension introuvable");
        }

        $partie = new Partie();
        $partie->setNumero($this->generateNumeroPartie());
        $partie->setCreatedAt(new \DateTimeImmutable);
        $partie -> setNbreJoueurs($nbreJoueurs);

        $this->entityManagerInterface->persist($partie);
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
?>