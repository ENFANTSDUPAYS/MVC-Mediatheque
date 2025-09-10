<?php

class Movie extends Media{

    private float $duration;

    private Genre $genre;

    public function __construct(string $title, string $author, bool $available, int $id, float $duration, Genre $genre)
    {
        parent::__construct($id,$title, $author, $available);
        $this->duration = $duration;
        $this->genre = $genre;
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