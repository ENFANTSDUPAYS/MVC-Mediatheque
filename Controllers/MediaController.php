<?php
require_once __DIR__ . '/../Models/connexion.php';
require_once __DIR__ . '/../vendor/autoload.php';

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

    public function addMedia() {
        try {
            $pdo = getConnexion();

            $books  = $pdo->query("SELECT id, title, author, available, created_at, 'Livre' AS type FROM book")->fetchAll(PDO::FETCH_ASSOC);
            $albums = $pdo->query("SELECT id, title, author, available, created_at, 'Album' AS type FROM album")->fetchAll(PDO::FETCH_ASSOC);
            $movies = $pdo->query("SELECT id, title, author, available, created_at, 'Film' AS type FROM movie")->fetchAll(PDO::FETCH_ASSOC);
            $songs  = $pdo->query("SELECT id, title, author, available, created_at, 'Chanson' AS type FROM song")->fetchAll(PDO::FETCH_ASSOC);


            $medias = array_merge($books, $albums, $movies, $songs);

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

    public function editMedia() {
        
    }

    public function deleteMedia(){

    }
}
