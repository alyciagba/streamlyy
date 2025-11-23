<?php
try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=streamly','root','1234', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $cols = $db->query('SHOW COLUMNS FROM filme_lista')->fetchAll(PDO::FETCH_ASSOC);
    print_r($cols);
} catch (Exception $e) {
    echo 'ERR: ' . $e->getMessage() . PHP_EOL;
}
