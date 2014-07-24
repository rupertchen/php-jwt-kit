<?php

namespace PhpJwtKit;


/**
 * Factory for building signers
 * http://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-31
 */
class AlgorithmFactory {
  /** @var  array */
  private $registrations;


  public function __construct() {
    // TODO: provide a registerAlgorithm($className, $algorithm)
    $this->registrations = array(
      'none' => 'PhpJwtKit\Algorithm\None',
      'HS256' => 'PhpJwtKit\Algorithm\HmacSha',
      'HS384' => 'PhpJwtKit\Algorithm\HmacSha',
      'HS512' => 'PhpJwtKit\Algorithm\HmacSha'
    );
  }


  /**
   * @param string $algorithm
   * @return Algorithm
   */
  public function build($algorithm) {
    // TODO: support cached algorithms?
    if (!isset($this->registrations[$algorithm])) {
      throw new \DomainException('Unsupported algorithms: ' . $algorithm);
    }
    $className = $this->registrations[$algorithm];
    if (!class_exists($className)) {
      throw new \UnexpectedValueException('Bad algorithm registration');
    }
    /** @var Algorithm $instance */
    $instance = new $className;
    $instance->init($algorithm);
    return $instance;
  }
}
