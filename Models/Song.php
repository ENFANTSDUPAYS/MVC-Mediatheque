<?php

class Song extends Media{
    
    private int $id_album;

    public function __construct(string $title, string $author, bool $available, int $id, int $id_album){
        parent::__construct($id,$title, $author, $available);
        $this->id_album = $id_album;
    }

    public function getIdAlbum(): int
    {
        return $this->id_album;
    }

    public function setAlbum(string $album)
    {
        $this->album = $album;
    }


}