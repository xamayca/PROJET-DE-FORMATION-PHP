<?php

class Router
{
    private array $routeMappings = [];

    public function addRoute(string $uri, string $controllerName, string $methodName, array $uriParams = [], array $params = [])
    {
        $this->routeMappings[$uri] = [
            'controller' => $controllerName,
            'method' => $methodName,
            'uriParams' => $uriParams
        ];
        if (!empty($params)) {
            $this->routeMappings[$uri]['params'] = $params;
        }
    }

    public function dispatch()
    {

        // ON RECUPERE L'URI DE LA REQUETE //
        $requestedUri = $_SERVER['REQUEST_URI'];

        // POUR CHAQUE ROUTE, ON COMPARE L'URI DE LA REQUETE AVEC L'URI DE LA ROUTE //
        foreach ($this->routeMappings as $uri => $route) {

            // ON CONSTRUIT LE PATTERN DE LA ROUTE AVEC LES PARAMETRES DYNAMIQUES EN UTILISANT DES EXPRESSIONS REGULIERES //
            $pattern = "@^" . str_replace([':string', ':number'], ['([a-zA-Z0-9-_]+)', '([0-9]+)'], $uri) . "$@D";

            // ON COMPARE L'URI DE LA REQUETE AVEC LE PATTERN DE LA ROUTE //
            if (preg_match($pattern, $requestedUri, $matches)) {

                // SI UNE CORRESPONDANCE EST TROUVÉE, ON EXTRAIT LES PARAMETRES DE L'URI //
                array_shift($matches);

                // ON RECUPERE LE NOM DU CONTROLEUR ET DE LA METHODE //
                $controllerName = $route['controller'];
                $methodName = $route['method'];

                // ON INCLUT LE FICHIER DU CONTROLEUR ET ON INSTANCIE LE CONTROLEUR //
                require_once __DIR__ . '/../controllers/' . $controllerName . 'Controller.php';
                $controllerInstance = $controllerName . 'Controller';
                $controllerInstance = new $controllerInstance();

                // ON APPELLE LA METHODE DU CONTROLEUR AVEC LES PARAMETRES //
                $params = array_combine($route['uriParams'], $matches);

                // SI DES PARAMETRES SONT FOURNIS, ON LES PASSE A LA METHODE //
                if (isset($route['params'])) {
                    $controllerInstance->$methodName($params, $route['params']);
                } else {
                    $controllerInstance->$methodName($params);
                }
                return;
            }
        }
        // SI PAS DE ROUTE TROUVÉE, AFFICHEZ UNE ERREUR 404 //
        require_once __DIR__ . '/../controllers/PagesController.php';
        $controllerInstance = new PagesController();
        $controllerInstance->error404();
    }
}