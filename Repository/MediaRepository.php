<?php
require_once __DIR__ . '/../Models/connexion.php';
require_once __DIR__ . '/../Models/connexion.php';
require_once __DIR__ . '/../Models/Movie.php';
require_once __DIR__ . '/../Models/Book.php';
require_once __DIR__ . '/../Models/Song.php';
require_once __DIR__ . '/../Models/Album.php';
require_once __DIR__ . '/../Models/Genre.php';

class MediaRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = getConnexion();
    }
    public function addMovie(Movie $movie): void {
        $stmt = $this->pdo->prepare(
            "INSERT INTO movie (title, author, available, created_at, duration, genre_id) 
            VALUES (:title, :author, :available, :created_at, :duration, :genre_id)"
        );

        $stmt->execute([
            ':title' => $movie->getTitle(),
            ':author' => $movie->getAuthor(),
            ':available' => $movie->getAvailable() ? 1 : 0,
            ':created_at' => $movie->getCreatedAt()->format('Y-m-d H:i:s'),
            ':duration' => $movie->getDuration(),
            ':genre_id' => $movie->getGenre(),
        ]);
    }

    //AJOUT D'UN LIVRE
    public function addBook(Book $book): void {
        $stmt = $this->pdo->prepare(
            "INSERT INTO book (title, author, available, created_at, pagenumber) 
            VALUES (:title, :author, :available, :created_at, :pagenumber)"
        );

        $stmt->execute([
            ':title' => $book->getTitle(),
            ':author' => $book->getAuthor(),
            ':available' => $book->getAvailable() ? 1 : 0,
            ':created_at' => $book->getCreatedAt()->format('Y-m-d H:i:s'),
            ':pagenumber' => $book->getPageNumber()
        ]);
    }

    //AJOUT D'UN SON
    public function addSong(Song $song): void {
        $stmt = $this->pdo->prepare(
            "INSERT INTO song (title, author, available, created_at, album_id) 
            VALUES (:title, :author, :available, :created_at, :album_id)"
        );

        $stmt->execute([
            ':title' => $song->getTitle(),
            ':author' => $song->getAuthor(),
            ':available' => $song->getAvailable() ? 1 : 0,
            ':created_at' => $song->getCreatedAt()->format('Y-m-d H:i:s'),
            ':album_id' => $song->getIdAlbum() ?? null
        ]);
    }

    //AJOUT D'UN ALBUM
    public function addAlbum(Album $album): void {
        $stmt = $this->pdo->prepare(
            "INSERT INTO album (title, author, available, editor, created_at) 
            VALUES (:title, :author, :available, :editor, :created_at)"
        );
        $stmt->execute([
            ':title' => $album->getTitle(),
            ':author' => $album->getAuthor(),
            ':available' => $album->getAvailable() ? 1 : 0,
            ':editor' => $album->getEditor(),
            ':created_at' => $album->getCreatedAt()->format('Y-m-d H:i:s')
        ]);

        $albumId = (int)$this->pdo->lastInsertId();

        //ASSOCIATION DES SONS
        if (!empty($album->getIdSongs())) {
            $stmt2 = $this->pdo->prepare(
                "UPDATE song SET album_id = :album_id WHERE id = :song_id"
            );
            foreach ($album->getIdSongs() as $songId) {
                $stmt2->execute([
                    ':album_id' => $albumId,
                    ':song_id' => $songId
                ]);
            }
        }
    }
    
    //MODIFIER UN FILM
    public function updateMovie(Movie $movie): void {
        $stmt = $this->pdo->prepare(
            "UPDATE movie SET 
                title = :title, 
                author = :author, 
                available = :available, 
                duration = :duration, 
                genre_id = :genre_id 
            WHERE id = :id"
        );

        $stmt->execute([
            ':title' => $movie->getTitle(),
            ':author' => $movie->getAuthor(),
            ':available' => $movie->getAvailable() ? 1 : 0,
            ':duration' => $movie->getDuration(),
            ':genre_id' => $movie->getGenre() ? $movie->getGenre()->getId() : null,
            ':id' => $movie->getId()
        ]);
    }


    //MODIFIER UN BOOK
    public function updateBook(Book $book): void {
        $stmt = $this->pdo->prepare(
            "UPDATE book SET 
                title = :title, 
                author = :author, 
                available = :available, 
                pagenumber = :pagenumber 
            WHERE id = :id"
        );

        $stmt->execute([
            ':title' => $book->getTitle(),
            ':author' => $book->getAuthor(),
            ':available' => $book->getAvailable() ? 1 : 0,
            ':pagenumber' => $book->getPageNumber(),
            ':id' => $book->getId()
        ]);
    }

    //MODIFIER UN SONG
    public function editSong(Song $song): void {
        $stmt = $this->pdo->prepare(
            "UPDATE song SET 
                title = :title, 
                author = :author, 
                available = :available, 
                album_id = :album_id 
            WHERE id = :id"
        );

        $stmt->execute([
            ':title' => $song->getTitle(),
            ':author' => $song->getAuthor(),
            ':available' => $song->getAvailable() ? 1 : 0,
            ':album_id' => $song->getIdAlbum() ?? null,
            ':id' => $song->getId()
        ]);
    }

    //MODIFIER UN ALBUM
    public function editAlbum(Album $album): void {
        $stmt = $this->pdo->prepare(
            "UPDATE album SET 
                title = :title, 
                author = :author, 
                available = :available, 
                editor = :editor 
            WHERE id = :id"
        );

        $stmt->execute([
            ':title' => $album->getTitle(),
            ':author' => $album->getAuthor(),
            ':available' => $album->getAvailable() ? 1 : 0,
            ':editor' => $album->getEditor(),
            ':id' => $album->getId()
        ]);

        //UPDATE POUR LES CHANSONSS
        if (!empty($album->getIdSongs())) {
            $stmt2 = $this->pdo->prepare(
                "UPDATE song SET album_id = :album_id WHERE id = :song_id"
            );
            foreach ($album->getIdSongs() as $songId) {
                $stmt2->execute([
                    ':album_id' => $album->getId(),
                    ':song_id' => $songId
                ]);
            }
        }
    }


   public function deleteMedia(int $id, string $type): bool {
    try {
        $allowedTypes = ['book', 'movie', 'song', 'album'];

        if (!in_array($type, $allowedTypes)) {
            throw new Exception("Type de média inconnu : " . htmlspecialchars($type));
        }

        $stmt = $this->pdo->prepare("DELETE FROM $type WHERE id = :id");
        return $stmt->execute([':id' => $id]);

    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}

}
