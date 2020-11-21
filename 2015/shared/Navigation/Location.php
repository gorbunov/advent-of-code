<?php declare(strict_types=1);


namespace Navigation;


final class Location
{
    private array $routes = [];
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addRoute(NavRoute $route)
    {
        $this->routes[$route->getTo()] = $route;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getRouteTo(string $name): NavRoute
    {
        if ($this->routes[$name] === null) {
            throw new \RuntimeException(sprintf('No route from %s to %s', $this->name, $name));
        }
        return $this->routes[$name];
    }
}
