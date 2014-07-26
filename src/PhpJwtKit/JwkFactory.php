<?php

namespace PhpJwtKit;

use PhpJwtKit\Jwk\OctetSequence;


/**
 * Factory for building JWKs
 *
 * @link http://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-31#section-6
 */
class JwkFactory {
  /**
   * @param string $json
   * @return Jwk
   */
  public function buildFromJson($json) {
    $array = json_decode($json, true);
    return $this->buildFromArray($array);
  }


  /**
   * @param $array
   * @return Jwk
   */
  public function buildFromArray(array $array) {
    $keyType = $array['kty'];
    switch ($keyType) {
//      case 'EC':
//        return;
//      case 'RSA':
//        return;
      case 'oct':
        return new OctetSequence($array);
      default:
        throw new \InvalidArgumentException('Unsupported key type: ' . $keyType);
    }
  }
}
