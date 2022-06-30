<?php

// s, m, l, xl
$s = 'mx';

echo "<h2>Yra $s</h2>";

if ($s == 's') {
    echo '<h3>Tikrinam S</h3>';
}
if ($s == 's' || $s == 'm') {
    echo '<h3>Tikrinam M</h3>';
}
if ($s == 's' || $s == 'm' || $s == 'l') {
    echo '<h3>Tikrinam L</h3>';
}
if ($s == 's' || $s == 'm' || $s == 'l' || $s == 'xl') {
    echo '<h3>Tikrinam XL</h3>';
}
echo '<h3>----------------</h3>';

switch($s) {
    case 's':
        echo '<h3>Tikrinam S</h3>';
    case 'm':
        echo '<h3>Tikrinam M</h3>';
    case 'l':
        echo '<h3>Tikrinam L</h3>';
    case 'xl':
        echo '<h3>Tikrinam XL</h3>';
    default :
        echo '<h3>ATE</h3>';
}
echo '<h3>----------------</h3>';

$a = 13;

if ($a > 5) {
    echo '<h3>A</h3>';
}
elseif ($a > 2) {
    echo '<h3>B</h3>';
}
else {
    echo '<h3>A</h3>';
}

// switch($a) {
//     case 'a':
//         echo '<h3>A</h3>';
//         break;
//     case 'b':
//         echo '<h3>B</h3>';
//         break;
//     default: 
//     echo '<h3>C</h3>';
// }

function abc($x) {
    return $x > 5;
}

$res = match(true) {
    call_user_func(fn() => $a > 5)  => 'A',
    $a > 2 => 'B',
    default => 'C'
};

echo "<h3>$res</h3>";