<?php namespace ConditionalRouter\Routes;

use ConditionalRouter\ConditionalRoute;

class TaxonomyRoute extends ConditionalRoute {
  private $taxonomy;
  private $term;

  public function __construct(string $taxonomy = '', string $term = '') {
    $this->taxonomy = $taxonomy;
    $this->term = $term;
  }

  public function matches(ServerRequestInterface $request): bool {
    return is_tax($this->taxonomy, $this->term);
  }
}