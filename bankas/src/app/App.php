<?php
namespace Bankas;
use Bankas\Controllers\HomeController;
use Bankas\Controllers\LoginController;
use Bankas\Messages;
class App {

        const DOMAIN = 'baronka.lt';
        const APP = __DIR__ . '/../';
        private static $html;

        public static function start() {
            session_start();
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: OPTIONS, GET, POST, DELETE, PUT');
            header("Access-Control-Allow-Headers: Authorization, Content-Type, X-Requested-With");
            header('Content-Type: application/json');
            Messages::init();
            ob_start();
            $uri = explode('/', $_SERVER['REQUEST_URI']);
            array_shift($uri);
            self::route($uri);
            self::$html = ob_get_contents();
            ob_end_clean();
        }

        public static function sent() {
            echo self::$html;
        }

        public static function view(string $name, array $data = []) {
            extract($data);
            require __DIR__ .' /../views/'.$name.'.php';
        }

        public static function json(array $data = []) {

            echo json_encode($data);
        }

        public static function redirect($url = '') {
            header('Location: http://'.self::DOMAIN.'/'.$url);
        }

        public static function url($url = '') {
            return 'http://'.self::DOMAIN.'/'.$url;
        }

        public static function authAdd(object $user) {
            $_SESSION['auth'] = 1;
            $_SESSION['user'] = $user;
        }

        public static function authRem() {
            unset($_SESSION['auth'], $_SESSION['user']);
        }

        public static function auth() : bool {
            return isset($_SESSION['auth']) && $_SESSION['auth'] == 1;
        }

        public static function authName() : string {
            return $_SESSION['user']->full_name;
        }

        public static function csrf() {
            return md5('dslkfjlkdsnvgfjfyjflkdsfnvno;dsfh'. $_SERVER['HTTP_USER_AGENT']);
        }

        private static function route(array $uri) {

            $m = $_SERVER['REQUEST_METHOD'];

            //LOGIN

            if ('GET' == $m && count($uri) == 1 && $uri[0] === 'login') {
                if (self::auth()) {
                    return self::redirect();
                }
                return (new LoginController)->showLogin();
            }

            if ('POST' == $m && count($uri) == 1 && $uri[0] === 'login') {
                return (new LoginController)->doLogin();
            }

            if ('POST' == $m && count($uri) == 1 && $uri[0] === 'logout') {
                return (new LoginController)->doLogout();
            }



            if (count($uri) == 1 && $uri[0] === '') {
                return (new HomeController)->index( );
            }

            if ('GET' == $m && count($uri) == 1 && $uri[0] === 'json') {
                return (new HomeController)->indexJson( );
            }

            if ('GET' == $m && count($uri) == 2 && $uri[0] === 'get-it') {
                return (new HomeController)->getIt($uri[1]);
            }

            if ('GET' == $m && count($uri) == 1 && $uri[0] === 'forma') {
                if (!self::auth()) {
                    return self::redirect('login');
                }
                return (new HomeController)->form( );
            }

            if ('POST' == $m && count($uri) == 1 && $uri[0] === 'forma') {
                return (new HomeController)->doForm( );
            }

            // API



            if ('GET' == $m && count($uri) == 2 && $uri[0] === 'api' && $uri[1] === 'home') {
                return (new HomeController)->indexJson();
            }


            
            
            // die('sdfsdfsdf');
            if (count($uri) == 2 && $uri[0] === 'api' && $uri[1] === 'form') {
                if ('POST' == $m){
                    return (new HomeController)->formJson();   
                }
                else {
                    // print_r(debug_backtrace());
                    // http_response_code(405);
                    App::json(['error' => 'OK']);
                }
            }

            else {
                http_response_code(404);
                App::json(['error' => 'OK']);
            }

        }

}