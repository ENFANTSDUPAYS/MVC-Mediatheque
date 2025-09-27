<?php

class Movie extends Media{

    private float $duration;

    private Genre $genre;

    public function __construct(int $id, string $title, string $author, bool $available, DateTimeImmutable $createdAt, float $duration, Genre $genre)
    {
        parent::__construct($id,$title, $author, $available, $createdAt);
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

    public function addMovie(Movie $movie): void
    {
        $query = getConnexion()->prepare("INSERT INTO movie (title, author, available, duration, genre_id) VALUES (:title, :author, :available, :duration, :genre_id)");
        $query->bindValue(':title', $movie->getTitle());
        $query->bindValue(':author', $movie->getAuthor());
        $query->bindValue(':available', $movie->getAvailable(), PDO::PARAM_BOOL);
        $query->bindValue(':duration', $movie->getDuration());
        $query->bindValue(':genre_id', $movie->getGenre()->value);
        $query->execute();
    }
}