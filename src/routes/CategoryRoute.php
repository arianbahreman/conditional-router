<?php namespace ConditionalRouter\Routes;

use ConditionalRouter\ConditionalRoute;
use Psr\Http\Message\ServerRequestInterface;

class CategoryRoute extends ConditionalRoute {
  private $category;

  function __construct(?string $category = null) {
    $this->category = $category;
  }

  public function matches(ServerRequestInterface $request): bool {
    return is_category($category);
  }
}
