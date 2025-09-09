<?php

class Song extends Media{
    
    private int $id;
    private string $album;

    public function __construct(string $title, string $author, bool $available, int $id, string $album){
        parent::__construct($title, $author, $available);
        $this->id = $id;
        $this->album = $album;
    }

    private function getId(): int
    {
        return $this->id;
    }

    public function getAlbum() : string
    {
        return $this->album;
    }

    public function setAlbum(string $album)
    {
        $this->album = $album;
    }


}