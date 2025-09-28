<?php 

enum Genre: int {
    case Fiction = 1;
    case ScienceFiction = 2;
    case Biographie = 3;
    case Histoire = 4;
    case Enfants = 5;
    case Jeunesse = 6;
    case Policier = 7;
    case Thriller = 8;
    case Fantastique = 9;
    case Romance = 10;
    case Aventure = 11;

    public function getId(): int {
        return $this->value;
    }

    public function getTitle(): string {
        return match($this) {
            self::Fiction => 'Fiction',
            self::ScienceFiction => 'Science-Fiction',
            self::Biographie => 'Biographie',
            self::Histoire => 'Histoire',
            self::Enfants => 'Enfants',
            self::Jeunesse => 'Jeunesse',
            self::Policier => 'Policier',
            self::Thriller => 'Thriller',
            self::Fantastique => 'Fantastique',
            self::Romance => 'Romance',
            self::Aventure => 'Aventure',
        };
    }
}
