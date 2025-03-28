<?php namespace ConditionalRouter\Routes;

use ConditionalRouter\ConditionalRoute;
use Psr\Http\Message\ServerRequestInterface;

class HomeRoute extends ConditionalRoute {
  public function matches(ServerRequestInterface $request): bool {
    return is_home();
  }
}