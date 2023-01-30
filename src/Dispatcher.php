<?php

declare(strict_types=1);

namespace Src;

use DI\ContainerBuilder;

class Dispatcher
{
    private string $argument;

    public function __construct(private array $routes) {}
    
    public function run(): void
    {
        $contr = $this->getRoutingFromUrl();

        $builder = new ContainerBuilder();
        $builder->addDefinitions($_SERVER['DOCUMENT_ROOT'].'/../DiSettings.php');
        $container = $builder->build();
 
        $myClass = $container->get($contr[0]);
      
        $method = $contr[1];

        $argument = isset($this->argument)? (int)$this->argument : null;
        $myClass->$method($argument);
    }

    private function getRoutingFromUrl(): array
    {
        $methods = ['get', 'post', 'any'];
        foreach($methods as $method ){
            $controller = $this->handle($method);
            if(!empty($controller) AND (strtolower($_SERVER['REQUEST_METHOD']) == $method OR $method == 'any' )) {
                return $controller;
             }
        }
        return NOT_FOUND_ROUTE;
    }

    private function handle($method)
    {
         if(!isset($this->routes[$method])) return [];
         $keys = array_keys($this->routes[$method]);
  
         for($i = 0; $i < count($keys); $i++){
            $keys[$i] = trim($keys[$i], '/');
        }

        $url = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        $uriSegments = explode("/", $url);

        if(isset($uriSegments[1]) AND $uriSegments[1] == 'api') {
            $uri = implode('/',[$uriSegments[1], $uriSegments[2]]);

            if(isset($uriSegments[3])) {
                $this->argument = $uriSegments[3];
                $uriSegments[3] = '{argument}';
                $uri = implode('/',[$uri, $uriSegments[3]]);
            }

            if(isset($uriSegments[4])) {
                $uri = implode('/',[$uri, $uriSegments[4]]);
            }

        } else {
            if(isset($uriSegments[1]) AND isset($uriSegments[2])) $uri = implode('/',[$uriSegments[1], $uriSegments[2]]);
            if(isset($uriSegments[2]) AND isset($uriSegments[3])) $uri = implode('/',[$uri, $uriSegments[3]]);
         } 

        if(!isset($uri) ) { 
            if(isset($uriSegments[1])) $uri = $uriSegments[1]; 
        }

        if(!isset($uri)) $uri = '';
        $key = array_search($uri, $keys);
        if ($key === false) return [];
        $array = array_values($this->routes[$method]);

        return $array[$key];
    }
}
