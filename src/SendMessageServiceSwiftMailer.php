<?php

/**
* Class SendMessageServiceSwiftMailer.
*/
class SendMessageServiceSwiftMailer extends SendMessageService
{
    private static $sender = 'sender@here.com';

    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @param string $smtpHost
     * @param string $smtpPort
     */
    public function __construct($smtpHost, $smtpPort)
    {
        $this->mailer = Swift_Mailer::newInstance(Swift_SmtpTransport::newInstance($smtpHost, $smtpPort));
    }

    /**
     * @param Employee $employee
     * @param CustomMessage $customMessage
     * @return bool
     */
    protected function sendMessageToEmployee(Employee $employee, CustomMessage $customMessage)
    {
        $msg = Swift_Message::newInstance($customMessage->subject());
        $msg
            ->setFrom(self::$sender)
            ->setTo([$employee->getEmail()])
            ->setBody($customMessage->message($employee));

        return $this->sendMessage($msg);
    }

    /**
     * @param Swift_Message $message
     * @return int
     */
    protected function sendMessage(Swift_Message $message)
    {
        return $this->mailer->send($message);
    }
}
