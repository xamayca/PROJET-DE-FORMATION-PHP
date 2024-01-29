<?php

class Router
{
    private array $routeMappings = [];

    /** AJOUTEZ UNE ROUTE AU ROUTEUR EN L'AJOUTANT AU TABLEAU DES ROUTES */
    public function addRoute(string $uri, string $controllerName, string $methodName)
    {
        $this->routeMappings[$uri] = [
            'controller' => $controllerName,
            'method' => $methodName
        ];
    }

    /** DETERMINE LE CONTROLLER ET LA METHOD A UTILISER EN FONCTION DE L'URI DEMANDER */
    public function dispatch()
    {
        // OBTIENT L'URL DEMANDER //
        $requestedUri = $_SERVER['REQUEST_URI'];

        // var_dump($requestedUri);

        // SI LA ROUTE EST DANS LE TABLEAU DES ROUTES, RÉCUPÈRE LE CONTROLLER ET LA FONCTION LIER //
        if (array_key_exists($requestedUri, $this->routeMappings)) {
            $controllerName = $this->routeMappings[$requestedUri]['controller'];
            $methodName = $this->routeMappings[$requestedUri]['method'];
        } else {
            $controllerName = 'Errors';
            $methodName = 'error404';
        };

        require_once __DIR__ . '/../controllers/' . $controllerName . 'Controller.php';
        $controllerInstance = $controllerName . 'Controller';
        $controllerInstance = new $controllerInstance();
        $controllerInstance->$methodName();
    }
};
