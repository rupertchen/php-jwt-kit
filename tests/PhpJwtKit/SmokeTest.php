<?php

namespace PhpJwtKit;


class SmokeTest extends \PHPUnit_Framework_TestCase {

  /**
   * Example of a JOSE header
   * @test
   */
  public function exampleJwtJoseHeader() {
    // CRLF is \xd\xa
    $joseHeader = "{\"typ\":\"JWT\",\xd\xa \"alg\":\"HS256\"}";
    $expected = 'eyJ0eXAiOiJKV1QiLA0KICJhbGciOiJIUzI1NiJ9';
    $actual = Base64Url::encode($joseHeader);
    $this->assertEquals($expected, $actual);
  }


  /**
   * @test
   */
  public function jwsCompactSerializationAlgHs256() {
    // TODO: support alg's in http://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-31#section-3.1
    $jose = array(
      'typ' => 'JWT',
      'alg' => 'HS256'
    );
    $payload = array(
      'iss' => 'joe',
      'exp' => 1300819380,
      'http://example.com/is_root' => true
    );
    $key = Base64Url::decode('AyM1SysPpbyDfgZld3umj1qzKObwVMkoqQ-EstJQLr_T-1qS0gZH75aKtMN3Yj0iPS4hcgUuTwjAzZr1Z9CAow');
    $expected = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJqb2UiLCJleHAiOjEzMDA4MTkzODAsImh0dHA6XC9cL2V4YW1wbGUuY29tXC9pc19yb290Ijp0cnVlfQ.0stp4GfJhgUSjqUtkZ1Hfmt1bvPKiHSzojeTw3sr7R8';
    // TODO: should things like the alg and key be set earlier on the service? or at the time of encoding?
    // Need to ask about the common case and what is typically held constant during encoding
    $this->assertEquals($expected, Jwt::encodeJws($payload, $jose, $key));
  }


  /**
   * @test
   */
  public function jwsCompactSerializationAlgNone() {
    $jose = array(
      'typ' => 'JWT',
      'alg' => 'none'
    );
    $payload = array(
      'iss' => 'joe',
      'exp' => 1300819380,
      'http://example.com/is_root' => true
    );
    $key = Base64Url::decode('AyM1SysPpbyDfgZld3umj1qzKObwVMkoqQ-EstJQLr_T-1qS0gZH75aKtMN3Yj0iPS4hcgUuTwjAzZr1Z9CAow');
    $expected = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJub25lIn0.eyJpc3MiOiJqb2UiLCJleHAiOjEzMDA4MTkzODAsImh0dHA6XC9cL2V4YW1wbGUuY29tXC9pc19yb290Ijp0cnVlfQ.';
    $this->assertEquals($expected, Jwt::encodeJws($payload, $jose, $key));
  }

  /**
   * @test
   */
  public function jwsCompactSerializationValidation() {
    $key = Base64Url::decode('AyM1SysPpbyDfgZld3umj1qzKObwVMkoqQ-EstJQLr_T-1qS0gZH75aKtMN3Yj0iPS4hcgUuTwjAzZr1Z9CAow');
    $jws = 'eyJ0eXAiOiJKV1QiLA0KICJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJqb2UiLA0KICJleHAiOjEzMDA4MTkzODAsDQogImh0dHA6Ly9leGFtcGxlLmNvbS9pc19yb290Ijp0cnVlfQ.dBjftJeZ4CVP-mB92K27uhbUJU1p1r_wW1gFWFOEjXk';
    $this->assertTrue(Jwt::validateJws($jws, $key));
  }


  /**
   * @test
   */
  public function jwsJsonSerialization() {
    $this->markTestIncomplete();
  }

}
