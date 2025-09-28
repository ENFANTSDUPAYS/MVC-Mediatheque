<?php
require_once 'Media.php';

class Album extends Media
{
    private array $songIds;//POUR LES MUSIQUES
    private string $editor;

    public function __construct(
        int $id,
        string $title,
        string $author,
        bool $available,
        DateTimeImmutable $createdAt,
        string $editor,
        array $songIds = []
    ) {
        parent::__construct($id, $title, $author, $available, $createdAt);
        $this->editor = $editor;
        $this->songIds = $songIds;
    }

    public function getSongIds(): array
    {
        return $this->songIds;
    }

    public function setSongIds(array $songIds): void
    {
        $this->songIds = $songIds;
    }

    public function getEditor(): string
    {
        return $this->editor;
    }

    public function setEditor(string $editor): void
    {
        $this->editor = $editor;
    }

    public function addSongId(int $songId): void {
        if (!in_array($songId, $this->songIds)) {
            $this->songIds[] = $songId;
        }
    }

    public function removeSongId(int $songId): void {
        $this->songIds = array_filter($this->songIds, fn($id) => $id !== $songId);
    }
}
