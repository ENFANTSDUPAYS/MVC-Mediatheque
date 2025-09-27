<?php
require_once 'Media.php';

class Album extends Media{

    private int $idSong;

    private string $editor;

    public function __construct(int $id, string $title, string $author, bool $available, DateTimeImmutable $createdAt, int $idSong, string $editor)
    {
        parent::__construct( $id, $title, $author, $available, $createdAt);
        $this->idSong = $idSong;
        $this->editor = $editor;
    }
    public function getIdSong(): int
    {
        return $this->idSong;
    }

    public function getEditor(): string
    {
        return $this->editor;
    }

    public function setIdSong(int $idSong): void
    {
        $this->idSong = $idSong;
    }

    public function setEditor(string $editor): void
    {
        $this->editor = $editor;
    }

    public function addAlbum(Album $album): void
    {
        $query = getConnexion()->prepare("INSERT INTO album (title, author, available, id_song, editor) VALUES (:title, :author, :available, :id_song, :editor)");
        $query->bindValue(':title', $album->getTitle());
        $query->bindValue(':author', $album->getAuthor());
        $query->bindValue(':available', $album->getAvailable(), PDO::PARAM_BOOL);
        $query->bindValue(':id_song', $album->getIdSong(), PDO::PARAM_INT);
        $query->bindValue(':editor', $album->getEditor());
        $query->execute();
    }

    private function editAlbum(Album $album): void
    {
        $query = getConnexion()->prepare("UPDATE album SET title = :title, author = :author, available = :available, id_song = :id_song, editor = :editor WHERE id = :id");
        $query->bindValue(':id', $album->getId(), PDO::PARAM_INT);
        $query->bindValue(':title', $album->getTitle());
        $query->bindValue(':author', $album->getAuthor());
        $query->bindValue(':available', $album->getAvailable(), PDO::PARAM_BOOL);
        $query->bindValue(':id_song', $album->getIdSong(), PDO::PARAM_INT);
        $query->bindValue(':editor', $album->getEditor());
        $query->execute();
    }

    private function deleteAlbum(int $id): void
    {
        $query = getConnexion()->prepare("DELETE FROM album WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }
}