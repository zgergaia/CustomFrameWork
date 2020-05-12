<?php

class Router {
    /**
     * @var \IRequest
     */
    public $request = null;
    public array $routes = [];
    public array $postRoutes = [];

    public function __construct(IRequest $request) {
        $this->request = $request;
    }

    public function reg_page($path, $callback) {
        $this->routes[$path] = $callback;
    }

    public function post_route($path, $callback) {
        $this->postRoutes[$path] = $callback;
    }

    public function render_template($callback, $params = [], $post = false) {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        if($post === true)
            require_once __DIR__ . "/template/{$callback}.php";
        else
            require_once __DIR__ . "/template/{$callback}";

        return ob_get_clean();
    }

    public function __destruct() {
        $path = $this->request->getPath();
        $response = '';

        if($this->request->getMethod() === "get")
            $callback = $this->routes[$path] ?? false;
        else {
            $callback = $this->postRoutes[$path] ?? false;
        }

        if(!$callback) {
            $response = "This page was not found";
        } else if(is_string($callback)){
            $response = $this->render_template($callback);
        } else
            $response = call_user_func($callback, $this->request, $this);

        require_once __DIR__ . "/template/template.php";
    }
}