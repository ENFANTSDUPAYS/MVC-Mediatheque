<?php

class Media
{
    private int $id;
    private string $title;
    private string $author;
    private bool $available;
    private DateTimeImmutable $createdAt;

    public function __construct(
        int $id,
        string $title,
        string $author,
        bool $available,
        DateTimeImmutable $createdAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->available = $available;
        $this->createdAt = $createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getAvailable(): bool
    {
        return $this->available;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function setAvailable(bool $available): void
    {
        $this->available = $available;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function rendre(): void
    {
        $this->available = true;
    }

    public function emprunter(): void
    {
        $this->available = false;
    }
}
