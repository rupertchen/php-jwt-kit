<?php

namespace PhpJwtKit\Algorithm;


use PhpJwtKit\Algorithm;

class Hs256 implements Algorithm {
  /** @var string */
  private $algorithm;


  /**
   * @param string $algorithm
   * @return void
   */
  function init($algorithm) {
    // TODO: change this class to be a generic HMAC one
    if ($algorithm !== 'HS256') {
      throw new \DomainException('algorithm must be HS256');
    }
    $this->algorithm = $algorithm;
  }


  /**
   * @inheritdoc
   */
  function sign($data, $key) {
    return hash_hmac('SHA256', $data, $key, true);
  }


}
