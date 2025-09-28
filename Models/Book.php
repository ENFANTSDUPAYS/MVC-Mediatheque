<?php
require_once 'Media.php';

class Book extends Media
{
    private int $pageNumber;

    public function __construct(
        int $id,
        string $title,
        string $author,
        bool $available,
        DateTimeImmutable $createdAt,
        int $pageNumber
    ) {
        parent::__construct($id, $title, $author, $available, $createdAt);
        $this->pageNumber = $pageNumber;
    }

    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }

    public function setPageNumber(int $pageNumber): void
    {
        $this->pageNumber = $pageNumber;
    }
}
