<?php
namespace itbz\stb\Utils;

class Modulo10Test extends \PHPUnit_Framework_TestCase
{
    public function invalidStructureProvider()
    {
        return array(
            array('y'),
            array(''),
            array(1234),
            array('12.12'),
        );
    }

    /**
     * @expectedException itbz\stb\Exception\InvalidStructureException
     * @dataProvider invalidStructureProvider
     */
    public function testGetCheckDigitStructure($nr)
    {
        $m = new Modulo10();
        $m->getCheckDigit($nr);
    }

    public function testGetCheckDigit()
    {
        $m = new Modulo10();
        $this->assertEquals($m->getCheckDigit('5555555'), '1');
        $this->assertEquals($m->getCheckDigit('991234'), '6');
        $this->assertEquals($m->getCheckDigit('987654321'), '7');
        $this->assertEquals($m->getCheckDigit('4992739871'), '6');
    }

    /**
     * @expectedException itbz\stb\Exception\InvalidStructureException
     * @dataProvider invalidStructureProvider
     */
    public function testVerifyStructure($nr)
    {
        $m = new Modulo10();
        $m->verify($nr);
    }

    public function testVerify()
    {
        $m = new Modulo10();

        // Valid check digits
        $this->assertTrue($m->verify('55555551'));
        $this->assertTrue($m->verify('9912346'));
        $this->assertTrue($m->verify('9876543217'));
        $this->assertTrue($m->verify('49927398716'));

        // Invalid ckeck digits
        $this->assertFalse($m->verify('55555550'));
        $this->assertFalse($m->verify('9912340'));
        $this->assertFalse($m->verify('9876543210'));
        $this->assertFalse($m->verify('49927398710'));
    }
}
