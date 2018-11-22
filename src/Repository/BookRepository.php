<?php

namespace App\Repository;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use PhpParser\ErrorHandler\Collecting;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function findFirstsAuthorBooks(Author $author, int $limit, Book $book = null): array
    {
        $qb = $this->createQueryBuilder('b');

        $qb = $qb->innerJoin('b.author', 'a')
            ->where($qb->expr()->eq('a.id', ':author'));

        if ($book != null) {
            $qb = $qb->andWhere($qb->expr()->neq('b.id', ':book'))
                ->setParameter(':book', $book->getId());
        }

        return $qb->setParameter(':author', $author->getId())
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

    }

    public function findLast(int $limit) : array
    {
        $qb = $this->createQueryBuilder('b');

        $qb = $qb->select('b', 'a')
            ->innerJoin('b.author', 'a')
            ->orderBy('b.createdAt', 'DESC')
            ->setMaxResults($limit);

        return $qb->getQuery()->getResult();
    }



    // /**
    //  * @return Book[] Returns an array of Book objects
    //  */
    /*
    public function findByExampleField($value)

        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
