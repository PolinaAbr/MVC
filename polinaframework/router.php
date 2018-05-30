<?php

namespace polinaframework;
class Router {
    protected static $routes = []; //таблица маршрутов
    protected  static $route = []; //текущий маршрут

    //метод добавления маршрутов в таблицу
    public static function add($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes() {
        return self::$routes;
    }

    public static function getRoute() {
        return self::$route;
    }

    //поиск совпадений в таблице с адресом
    private static function matchRoute($url) {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    //метод отправки url по маршруту
    public static function dispatch($url) {
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'];
            if (class_exists($controller)) {
                $cObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if (method_exists($cObject, $action)) {
                    $cObject->$action();
                } else {
                    echo 'Метод не найден: ' . $controller . '::' . $action;
                }
            } else {
                echo 'Контроллер не найден: ' . $controller;
            }
        } else {
            http_response_code(404);
            require '../web/404.html';
        }
    }

    //перевод первых букв всех слов в верхний регистр
    private static function upperCamelCase($name) {
        $name = str_replace('-', ' ', $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);
        return $name;
    }

    //перевод первых букв слов в верхний регистр кроме первого
    private static function lowerCamelCase($name) {
        $name = self::upperCamelCase($name);
        $name = lcfirst($name);
        return $name;
    }
}