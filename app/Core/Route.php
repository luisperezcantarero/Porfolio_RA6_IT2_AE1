<?php
namespace App\Core;

class Route {
    private $route = array();

    public function add($route) {
        $this->route[] = $route;
    }

    public function match (string $request) {
        $matches = array();
        foreach ($this->route as $route) {
            $pattern = $route['path'];
            if (preg_match($pattern, $request)) {
                $matches = $route;
            }
        }
        return $matches;
    }
}
?>