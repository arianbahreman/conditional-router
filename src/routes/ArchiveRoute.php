<?php namespace ConditionalRouter\Routes;

use ConditionalRouter\ConditionalRoute;

class ArchiveRoute extends ConditionalRoute {
  private function matches() {
    return is_archive();
  }
}