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
                    $duration = (float)($_POST['duration'] ?? 0);
                    $genreId = (int)($_POST['genre_id'] ?? 0);
                    $genre = Genre::tryFrom($genreId);
                    if (!$genre) {
                $error = "Genre invalide.";
                break;
            }
                    $movie = new Movie(0, $title, $author, $available, $createdAt, $duration, $genre);
                    $repo->addMovie($movie);
                    $success = "Le film a été ajouté avec succès !";
                    break;

                case 'book':
                    $pagenumber = (int)($_POST['pagenumber'] ?? 0);
                    $book = new Book(0, $title, $author, $available, $createdAt, $pagenumber);
                    $repo->addBook($book);
                    $success = "Le livre a été ajouté avec succès !";
                    break;

                case 'song':
                    $song = new Song(0, $title, $author, $available, $createdAt, 0);
                    $repo->addSong($song);
                    $success = "La chanson a été ajoutée avec succès !";
                    break;

                case 'album':
                    $editor = trim($_POST['editor'] ?? '');
                    $id_songs = $_POST['id_song'] ?? [];
                    $album = new Album(0, $title, $author, $available, $createdAt, $id_songs, $editor);
                    $repo->addAlbum($album);
                    $success = "L'album a été ajouté avec succès !";
                    break;

                default:
                    $error = "Type de média invalide.";
            }

        } catch (PDOException $e) {
            error_log("Database error: ".$e->getMessage());
            $error = "Une erreur est survenue lors de l'ajout du média.";
        }
    }

        return ['error' => $error, 'success' => $success];
    }


    public function editMedia() {
        
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