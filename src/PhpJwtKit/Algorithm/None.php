<?php

namespace PhpJwtKit\Algorithm;


use PhpJwtKit\Algorithm;

class None implements Algorithm {
  /**
   * @param string $algorithm
   * @return void
   */
  function init($algorithm) {
    ;
  }


  /**
   * @inheritdoc
   */
  public function sign($data, $key) {
    return '';
  }
}
