<?php

namespace App\Controller;

use App\ArgumentResolver\QueryParam;
use App\Exception\BookNotFoundException;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

#[Route(path: "/books", name: "books_")]
class BookController extends AbstractController implements LoggerAwareInterface
{
    private LoggerInterface $logger;

    public function __construct(
        private readonly BookRepository $books,
        private readonly EntityManagerInterface $objectManager
    ) {
    }

    #[Route(path: "", name: "all", methods: ["GET"])]
    public function all(
        #[QueryParam] string $keyword,
        #[QueryParam] int    $offset = 0,
        #[QueryParam] int    $limit = 20
    ): Response {
        // Make sure offset & limit are not negative
        if ($offset < 0)
            $offset = 0;
        if ($limit < 0)
            $limit = 20;

        $this->logger->debug("request param: keyword=[$keyword], offset=[$offset], limit=[$limit]");
        $data = $this->books->findByKeyword($keyword, $offset, $limit);
        $this->logger->debug("Returned " . count($data->getContent()) . " books");

        return $this->json($data);
    }

    #[Route(path: "/{id}", name: "byId", methods: ["GET"])]
    public function getById(UUid $id): Response
    {
        $data = $this->books->findOneBy(["id" => $id]);
        if (!$data) {
            throw new BookNotFoundException($id);
        }
        return $this->json($data);
    }

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}
