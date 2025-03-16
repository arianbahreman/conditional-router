<?php namespace ConditionalRouter\Routes;

use ConditionalRouter\ConditionalRoute;

class AuthorRoute extends ConditionalRoute {
  private $author;

  public function __construct(string $author = null) {
    $this->author = $author;
  }

  public function matches(ServerRequestInterface $request): bool {
    return is_author($this->author);
  }
}