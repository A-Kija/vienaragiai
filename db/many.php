<?php

$host = '127.0.0.1';
$db   = '1_ragis';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $options);






// READ
// SELECT column1, column2, ...
// FROM table_name;

$sql = "
    SELECT tt.id, tt.title, ty.title AS type_title, height
    FROM type_trees AS tt
    RIGHT JOIN types AS ty
    ON tt.type = ty.id
    
";
$stmt = $pdo->query($sql);

$trees = $stmt->fetchAll();



echo '<ul>';
foreach($trees as $tree) {
    echo '<li>'. $tree['id'] . ' ' . $tree['title'] . ' ' . $tree['height'] . ' ' . ($tree['type_title'] ? $tree['type_title'] : '---' ). '</li>';
}
echo '</ul>';

