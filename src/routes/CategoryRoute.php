<?php namespace ConditionalRouter\Routes;

use ConditionalRouter\ConditionalRoute;

class CategoryRoute extends ConditionalRoute {
  private $category;

  function __construct(?string $category = null) {
    $this->category = $category;
  }

  private function matches() {
    return is_category($category);
  }
}
