<?php namespace ConditionalRouter;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use InvalidArgumentException;
use Exception;

/**
 * Abstract class representing a conditional route.
 * Classes extending this must implement the matches() method
 * to determine whether a condition is met.
 */
abstract class ConditionalRoute {
  /**
   * Determines if the current route condition matches.
   * 
   * @return bool True if the condition matches, false otherwise.
   */
  abstract public function matches(ServerRequestInterface $request): bool;
}