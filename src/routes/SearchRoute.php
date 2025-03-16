<?php namespace ConditionalRouter\Routes;

use ConditionalRouter\ConditionalRoute;

class SearchRoute extends ConditionalRoute {
  private function matches() {
    return is_search();
  }
}