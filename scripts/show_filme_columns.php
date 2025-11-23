<?php
try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=streamly', 'root', '1234');
    $cols = $db->query('SHOW COLUMNS FROM filmes')->fetchAll(PDO::FETCH_ASSOC);
    print_r($cols);
} catch (Exception $e) {
    echo 'ERR: ' . $e->getMessage() . PHP_EOL;
}
