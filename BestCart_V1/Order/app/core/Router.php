<?php
class Router
{
    public static function dispatch(string $route): void
    {
        $route = trim($route ?: 'cart/index');
        [$controllerName, $action] = array_pad(explode('/', $route, 2), 2, 'index');

        $controllerClass = ucfirst(strtolower($controllerName)) . 'Controller';
        $actionMethod = strtolower($action) . 'Action';

        $controllerFile = __DIR__ . '/../controllers/' . $controllerClass . '.php';
        if (!file_exists($controllerFile)) {
            http_response_code(404);
            echo 'Not Found (Controller)';
            return;
        }
        require_once $controllerFile;

        if (!class_exists($controllerClass)) {
            http_response_code(500);
            echo 'Controller class missing';
            return;
        }

        $controller = new $controllerClass();
        if (!method_exists($controller, $actionMethod)) {
            http_response_code(404);
            echo 'Not Found (Action)';
            return;
        }

        $controller->$actionMethod();
    }
}
