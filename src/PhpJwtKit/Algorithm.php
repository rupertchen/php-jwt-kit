<?php

namespace PhpJwtKit;


interface Algorithm {
  /**
   * @param string $algorithm
   * @return void
   *
   * @todo Is it better to have init be in the interface or describe how this data should be passed via constructor arguments?
   */
  function init($algorithm);


  /**
   * @param string $data
   * @param Jwk $jwk
   * @return string
   */
  function encrypt($data, Jwk $jwk);
}
