<?php namespace Models;

use Laminas\Diactoros\Response\EmptyResponse;

class ConditionalRouter {
  private $response = null;
  private $matched  = false;
  private $middlewares = [];
  private $validations = [];

  private function execute($controller) {
    if ($this -> matched) {
      return;
    }

    list($class, $method) = explode('@', $controller);

    if (class_exists($class) && method_exists($class, $method)) {
      $instance = new $class();
      $this -> matched  = true;
      $this -> response = call_user_func([$instance, $method]);
    } else {
      throw new \Exception("Controller or method not found: {$controller}");
    }
  }

  function getResponse() {
    if ($this -> response === null) {
      return new EmptyResponse(404);
    }

    return $this -> response;
  }

  /**
   * Conditions
   */
  function home($controller) {
    if (is_home()) {
      $this -> execute($controller);
    }
  }

  function front_page($controller) {
    if (is_front_page()) {
      $this -> execute($controller);
    }
  }

  function singular($controller, $post_type = null) {
    if (is_singular($post_type)) {
      $this -> execute($controller);
    }
  }

  function single($controller, $post = null) {
    if (is_single($post)) {
      $this -> execute($controller);
    }
  }

  function page($controller, $page = null) {
    if (is_page($page)) {
      $this -> execute($controller);
    }
  }

  function archive($controller) {
    if (is_archive()) {
      $this -> execute($controller);
    }
  }

  function category($controller, $category = null) {
    if (is_category($category)) {
      $this -> execute($controller);
    }
  }

  function tag($controller, $tag = null) {
    if (is_tag($tag)) {
      $this -> execute($controller);
    }
  }

  function tax($controller, $taxonomy = '', $term = '') {
    if (is_tax($taxonomy, $term)) {
      $this -> execute($controller);
    }
  }

  function author($controller, $author = null, $role = null) {
    if (is_author($author)) {
      $this -> execute($controller);
    }
  }

  function search($controller) {
    if (is_search()) {
      $this -> execute($controller);
    }
  }

  function notfound($controller) {
    if (is_404()) {
      $this -> execute($controller);
    }
  }

  function paged($controller) {
    if (is_paged()) {
      $this -> execute($controller);
    }
  }

  function feed($controller) {
    if (is_feed()) {
      $this -> execute($controller);
    }
  }

  function preview($controller) {
    if (is_preview()) {
      $this -> execute($controller);
    }
  }

  function admin($controller) {
    if (is_admin()) {
      $this -> execute($controller);
    }
  }
}