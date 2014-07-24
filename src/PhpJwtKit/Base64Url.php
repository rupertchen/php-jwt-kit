<?php

namespace PhpJwtKit;


class Base64Url {
  /**
   * @param string $data
   * @return string
   */
  public static function encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
  }


  /**
   * @param string $data
   * @return string
   */
  public static function decode($data) {
    $padding = 4 - strlen($data) % 4;
    return base64_decode(str_pad(strtr($data, '-_', '+/'), $padding, '='));
  }
}
