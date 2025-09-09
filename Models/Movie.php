<?php

class Movie extends Media{

    private int $id;
    private float $duration;

    private Genre $genre;

    public function __construct(string $title, string $author, bool $available, int $id, float $duration, Genre $genre)
    {
        parent::__construct($title, $author, $available);
        $this->id = $id;
        $this->duration = $duration;
        $this->genre = $genre;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDuration() : float
    {
        return $this->duration;
    }
    public function getGenre() : Genre
    {
        return $this->genre;
    }
    public function setDuration(float $duration)
    {
        $this->duration = $duration;
    }
}