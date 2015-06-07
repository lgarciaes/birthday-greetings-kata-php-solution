<?php

/**
* Class CustomMessageBirthdayTest.
*/
class CustomMessageBirthdayTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var CustomMessageBirthday
     */
    private $customMessage;

    /**
     * @var Employee|PHPUnit_Framework_MockObject_MockObject;
     */
    private $employee;

    public function setUp()
    {
        $this->employee = $this->getMockBuilder('Employee')->disableOriginalConstructor()->getMock();
        $this->customMessage = new CustomMessageBirthday();
    }

    /**
     * @test
     */
    public function itShouldReturnMessage()
    {
        $this->employee->expects($this->once())->method('getFirstName')->willReturn('Pepe');

        $this->assertSame('Happy Birthday, dear Pepe!', $this->customMessage->message($this->employee));
    }

    /**
     * @test
     */
    public function itShouldReturnSubject()
    {
        $this->assertSame('Happy Birthday!', $this->customMessage->subject());
    }
}
