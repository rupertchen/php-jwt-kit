<?php

namespace PhpJwtKit;


class Base64UrlTest extends \PHPUnit_Framework_TestCase {

  /**
   * @test
   * @dataProvider provider_encode
   */
  public function encode($value, $expected) {
    $this->assertEquals($expected, Base64Url::encode($value));
  }


  public function provider_encode() {
    return array(
      array('a', 'YQ'),
      array('abcdefghijklmnopqrstuvwxyz', 'YWJjZGVmZ2hpamtsbW5vcHFyc3R1dnd4eXo'),
      array(base64_decode('qL8R4QIcQ/ZsRqOAbeRfcZhilN/MksRtDaErMA=='), 'qL8R4QIcQ_ZsRqOAbeRfcZhilN_MksRtDaErMA')
    );
  }


  /**
   * @test
   * @dataProvider provider_decode
   */
  public function decode($data, $expected) {
    $this->assertEquals($expected, Base64Url::decode($data));
  }

  public function provider_decode() {
    return array(
      array('YQ', 'a'),
      array('qL8R4QIcQ_ZsRqOAbeRfcZhilN_MksRtDaErMA', base64_decode('qL8R4QIcQ/ZsRqOAbeRfcZhilN/MksRtDaErMA=='))
    );
  }
}
