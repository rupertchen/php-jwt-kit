<?php

namespace PhpJwtKit;


class JwkFactoryTest extends \PHPUnit_Framework_TestCase {

  /** @var JwkFactory */
  private $factory;


  protected function setUp() {
    $this->factory = new JwkFactory();
  }


  protected function tearDown() {
    $this->factory = null;
  }


  /**
   * @test
   */
  public function buildEc() {
    $this->markTestIncomplete();
  }


  /**
   * @test
   */
  public function buildRsa() {
    $this->markTestIncomplete();
  }


  /**
   * @test
   */
  public function buildOctFromJson() {
    $json = <<<EOT
{
  "kty":"oct",
  "k":"GawgguFyGrWKav7AX4VKUg"
}
EOT;
    $jwk = $this->factory->buildFromJson($json);
    $this->assertInstanceOf('PhpJwtKit\Jwk\OctetSequence', $jwk);
    $this->assertEquals('oct', $jwk->getKeyType());
    $this->assertEquals(Base64Url::decode('GawgguFyGrWKav7AX4VKUg'), $jwk->getKeyValue());
  }


  /**
   * @test
   */
  public function buildOctFromArray() {
    $array = array(
      'kty' => 'oct',
      'k' => 'GawgguFyGrWKav7AX4VKUg'
    );
    $jwk = $this->factory->buildFromArray($array);
    $this->assertInstanceOf('PhpJwtKit\Jwk\OctetSequence', $jwk);
    $this->assertEquals('oct', $jwk->getKeyType());
    $this->assertEquals(Base64Url::decode('GawgguFyGrWKav7AX4VKUg'), $jwk->getKeyValue());
  }
}
