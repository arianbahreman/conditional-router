<?php namespace ConditionalRouter\Routes;

use ConditionalRouter\ConditionalRoute;

class SingleRoute extends ConditionalRoute {
  private mixed $post;
    
  public function __construct(mixed $post = null) {
    $this->post = $post;
  }
  
  public function matches(ServerRequestInterface $request): bool {
    return is_single($this->post);
  }
}