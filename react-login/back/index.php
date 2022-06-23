<?php
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Authorization, Content-Type, X-Requested-With");
    die;
}
require __DIR__ . '/JsonDb.php';


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT');
header("Access-Control-Allow-Headers: Authorization, Content-Type, X-Requested-With");
header('Content-Type: application/json');



if ($_GET['url'] == 'home') {

    if ('lalala-bebras' == apache_request_headers()['Authorization']) {
        echo json_encode([
            'Daiktas Nr. 32',
            'Puodas',
            'Dviratukas',
            'Zuikis',
            'Vazonas ir Lentyna',
            'IKEA'
        ]);
        die();
    }
    else {
        echo json_encode([]);
    }
}

if ($_GET['url'] == 'login') {
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, 1);
    $db = new JsonDb('us');
    $users = $db->showAll();

    foreach($users as $user) {
        if ($user['name'] != $data['name'] || $user['psw'] != md5($data['pass'])) {
            continue;
        }
        $token = md5(time(). rand(0, 10000));
        $user['session'] = $token;
        $db->update($user['id'], $user);
        echo json_encode(['token' => $token]);
        die;
    }
    echo json_encode(['msg' => 'error']);

}