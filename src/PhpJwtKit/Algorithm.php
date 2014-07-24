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
   * @todo change $key to $jwk?
   *
   * @param string $data
   * @param array $key
   * @return string mixed
   */
  function sign($data, $key);
}
