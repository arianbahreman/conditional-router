<?php namespace ConditionalRouter\Routes;

use ConditionalRouter\ConditionalRoute;
use Psr\Http\Message\ServerRequestInterface;

class SingularRoute extends ConditionalRoute {
  private ?string $postType;
  
  public function __construct(?string $postType = null) {
    $this->postType = $postType;
  }
  
  public function matches(ServerRequestInterface $request): bool {
    return is_singular($this->postType);
  }
}