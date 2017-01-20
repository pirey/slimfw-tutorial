<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

// Koneksi database
$config['displayErrorDetails'] = true;
$config['db']['host']   = "localhost";
$config['db']['user']   = "user_database";
$config['db']['pass']   = "password_database";
$config['db']['dbname'] = "nama_database";

$config['displayErrorDetails'] = true;
$config['db']['host']   = "localhost";
$config['db']['user']   = "root";
$config['db']['pass']   = "root";
$config['db']['dbname'] = "slimfw";


$app = new \Slim\App(["settings" => $config]);
$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer();

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};


//////////////////////////////////////////////////////
// Tambahkan routing disini......
//////////////////////////////////////////////////////

// Contoh SELECT
$app->get('/test', function($request, $response) {
    $list = $this->db->query("SELECT * FROM surat")->fetchAll();
    return $response->withJson($list);
});

$app->get('/test/{$id}', function($request, $response, $args) {
    $id = $args['id'];
    $item = $this->db->query("SELECT * FROM surat WHERE id = $id")->fetch();
    return $response->withJson($item);
});

// Contoh INSERT
$app->post('/testpost', function($request, $response) {
    $post = $request->getParsedBody();
    $judul = $post['judul'];
    $isi = $post['isi'];

    $insert = $this->db->exec("INSERT INTO surat (judul, isi) VALUES ('$judul', '$isi')");
    if ($insert) {
      $lastId = $this->db->lastInsertId();
      $postBaru = $this->db->query("SELECT * FROM surat WHERE id = $lastId")->fetch();

      // sukses
      return $response->withJson($postBaru);
    }

    // error
    return $response->withStatus(400);
});

// Contoh Tambah routes
// $app->get('/', function($request, $response) {
// ....
// });

$app->run();
