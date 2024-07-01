<?php

namespace App\Dto;

use App\Entity\Book;
use Doctrine\Common\Collections\Collection;

class BookSummaryDto
{
    private string $id;
    private string $title;
    private array $authors;
    private \DateTimeInterface $publishedAt;

    static function of(Book $book): BookSummaryDto
    {
        $dto = new BookSummaryDto();
        $dto->setId($book->getId())
            ->setTitle($book->getTitle())
            ->setAuthors($book->getAuthors())
            ->setPublishedAt($book->getPublishedAt());
        return $dto;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return BookSummaryDto
     */
    public function setId(string $id): BookSummaryDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return BookSummaryDto
     */
    public function setTitle(string $title): BookSummaryDto
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @param Collection $authors
     * @return BookSummaryDto
     */
    public function setAuthors(Collection $authors): BookSummaryDto
    {
        $this->authors = $authors->map(function ($author) {
            return [
                'id' => $author->getId(),
                'name' => $author->getName()
            ];
        })->toArray();
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getPublishedAt(): \DateTimeInterface
    {
        return $this->publishedAt;
    }

    /**
     * @param \DateTimeInterface $publishedAt
     * @return BookSummaryDto
     */
    public function setPublishedAt(\DateTimeInterface $publishedAt): BookSummaryDto
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    public function __toString(): string
    {
        $authorsString = implode(', ', $this->authors);
        return "BookSummaryDto[id=" . $this->id
            . ", title=" . $this->title
            . ", authors=[" . $authorsString . "]"
            . ", publishedAt=" . $this->publishedAt->format('Y-m-d') . "]";
    }
}
