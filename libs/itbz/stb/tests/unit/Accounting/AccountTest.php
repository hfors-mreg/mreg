<?php
namespace itbz\stb\Accounting;

class AccountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * List of invalid account values
     */
    public function invalidAccountProvider()
    {
        return array(
            array('a', 'I', 'Name'),
            array('', 'I', 'Name'),
            array('123', 'I', 'Name'),
            array('12345', 'I', 'Name'),
            array('1234', 'A', 'Name'),
            array('1234', 'I', ''),
            array('1234', 'I', 123),
        );
    }

    /**
     * @expectedException itbz\stb\Exception\InvalidAccountException
     * @dataProvider invalidAccountProvider
     */
    public function testAddAccountFaliure($account, $type, $name)
    {
        new Account($account, $type, $name);
    }

    public function testConstruct()
    {
        new Account('1920', 'T', 'PlusGiro');
        $this->assertTrue(true);
    }


    public function testEquals()
    {
        $a = new Account('1920', 'T', 'PlusGiro');
        $a1 = new Account('1920', 'T', 'PlusGiro');
        $b = new Account('3000', 'T', 'PlusGiro');
        $c = new Account('1920', 'I', 'PlusGiro');
        $d = new Account('1920', 'T', 'Bank');
        $this->assertTrue($a->equals($a1));
        $this->assertFalse($a->equals($b));
        $this->assertFalse($a->equals($c));
        $this->assertFalse($a->equals($d));
    }
}
