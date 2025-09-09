<?php

class Book extends Media{

    private int $id;
    private int $pageNumber;

    public function __construct(string $title, string $author, bool $available, int $id, int $pageNumber)
    {
        parent::__construct($title, $author, $available);
        $this->id = $id;
        $this->pageNumber = $pageNumber;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPageNumber() : int
    {
        return $this->pageNumber;
    }

    public function setPageNumber(int $pageNumber)
    {
        $this->pageNumber = $pageNumber;
    }
}