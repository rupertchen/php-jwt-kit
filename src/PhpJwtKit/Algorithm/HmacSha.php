<?php

namespace PhpJwtKit\Algorithm;


use PhpJwtKit\Algorithm;

class HmacSha implements Algorithm {

  /** @var array */
  private static $hash_algorithms = array(
    'HS256' => 'SHA256',
    'HS384' => 'SHA384',
    'HS512' => 'SHA512'
  );
  /** @var string */
  private $algorithm;


  /**
   * @param string $algorithm
   * @return void
   */
  public function init($algorithm) {
    // check this early so it is easier to find the root cause of a misconfiguration
    if (!array_key_exists($algorithm, self::$hash_algorithms)) {
      throw new \DomainException('Unsupported algorithm: ' . $algorithm);
    }
    $this->algorithm = $algorithm;
  }


  /**
   * @inheritdoc
   */
  public function sign($data, $key) {
    return hash_hmac($this->getHashAlgorithm(), $data, $key, true);
  }


  /**
   * @return string
   */
  private function getHashAlgorithm() {
    $alg = self::$hash_algorithms[$this->algorithm];
    assert(is_string($alg));
    return $alg;
  }

}
