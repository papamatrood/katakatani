<?php
namespace App;

use AltoRouter;

class Router {

    private $viewPath;

    private $router;


    function __construct(string $viewPath) 
    {
        $this->viewPath = $viewPath;

        $this->router = new AltoRouter();
    }

    public function get(string $url, string $view, string $name = null) : self
    {
        $this->router->map('GET', $url, $view, $name);

        return $this;
    }

    public function post(string $url, string $view, string $name = null) : self
    {
        $this->router->map('POST', $url, $view, $name);

        return $this;
    }

    public function match(string $url, string $view, string $name = null) : self
    {
        $this->router->map('GET|POST', $url, $view, $name);

        return $this;
    }

    public function url(string $name, ?array $params = []) : ?string
    {
        return $this->router->generate($name, $params);
    }

    public function run() : void
    {
        $view = $this->router->match()['target'];
        $params = $this->router->match()['params'];
        $router = $this;
        ob_start();
        try {
            require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
        } catch (\Exception $e) {
            echo "<h3 class=\"alert alert-warning\">{$e->getMessage()}</h3>";
        }
        $content = ob_get_clean();
        require $this->viewPath . DIRECTORY_SEPARATOR . 'layout.php';
    }

}