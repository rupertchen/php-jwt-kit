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
      'HS256' => 'PhpJwtKit\Algorithm\Hs256',
      'none' => 'PhpJwtKit\Algorithm\None'
    );
  }


  /**
   * @param string $algorithm
   * @return Algorithm
   */
  public function build($algorithm) {
    if (!isset($this->registrations[$algorithm])) {
      throw new \DomainException('Unsupported algorithms: ' . $algorithm);
    }
    $className = $this->registrations[$algorithm];
    if (!class_exists($className)) {
      throw new \UnexpectedValueException('Bad algorithm registration');
    }
    return new $className;
  }
}
