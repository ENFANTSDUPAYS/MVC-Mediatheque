<?php

class Media{
    
    private int $id;
    private string $title;

    private string $author;

    private bool $available;


    public function __construct(int $id, string $title, string $author, bool $available){
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->available = $available;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getAuthor() : string
    {
        return $this->author;
    }

    public function getAvailable() : bool
    {
        return $this->available;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setAuthor(string $author){
        
        $this->author = $author;
    }

    public function setAvailable(bool $available){

        $this->available = $available;
    }

    public function rendre($available){
        $this->available = true;
        return $available;
    }

    public function emprunter($available){
        $this->available = false;
        return $available;
    }

}