<?php

namespace PhpJwtKit;


interface Jwk {
  const PARAM_KEY_TYPE = 'kty';


  /**
   * @return string
   */
  function getKeyType();
}
