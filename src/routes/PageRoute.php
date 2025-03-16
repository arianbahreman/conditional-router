<?php namespace ConditionalRouter\Routes;

use ConditionalRouter\ConditionalRoute;

class PageRoute extends ConditionalRoute {
  private function matches() {
    return is_page();
  }
}