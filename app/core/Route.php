<?php
class Route {
    static function start() {
        // Получаем значение параметра 'api' из адресной строки
        $api_key = isset($_GET['apiKey']) ? $_GET['apiKey'] : null;

        //Api не найден
        if($api_key == null){
            self::Forbidden();
            return;
        }

        $uri = strtok($_SERVER["REQUEST_URI"], "?");
        $routes = explode("/", $uri);
        
        $controller_name = (empty($routes[4]) || $routes[4] == "") ? "Home" : $routes[4];
        $action_name = (!empty($routes[5])) ? $routes[5] : "index";

        $model_name = "Model_$controller_name";
        $controller_name = "Controller_$controller_name";
        $action_name = "Action_$action_name";

        $model_file = strtolower($model_name) . ".php";
        $model_path = "app/models/$model_file";
        if(file_exists($model_path)) include "app/models/$model_file";

        $controller_file = strtolower($controller_name) . ".php";
        $controller_path = "app/controllers/$controller_file";

        if(file_exists($controller_path)) include $controller_path;
        else Route::NotFound();

        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action)) $controller->$action();
        else Route::NotFound();

        
        $listApiKey = $controller->getAllApi();
        // Api не существует
        $flag = false;
        foreach($listApiKey as $apikey){
            if($apikey->keyString == $api_key){
                $flag = true;
                break;
            }
        }
        if(!$flag) self::Unauthorized();
        else self::Accepted();
    }

    static function NotFound() {
        echo '{"message":"Not Found", "code":404}';
        $host = "http://" . $_SERVER["HTTP_HOST"];
        header("HTTP/1.1 404 Not Found");
        header("Status: 404 Not Found");
        //header("Location: $host/404");
    }
    static function Unauthorized() {
        echo '{"message":"No validate API Key", "code":401}';
        //$host = "http://" . $_SERVER["HTTP_HOST"];
        //header("HTTP/1.1 401 Unauthorized");
        //header("Status: 401 Unauthorized");
        //header("Location: $host/401");
        //exit(); // Прерываем выполнение скрипта после отправки ошибки
    }
    static function Forbidden() {
        echo '{"message":"No API key provided", "code":403}';
        //$host = "http://" . $_SERVER["HTTP_HOST"];
        //header("HTTP/1.1 401 Unauthorized");
        //header("Status: 401 Unauthorized");
        //header("Location: $host/401");
        //exit(); // Прерываем выполнение скрипта после отправки ошибки
    }
    static function Accepted() {
        echo '{"message":"Api key accepted", "code":202}';
        //$host = "http://" . $_SERVER["HTTP_HOST"];
        //header("HTTP/1.1 401 Unauthorized");
        //header("Status: 401 Unauthorized");
        //header("Location: $host/401");
        //exit(); // Прерываем выполнение скрипта после отправки ошибки
    }
}