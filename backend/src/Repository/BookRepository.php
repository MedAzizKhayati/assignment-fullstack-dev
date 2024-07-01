<?php

namespace App\Repository;

use App\Dto\Page;
use App\Dto\BookSummaryDto;
use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function getEntityManager(): EntityManagerInterface
    {
        return parent::getEntityManager();
    }

    public function findByKeyword(string $q, int $offset = 0, int $limit = 20): Page
    {
        $query = $this->createQueryBuilder("b")
            ->leftJoin("b.authors", "a")
            ->andWhere("UPPER(b.title) LIKE UPPER(:q) OR UPPER(a.name) LIKE UPPER(:q)")
            ->setParameter('q', "%" . $q . "%")
            ->orderBy('b.publishedAt', 'DESC')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery();

        $paginator = new Paginator($query);
        $c = count($paginator);
        $content = new ArrayCollection();
        foreach ($paginator as $book) {
            $content->add(BookSummaryDto::of($book));
        }
        return Page::of($content, $c, $offset, $limit);
    }
}
