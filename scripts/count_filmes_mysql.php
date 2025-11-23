<?php
try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=streamly','root','1234', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $count = $db->query('SELECT COUNT(*) FROM filmes')->fetchColumn();
    echo "films_count=" . $count . PHP_EOL;
    $rows = $db->query('SELECT id,titulo,poster FROM filmes LIMIT 10')->fetchAll(PDO::FETCH_ASSOC);
    print_r($rows);
} catch (Exception $e) {
    echo 'ERR: ' . $e->getMessage() . PHP_EOL;
}
