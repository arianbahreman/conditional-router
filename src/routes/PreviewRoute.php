<?php namespace ConditionalRouter\Routes;

use ConditionalRouter\ConditionalRoute;

class PreviewRoute extends ConditionalRoute {
  private function matches() {
    return is_preview();
  }
}