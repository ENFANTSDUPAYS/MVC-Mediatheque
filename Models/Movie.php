<?php
require_once 'Media.php';
require_once 'Genre.php';

class Movie extends Media
{
    private float $duration;
    private Genre $genre;

    public function __construct(
        int $id,
        string $title,
        string $author,
        bool $available,
        DateTimeImmutable $createdAt,
        float $duration,
        Genre $genre
    ) {
        parent::__construct($id, $title, $author, $available, $createdAt);
        $this->duration = $duration;
        $this->genre = $genre;
    }

    public function getDuration(): float
    {
        return $this->duration;
    }

    public function setDuration(float $duration): void
    {
        $this->duration = $duration;
    }

    public function getGenre(): Genre
    {
        return $this->genre;
    }

    public function setGenre(Genre $genre): void
    {
        $this->genre = $genre;
    }
}
