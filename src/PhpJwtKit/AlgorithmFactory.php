<?php

namespace PhpJwtKit;


/**
 * Factory for building algorithms
 *
 * @link http://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-31
 */
class AlgorithmFactory {
  /** @var  array */
  private $registrations = array();


  /**
   * @param string $className
   * @param array $algParamValues
   */
  public function registerAlgorithms($className, array $algParamValues) {
    foreach ($algParamValues as $alg) {
      $this->registerAlgorithm($className, $alg);
    }
  }


  /**
   * @param string $className
   * @param string $algParamValue
   */
  public function registerAlgorithm($className, $algParamValue) {
    if (!$algParamValue) {
      throw new \InvalidArgumentException('Invalid alg parameter value: ' . $algParamValue);
    }
    if (array_key_exists($algParamValue, $this->registrations)) {
      throw new \UnexpectedValueException('Cannot re-register alg parameter value: ' . $algParamValue);
    }
    // skip verifying that the class exists to avoid autoloading every registration
    $this->registrations[$algParamValue] = $className;
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
