<?php namespace ConditionalRouter\Routes;

use ConditionalRouter\ConditionalRoute;

class FrontPageRoute extends ConditionalRoute {
  private function matches() {
    return is_frontpage();
  }
}