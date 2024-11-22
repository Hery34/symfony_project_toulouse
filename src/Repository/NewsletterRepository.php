<?php 

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Newsletter;

class NewsletterRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Newsletter::class);
    }
    public function findAll(): array {
        return $this->findBy([], ['name' => 'ASC']);
    }
    public function findOneById(int $id): ?Newsletter {
        return $this->find($id);
    }
    public function findOneByName(string $name): ?Newsletter {
        return $this->findOneBy(['name' => $name]);
    }
    public function save(Newsletter $newsletter): void {
        $this->_em->persist($newsletter);
        $this->_em->flush();
    }
    public function remove(Newsletter $newsletter): void {
        $this->_em->remove($newsletter);
        $this->_em->flush();
    }
}