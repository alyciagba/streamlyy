<?php
$db = new PDO('sqlite:' . __DIR__ . '/../database/database.sqlite');
$updates = [1 => 4, 2 => 5, 3 => 4, 4 => 4, 5 => 4, 6 => 4, 7 => 4, 8 => 4];
foreach ($updates as $id => $r) {
    $stmt = $db->prepare('UPDATE filmes SET ranking = :r WHERE id = :id');
    $stmt->execute([':r' => $r, ':id' => $id]);
}
$rows = $db->query('SELECT id, titulo, ranking FROM filmes')->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);
