<?php namespace ConditionalRouter\Routes;

use ConditionalRouter\ConditionalRoute;
use Psr\Http\Message\ServerRequestInterface;

class PreviewRoute extends ConditionalRoute {
  public function matches(ServerRequestInterface $request): bool {
    return is_preview();
  }
}