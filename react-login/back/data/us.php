<?php

$users = [
    ['id' => 1, 'name' => 'bebras', 'psw' => md5('123'), 'full_name' => 'Bebras Upinis', 'session' => ''],
    ['id' => 2, 'name' => 'lina', 'psw' => md5('123'), 'full_name' => 'Lina Linovaitė', 'session' => ''],
    ['id' => 3, 'name' => 'petras', 'psw' => md5('123'), 'full_name' => 'Peter Jonson', 'session' => '']
];

file_put_contents(__DIR__ . '/us.json', json_encode($users));