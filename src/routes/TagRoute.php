<?php namespace ConditionalRouter\Routes;

use ConditionalRouter\ConditionalRoute;

class TagRoute extends ConditionalRoute {
  private mixed $tag;
    
  public function __construct(mixed $tag = null) {
    $this->tag = $tag;
  }
  
  public function matches(ServerRequestInterface $request): bool {
    return is_tag($this->tag);
  }
}