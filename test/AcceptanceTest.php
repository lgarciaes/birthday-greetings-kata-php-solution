<?php

class AcceptanceTest extends PHPUnit_Framework_TestCase
{
    private static $sampleEmployeeData = __DIR__ . '/resources/employee_data.txt';
    /**
     * @var int
     */
    private static $SMTP_PORT = 25;

    /**
     * @var Swift_Message[]
     */
    private $messagesSent = [];

    /**
     * @var BirthdayService
     */
    private $service;

    /**
     * @var TestableSendMessageServiceSwiftMailer
     */
    private $messageService;

    public function setUp()
    {
        $messageHandler = function (Swift_Message $msg) {
            $this->messagesSent[] = $msg;
        };

        $this->messageService = new TestableSendMessageServiceSwiftMailer('localhost', static::$SMTP_PORT);
        $this->messageService->setMessageHandler($messageHandler->bindTo($this));

        $this->service = new BirthdayService(
            new EmployeeRepositoryCsv(self::$sampleEmployeeData),
            new SendBirthdayMessageService($this->messageService)
        );

    }

    public function tearDown()
    {
        $this->service = $this->messageService = $this->messagesSent = null;
    }

    /**
     * @test
     */
    public function willSendGreetings_whenItsSomebodysBirthday()
    {
        $this->service->sendGreetings(new XDate('2008/10/08'));

        $this->assertCount(1, $this->messagesSent, 'message not sent?');
        $message = $this->messagesSent[0];
        $this->assertEquals('Happy Birthday, dear John!', $message->getBody());
        $this->assertEquals('Happy Birthday!', $message->getSubject());
        $this->assertCount(1, $message->getTo());
        $this->assertEquals('john.doe@foobar.com', array_keys($message->getTo())[0]);
    }

    /**
     * @test
     */
    public function willNotSendEmailsWhenNobodysBirthday()
    {
        $this->service->sendGreetings(new XDate('2008/01/01'));

        $this->assertCount(0, $this->messagesSent, 'what? messages?');
    }
}

class TestableSendMessageServiceSwiftMailer extends SendMessageServiceSwiftMailer
{
    /**
     * @var Closure
     */
    private $callback;

    public function setMessageHandler(Closure $callback)
    {
        $this->callback = $callback;

        return $this;
    }

    protected function sendMessage(Swift_Message $message)
    {
        $callable = $this->callback;
        $callable($message);
    }
}