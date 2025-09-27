<?php

class Song extends Media{
    
    private int $id_album;

    public function __construct(int $id, string $title, string $author, bool $available, DateTimeImmutable $createdAt, int $id_album){
        parent::__construct($id,$title, $author, $available, $createdAt);
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

    public function addSong(Song $song): void
    {
        $query = getConnexion()->prepare("INSERT INTO song (title, author, available) VALUES (:title, :author, :available)");
        $query->bindValue(':title', $song->getTitle());
        $query->bindValue(':author', $song->getAuthor());
        $query->bindValue(':available', $song->getAvailable(), PDO::PARAM_BOOL);
        $query->execute();
    }

    public function editSong(Song $song): void
    {
        $query = getConnexion()->prepare("UPDATE song SET title = :title, author = :author, available = :available WHERE id = :id");
        $query->bindValue(':id', $song->getId(), PDO::PARAM_INT);
        $query->bindValue(':title', $song->getTitle());
        $query->bindValue(':author', $song->getAuthor());
        $query->bindValue(':available', $song->getAvailable(), PDO::PARAM_BOOL);
        $query->execute();
    }

    public function deleteSong(int $id): void
    {
        $query = getConnexion()->prepare("DELETE FROM song WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }


}