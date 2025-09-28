<?php
class User {
    private int $id;

    private string $firstname;

    private string $lastname;
    
    private string $email;

    private string $password;

    private DateTimeImmutable $createdAt;
    
    private DateTimeImmutable $updatedAt;

     public function __construct() {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getId(): int {
        return $this->id;
    }

    public function getFirstname() : ?string {
        return $this->firstname;
    }

    public function getLastname() : ?string  {
        return $this->lastname;
    }

    public function getEmail() : ?string  {
        return $this->email;
    }

    public function getPassword() : ?string {
        return $this->password;
    }

    public function setFirstname(string $firstname) {
        $this->firstname = $firstname;
    }

    public function setLastname(string $lastname) {
        $this->lastname = $lastname;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }  

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function getCreatedAt(): ?DateTimeImmutable {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeImmutable {
        return $this->updatedAt;
    }
    
    public function setCreatedAt(DateTimeImmutable $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }
}