<?php

class Album extends Media{

    private int $id;
    private int $songNumber;

    private string $editor;

    public function __construct(string $title, string $author, bool $available, int $id, int $songNumber, string $editor)
    {
        parent::__construct($title, $author, $available);
        $this->id = $id;
        $this->songNumber = $songNumber;
        $this->editor = $editor;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSongNumber(): int
    {
        return $this->songNumber;
    }

    public function getEditor(): string
    {
        return $this->editor;
    }

    public function setSongNumber(int $songNumber): void
    {
        $this->songNumber = $songNumber;
    }

    public function setEditor(string $editor): void
    {
        $this->editor = $editor;
    }

    public function addAlbum(Album $album): void
    {
        $query = getConnexion()->prepare("INSERT INTO albums (title, author, available, songNumber, editor) VALUES (:title, :author, :available, :songNumber, :editor)");
        $query->bindValue(':title', $album->getTitle());
        $query->bindValue(':author', $album->getAuthor());
        $query->bindValue(':available', $album->getAvailable(), PDO::PARAM_BOOL);
        $query->bindValue(':songNumber', $album->getSongNumber(), PDO::PARAM_INT);
        $query->bindValue(':editor', $album->getEditor());
        $query->execute();
    }

    private function editAlbum(Album $album): void
    {
        $query = getConnexion()->prepare("UPDATE albums SET title = :title, author = :author, available = :available, songNumber = :songNumber, editor = :editor WHERE id = :id");
        $query->bindValue(':id', $album->getId(), PDO::PARAM_INT);
        $query->bindValue(':title', $album->getTitle());
        $query->bindValue(':author', $album->getAuthor());
        $query->bindValue(':available', $album->getAvailable(), PDO::PARAM_BOOL);
        $query->bindValue(':songNumber', $album->getSongNumber(), PDO::PARAM_INT);
        $query->bindValue(':editor', $album->getEditor());
        $query->execute();
    }

    private function deleteAlbum(int $id): void
    {
        $query = getConnexion()->prepare("DELETE FROM albums WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }
}