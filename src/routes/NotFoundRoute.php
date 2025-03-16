<?php namespace ConditionalRouter\Routes;

use ConditionalRouter\ConditionalRoute;

class NotFoundRoute extends ConditionalRoute {
  private function matches() {
    return is_notfound();
  }
}