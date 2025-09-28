<?php
require_once 'Media.php';

class Album extends Media
{
    private array $idSongs;//POUR LES MUSIQUES
    private string $editor;

    public function __construct(
        int $id,
        string $title,
        string $author,
        bool $available,
        DateTimeImmutable $createdAt,
        array $idSongs = [],
        string $editor,
    ) {
        parent::__construct($id, $title, $author, $available, $createdAt);
        $this->editor = $editor;
        $this->idSongs = $idSongs;
    }

    public function getIdSongs(): array
    {
        return $this->idSongs;
    }

    public function setIdSongs(array $idSongs): void
    {
        $this->idSongs = $idSongs;
    }

    public function getEditor(): string
    {
        return $this->editor;
    }

    public function setEditor(string $editor): void
    {
        $this->editor = $editor;
    }
}
