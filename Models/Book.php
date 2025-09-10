<?php

class Book extends Media{

    private int $pageNumber;

    public function __construct(string $title, string $author, bool $available, int $id, int $pageNumber)
    {
        parent::__construct($id,$title, $author, $available);
        $this->pageNumber = $pageNumber;
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