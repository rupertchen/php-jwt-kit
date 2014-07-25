<?php

namespace PhpJwtKit\Algorithm;


use PhpJwtKit\Algorithm;
use PhpJwtKit\Jwk;

class None implements Algorithm {
  /**
   * @param string $algorithm
   * @return void
   */
  public function init($algorithm) {
    ;
  }


  /**
   * @inheritdoc
   */
  public function encrypt($data, Jwk $key = null) {
    return '';
  }
}
