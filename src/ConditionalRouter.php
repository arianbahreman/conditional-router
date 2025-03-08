<?php

use Exception;
use InvalidArgumentException;
use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ConditionalRouter {
  private bool $matched = false;
  private ServerRequestInterface $request;
  private ?ResponseInterface $response = null;

  public function __construct(ServerRequestInterface $request) {
    $this->request = $request;
  }

  private function execute($controller): void {
    if ($this->matched) {
      return;
    }

    if (is_callable($controller)) {
      $response = $controller($this->request);
    } elseif (is_string($controller)) {
      $parts = explode('@', $controller);

      if (count($parts) === 2) {
        list($class, $method) = $parts;

        if (class_exists($class) && method_exists($class, $method)) {
          $instance = new $class();
          $response = call_user_func([$instance, $method], $this->request);
          
        } else {
          throw new Exception("Controller or method not found: {$controller}");
        }
      } else {
        throw new InvalidArgumentException("Invalid controller format.");
      }
    } else {
      throw new InvalidArgumentException("Invalid controller type.");
    }

    $this->matched = true;
    $this->response = $response instanceof ResponseInterface ? $response : new EmptyResponse(500);
  }

  public function getResponse(): ResponseInterface {
    return $this->response ?? new EmptyResponse(404);
  }

  public function home($controller): void {
    if (is_home()) {
      $this->execute($controller);
    }
  }

  public function frontPage($controller): void {
    if (is_front_page()) {
      $this->execute($controller);
    }
  }

  public function singular($controller, ?string $post_type = null): void {
    if (is_singular($post_type)) {
      $this->execute($controller);
    }
  }

  public function single($controller, ?string $post = null): void {
    if (is_single($post)) {
      $this->execute($controller);
    }
  }

  public function page($controller, ?string $page = null): void {
    if (is_page($page)) {
      $this->execute($controller);
    }
  }

  public function archive($controller): void {
    if (is_archive()) {
      $this->execute($controller);
    }
  }

  public function category($controller, ?string $category = null): void {
    if (is_category($category)) {
      $this->execute($controller);
    }
  }

  public function tag($controller, ?string $tag = null): void {
    if (is_tag($tag)) {
      $this->execute($controller);
    }
  }

  public function tax($controller, string $taxonomy = '', string $term = ''): void {
    if (is_tax($taxonomy, $term)) {
      $this->execute($controller);
    }
  }

  public function author($controller, ?string $author = null): void {
    if (is_author($author)) {
      $this->execute($controller);
    }
  }

  public function search($controller): void {
    if (is_search()) {
      $this->execute($controller);
    }
  }

  public function notFound($controller): void {
    if (is_404()) {
      $this->execute($controller);
    }
  }

  public function paged($controller): void {
    if (is_paged()) {
      $this->execute($controller);
    }
  }

  public function feed($controller): void {
    if (is_feed()) {
      $this->execute($controller);
    }
  }

  public function preview($controller): void {
    if (is_preview()) {
      $this->execute($controller);
    }
  }

  public function admin($controller): void {
    if (is_admin()) {
      $this->execute($controller);
    }
  }
}
