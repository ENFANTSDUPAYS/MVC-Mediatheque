<?php
require_once __DIR__ . '/../Models/connexion.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Repository/MediaRepository.php';
require_once __DIR__ . '/../Models/Movie.php';
require_once __DIR__ . '/../Models/Book.php';
require_once __DIR__ . '/../Models/Song.php';
require_once __DIR__ . '/../Models/Album.php';
require_once __DIR__ . '/../Models/Genre.php';


use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;

class MediaController {

    public function listMedia() {
        try {
            $pdo = getConnexion();

            $books  = $pdo->query("SELECT id, title, author, available, created_at, 'Livre' AS type FROM book")->fetchAll(PDO::FETCH_ASSOC);
            $albums = $pdo->query("SELECT id, title, author, available, created_at, 'Album' AS type FROM album")->fetchAll(PDO::FETCH_ASSOC);
            $movies = $pdo->query("SELECT id, title, author, available, created_at, 'Film' AS type FROM movie")->fetchAll(PDO::FETCH_ASSOC);
            $songs  = $pdo->query("SELECT id, title, author, available, created_at, 'Chanson' AS type FROM song")->fetchAll(PDO::FETCH_ASSOC);


            $medias = array_merge($books, $albums, $movies, $songs);

            $titleFilter     = $_GET['title'] ?? '';
            $authorFilter    = $_GET['author'] ?? '';
            $availableFilter = $_GET['available'] ?? '';

            $medias = array_filter($medias, function($media) use ($titleFilter, $authorFilter, $availableFilter) {
                $match = true;

                if ($titleFilter !== '') {
                    $match = $match && str_contains(strtolower($media['title']), strtolower($titleFilter));
                }
                if ($authorFilter !== '') {
                    $match = $match && str_contains(strtolower($media['author']), strtolower($authorFilter));
                }
                if ($availableFilter !== '') {
                    $match = $match && $media['available'] == $availableFilter;
                }

                return $match;
            });


            usort($medias, function($a, $b){
                return strtotime($b['created_at']) <=> strtotime($a['created_at']);
            });

            $adapter = new ArrayAdapter($medias);
            $pagerfanta = new Pagerfanta($adapter);

            $currentPage = max(1, (int)($_GET['pageNum'] ?? 1));
            $pagerfanta->setMaxPerPage(10);
            $pagerfanta->setCurrentPage($currentPage);

            return $pagerfanta;

        } catch (PDOException $e) {
            error_log('Database error: ' . $e->getMessage());
            return new Pagerfanta(new ArrayAdapter([]));
        }
    }

    public function addMedia(): array {
    $error = '';
    $success = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim($_POST['title'] ?? '');
        $author = trim($_POST['author'] ?? '');
        $available = isset($_POST['available']) ? (bool)$_POST['available'] : false;
        $type = $_POST['type'] ?? '';
        $createdAt = new DateTimeImmutable();

        $repo = new MediaRepository();

        try {
            switch ($type) {
                case 'movie':
                    $duration = (float)($_POST['duration']);
                    $genreId = (int)($_POST['genre_id']);
                    $genre = Genre::tryFrom($genreId);
                    $movie = new Movie(0, $title, $author, $available, $createdAt, $duration, $genre);
                    $repo->addMovie($movie);
                    $_SESSION['success'] = "Le film a été ajouté avec succès !";
                    break;

                case 'book':
                    $pagenumber = (int)($_POST['pagenumber'] ?? 0);
                    $book = new Book(0, $title, $author, $available, $createdAt, $pagenumber);
                    $repo->addBook($book);
                    $_SESSION['success'] = "Le livre a été ajouté avec succès !";
                    break;

                case 'song':
                    $albumId = isset($_POST['album_id']) && $_POST['album_id'] !== '' ? (int)$_POST['album_id'] : null;
                    $song = new Song(0, $title, $author, $available, $createdAt, $albumId);
                    $repo->addSong($song);
                    $_SESSION['success'] = "La chanson a été ajoutée avec succès !";
                    break;

                case 'album':
                    $editor = $_POST['editor'];
                    $songIds = $_POST['id_song'] ?? [];
                    $album = new Album(0, $title, $author, $available, $createdAt, $editor, array_map('intval', $songIds));
                    $repo->addAlbum($album);
                    $_SESSION['success'] = "L'album a été ajouté avec succès !";
                    break;

                default:
                    $_SESSION['error'] = "Type de média invalide.";
            }
            header("Location: index.php?page=listMedia");
            exit;

        } catch (PDOException $e) {
            error_log("Database error: ".$e->getMessage());
            $_SESSION['error'] = "Une erreur est survenue lors de l'ajout du média.";
            header("Location: index.php?page=listMedia");
            exit;
        }
    }

        return ['error' => $error, 'success' => $success];
    }


    public function editMedia(): array {
        $repo = new MediaRepository();
        //RECUPERATION EN GET
        $id = $_POST['id'] ?? null;
        $type = $_POST['type'] ?? null;

        if (!$id || !$type) {
            $_SESSION['errors'] = "Média ou type invalide.";
            header('Location: index.php?page=listMedia');
            exit;
        }

        try {
            switch ($type) {
                case 'book':
                    $book = new Book(
                        (int)$id,
                        $_POST['title'],
                        $_POST['author'],
                        (bool)$_POST['available'],
                        new DateTimeImmutable(),
                        (int)$_POST['pagenumber']
                    );
                    $repo->editBook($book);
                    break;

                case 'movie':
                    $movie = new Movie(
                        (int)$id,
                        $_POST['title'],
                        $_POST['author'],
                        (bool)$_POST['available'],
                        new DateTimeImmutable(),
                        $_POST['duration'],
                        $_POST['genre_id'],
                    );
                    $repo->editMovie($movie);
                    break;

                case 'song':
                    $albumId = $_POST['album_id'] ?? null;
                    $song = new Song(
                        (int)$id,
                        $_POST['title'],
                        $_POST['author'],
                        (bool)$_POST['available'],
                        new DateTimeImmutable(),
                        $albumId ? (int)$albumId : null
                    );
                    $repo->editSong($song);
                    break;

                case 'album':
                    $songIds = $_POST['id_song'] ?? [];
                    $album = new Album(
                        (int)$id,
                        $_POST['title'],
                        $_POST['author'],
                        (bool)$_POST['available'],
                        new DateTimeImmutable(),
                        $_POST['editor'],
                        array_map('intval', $songIds)
                    );
                    $repo->editAlbum($album);
                    break;

                default:
                    throw new Exception("Type de média inconnu.");
            }

            $_SESSION['success'] = "Le média a été modifié avec succès !";

        } catch (Exception $e) {
            $_SESSION['errors'] = "Erreur lors de la modification : " . $e->getMessage();
        }

        header('Location: index.php?page=listMedia');
        exit;
        
    }

    public function deleteMedia(): void {
        if (isset($_GET['id'], $_GET['type'])) {
            $id = (int)$_GET['id'];
            $type = $_GET['type'];

            $repo = new MediaRepository();

            try {
                $deleted = $repo->deleteMedia($id, $type);
                if ($deleted) {
                    $_SESSION['success'] = "Le média a été supprimé avec succès !";
                } else {
                    $_SESSION['errors'] = "Impossible de supprimer le média.";
                }
            } catch (Exception $e) {
                $_SESSION['errors'] = "Erreur lors de la suppression : " . $e->getMessage();
            }

            header('Location: index.php?page=listMedia');
            exit;
        } else {
            $_SESSION['errors'] = "Aucun média sélectionné pour la suppression.";
            header('Location: index.php?page=listMedia');
            exit;
        }
    }
}