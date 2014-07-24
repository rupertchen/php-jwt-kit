<?php

namespace PhpJwtKit;


class Jwt {


  /**
   * @return AlgorithmFactory
   * @todo: temporary substitute for dependency injection
   */
  private static function getAlgorithmFactory() {
    $factory = new AlgorithmFactory();
    $factory->registerAlgorithm('PhpJwtKit\Algorithm\None', 'none');
    $factory->registerAlgorithms('PhpJwtKit\Algorithm\HmacSha', array('HS256', 'HS384', 'HS512'));
    return $factory;
  }


  /**
   * @param string $payload
   * @param array $header
   * @param string $key
   * @return string
   */
  public static function encodeJws($payload, $header, $key) {
    // TODO: test this
    // TODO: Split into a separate JwtEncoder?
    // TODO: how to simplify alg specification AND allow flexibility in setting the header?
    // TODO: Should there be a JoseHeader class?
    if (!isset($header[Headers::ALGORITHM])) {
      throw new \InvalidArgumentException('Missing required param: ' . Headers::ALGORITHM);
    }

    $encodedHeader = Base64Url::encode(json_encode($header));
    $encodedPayload = Base64Url::encode(json_encode($payload));
    $signingInput = $encodedHeader . '.' . $encodedPayload;

    $algorithm = self::getAlgorithmFactory()->build($header[Headers::ALGORITHM]);
    $signature = $algorithm->sign($signingInput, $key);
    return $encodedHeader . '.' . $encodedPayload . '.' . Base64Url::encode($signature);
  }


  /**
   * @param string $jws
   * @return bool
   */
  public static function validateJws($jws, $key) {
    $segments = explode('.', $jws);
    if (count($segments) !== 3) {
      throw new \InvalidArgumentException();
    }

    list($encodedHeader, $encodedPayload, $givenEncodedSignature) = $segments;
    $header = json_decode(Base64Url::decode($encodedHeader), true);
    $algorithm = self::getAlgorithmFactory()->build($header[Headers::ALGORITHM]);
    $signingInput = $encodedHeader . '.' . $encodedPayload;
    $signature = $algorithm->sign($signingInput, $key);
    return Base64Url::encode($signature) === $givenEncodedSignature;
  }
}
