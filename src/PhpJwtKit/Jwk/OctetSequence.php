<?php

namespace PhpJwtKit\Jwk;


use PhpJwtKit\Base64Url;
use PhpJwtKit\Jwk;

class OctetSequence implements Jwk {

  const PARAM_KEY_VALUE = 'k';

  /** @var  $jwk */
  private $jwk;


  /**
   * @param array $jwk
   */
  public function __construct($jwk) {
    $this->jwk = $jwk;
  }


  /**
   * @return string
   */
  public function getKeyType() {
    return $this->jwk[Jwk::PARAM_KEY_TYPE];
  }


  /**
   * @return string
   */
  public function getKeyValue() {
    return Base64Url::decode($this->jwk[self::PARAM_KEY_VALUE]);
  }

}
