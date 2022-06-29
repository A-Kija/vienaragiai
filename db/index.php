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


?>
<fieldset>
    <legend>CREATE</legend>
    <form method="POST">
        Title: <input type="text" name="title">
        Height: <input type="text" name="height">
        Type: <select name="type">
            <option value="1">Lapas</option>
            <option value="2">Spyglius</option>
            <option value="3">Palmė</option>
        </select>
        <input type="hidden" name="_method" value="post">
        <button type="submit">create</button>
    </form>
</fieldset>

<fieldset>
    <legend>DELETE</legend>
    <form method="POST">
        ID: <input type="text" name="id">
        <input type="hidden" name="_method" value="delete">
        <button type="submit">delete</button>
    </form>
</fieldset>



<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // CREATE
    // INSERT INTO table_name (column1, column2, column3, ...)
    // VALUES (value1, value2, value3, ...);
    if ($_POST['_method'] == 'post') {
        $sql = "
        INSERT INTO trees
        (title, height, type)
        VALUES ('".$_POST['title']."', ".$_POST['height'].", ".$_POST['type'].")
        ";
        $pdo->query($sql);
        header('Location: http://localhost/vienaragiai/db/');
        die;
    }


    if ($_POST['_method'] == 'delete') {
        // DELETE
        // DELETE FROM table_name WHERE condition;
        $sql = "
            DELETE FROM trees
            WHERE id = ".$_POST['id']."
        ";
        $pdo->query($sql);
        header('Location: http://localhost/vienaragiai/db/');
        die;
    }
}



// READ
// SELECT column1, column2, ...
// FROM table_name;

$sql = "
    SELECT id, title, height, type
    FROM trees
    ORDER BY type, height DESC
    
";
$stmt = $pdo->query($sql);

$trees = $stmt->fetchAll();

echo '<ul>';
foreach($trees as $tree) {
    echo '<li>'. $tree['id'] . ' ' . $tree['title'] . ' ' . $tree['height'] . ' ' . ['Lapuotis', 'Sygliuotis', 'Palme'][$tree['type'] - 1] . '</li>';
}
echo '</ul>';


$sql = "
    SELECT type, sum(height) AS height_sum, count(id) as trees_count, GROUP_CONCAT(title, '^O-O^') AS titles
    FROM trees
    GROUP BY type
    
";
$stmt = $pdo->query($sql);

$trees = $stmt->fetchAll();

echo '<ul>';
foreach($trees as $tree) {
    echo '<li>'. $tree['height_sum'] . ' ' . $tree['trees_count'] . ' ' .$tree['titles'] . ' ' .['Lapuotis', 'Sygliuotis', 'Palme'][$tree['type'] - 1] . '</li>';
}
echo '</ul>';