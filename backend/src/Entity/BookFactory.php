<?php

namespace App\Entity;

class BookFactory
{
    public static function create(string $title, array $authors, \DateTimeInterface $publishedDate): Book
    {
        $book = new Book();
        $book->setTitle($title);
        foreach ($authors as $a) {
            $author = new Author();
            $author->setName($a);
            $book->addAuthor($author);
        }
        $book->setPublishedAt($publishedDate);
        return $book;
    }
}
