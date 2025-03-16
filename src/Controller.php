<?php namespace ConditionalRouter;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use InvalidArgumentException;
use Exception;

class Controller {
  private $controller;

  /**
   * Constructor to initialize the controller.
   * 
   * @param string|callable $controller Controller method reference as 'Class@method' or a callable function.
   */
  public function __construct(string|callable $controller) {
    $this->controller = $controller;
  }

  /**
   * Executes the controller action.
   * 
   * @param ServerRequestInterface $request The current HTTP request.
   * @return ResponseInterface The response from the controller action.
   * @throws InvalidArgumentException If the controller type is invalid.
   */
  public function execute(ServerRequestInterface $request): mixed {
    if (is_callable($this->controller)) {
      return $this->controller($request);
    }
  
    if (is_string($this->controller)) {
      return $this->invoke($request);
    }
  
    throw new InvalidArgumentException("Invalid controller type.");
  }

  /**
   * Invokes a class method based on a string controller reference.
   * 
   * @param ServerRequestInterface $request The current HTTP request.
   * @return ResponseInterface The response from the invoked method.
   * @throws InvalidArgumentException If the controller format is invalid.
   * @throws Exception If the class or method does not exist.
   */
  private function invoke(ServerRequestInterface $request): mixed {
    $parts = explode('@', $this->controller);

    if (count($parts) !== 2) {
      throw new InvalidArgumentException("Invalid controller format.");
    }
    
    list($class, $method) = $parts;

    if (!class_exists($class) || !method_exists($class, $method)) {
      throw new Exception("Controller or method not found: {$this->controller}");
    }

    return call_user_func([new $class(), $method], $request);
  }
}
