<?php

namespace App\Entity;

use App\Repository\BookRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

#[Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[Id]
    // Since DBAL 3.0, this does not work.
    //#[GeneratedValue(strategy: "UUID")//#[Column(type: "string", unique: true)]
    #[Column(type: "uuid", unique: true)]
    #[GeneratedValue(strategy: "CUSTOM")]
    #[CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id = null;

    #[Column(type: "string", length: 255)]
    private string $title;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private DateTimeInterface|null $createdAt = null;

    #[Column(name: "published_at", type: "datetime", nullable: true)]
    private DateTimeInterface|null $publishedAt = null;

    #[ManyToMany(targetEntity: Author::class, mappedBy: "books", cascade: ['persist'], fetch: 'EAGER')]
    private Collection $authors;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->authors = new ArrayCollection();
    }

    /**
     * @return Uuid|null
     */
    public function getId(): ?Uuid
    {
        return $this->id;
    }

    /**
     * @param Uuid $id
     */
    public function setId(Uuid $id): self
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
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }


    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface|null $createdAt
     * @return Book
     */
    public function setCreatedAt(?DateTimeInterface $createdAt): Book
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getPublishedAt(): ?DateTimeInterface
    {
        return $this->publishedAt;
    }

    /**
     * @param DateTimeInterface|null $publishedAt
     * @return Book
     */
    public function setPublishedAt(?DateTimeInterface $publishedAt): Book
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }


    /**
     * @return Collection
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(Author $tag): self
    {
        if (!$this->authors->contains($tag)) {
            $this->authors[] = $tag;
            $tag->addBook($this);
        }

        return $this;
    }

    public function removeAuthor(Author $tag): self
    {
        if ($this->authors->removeElement($tag)) {
            $tag->removeBook($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return "Book: [ id =" . $this->getId()
            . ", title=" . $this->getTitle()
            . ", createdAt=" . $this->getCreatedAt()?->getTimestamp()
            . ", publishedAt=" . $this->getPublishedAt()?->getTimestamp()
            . "]";
    }

}
