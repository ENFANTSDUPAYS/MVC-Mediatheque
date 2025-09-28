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
            "INSERT INTO media (title, author, available, created_at, type) 
             VALUES (:title, :author, :available, :created_at, 'movie')"
        );
        $stmt->execute([
            ':title' => $movie->getTitle(),
            ':author' => $movie->getAuthor(),
            ':available' => $movie->getAvailable() ? 1 : 0,
            ':created_at' => $movie->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
        $mediaId = (int)$this->pdo->lastInsertId();

        $stmt2 = $this->pdo->prepare(
            "INSERT INTO movie (media_id, duration, genre_id) VALUES (:media_id, :duration, :genre_id)"
        );
        $stmt2->execute([
            ':media_id' => $mediaId,
            ':duration' => $movie->getDuration(),
            ':genre_id' => $movie->getGenre()->getId()
        ]);
    }

    public function addBook(Book $book): void {
        $stmt = $this->pdo->prepare(
            "INSERT INTO media (title, author, available, created_at, type) 
             VALUES (:title, :author, :available, :created_at, 'book')"
        );
        $stmt->execute([
            ':title' => $book->getTitle(),
            ':author' => $book->getAuthor(),
            ':available' => $book->getAvailable() ? 1 : 0,
            ':created_at' => $book->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
        $mediaId = (int)$this->pdo->lastInsertId();

        $stmt2 = $this->pdo->prepare(
            "INSERT INTO book (media_id, pagenumber) VALUES (:media_id, :pagenumber)"
        );
        $stmt2->execute([
            ':media_id' => $mediaId,
            ':pagenumber' => $book->getPageNumber()
        ]);
    }

    public function addSong(Song $song): void {
        $stmt = $this->pdo->prepare(
            "INSERT INTO media (title, author, available, created_at, type) 
             VALUES (:title, :author, :available, :created_at, 'song')"
        );
        $stmt->execute([
            ':title' => $song->getTitle(),
            ':author' => $song->getAuthor(),
            ':available' => $song->getAvailable() ? 1 : 0,
            ':created_at' => $song->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
        $mediaId = (int)$this->pdo->lastInsertId();

        $stmt2 = $this->pdo->prepare(
            "INSERT INTO song (media_id, album_id) VALUES (:media_id, :album_id)"
        );
        $stmt2->execute([
            ':media_id' => $mediaId,
            ':album_id' => $song->getIdAlbum()
        ]);
    }

    public function addAlbum(Album $album): void {
        $stmt = $this->pdo->prepare(
            "INSERT INTO media (title, author, available, created_at, type) 
             VALUES (:title, :author, :available, :created_at, 'album')"
        );
        $stmt->execute([
            ':title' => $album->getTitle(),
            ':author' => $album->getAuthor(),
            ':available' => $album->getAvailable() ? 1 : 0,
            ':created_at' => $album->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
        $mediaId = (int)$this->pdo->lastInsertId();

        $stmt2 = $this->pdo->prepare(
            "INSERT INTO album (media_id, editor) VALUES (:media_id, :editor)"
        );
        $stmt2->execute([
            ':media_id' => $mediaId,
            ':editor' => $album->getEditor()
        ]);

        if (!empty($album->getIdSongs())) {
            $stmt3 = $this->pdo->prepare(
                "UPDATE song SET album_id = :album_id WHERE id = :song_id"
            );
            foreach ($album->getIdSongs() as $songId) {
                $stmt3->execute([
                    ':album_id' => $mediaId,
                    ':song_id' => $songId
                ]);
            }
        }
    }
}
