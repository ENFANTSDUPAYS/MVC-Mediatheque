<?php
require_once 'Media.php';

class Song extends Media
{
    private ?int $albumId;

    public function __construct(
        int $id,
        string $title,
        string $author,
        bool $available,
        DateTimeImmutable $createdAt,
        ?int $albumId
        
    ) {
        parent::__construct($id, $title, $author, $available, $createdAt);
        $this->albumId = $albumId;
    }

    public function getAlbumId(): int
    {
        return $this->albumId;
    }

    public function setAlbumId(int $albumId): void
    {
        $this->albumId = $albumId;
    }
}
