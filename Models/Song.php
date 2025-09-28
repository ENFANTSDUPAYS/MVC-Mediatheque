<?php
require_once 'Media.php';

class Song extends Media
{
    private int $id_album;

    public function __construct(
        int $id,
        string $title,
        string $author,
        bool $available,
        DateTimeImmutable $createdAt,
        int $id_album = 0,
    ) {
        parent::__construct($id, $title, $author, $available, $createdAt);
        $this->id_album = $id_album;
    }

    public function getIdAlbum(): int
    {
        return $this->id_album;
    }

    public function setIdAlbum(int $id_album): void
    {
        $this->id_album = $id_album;
    }
}
