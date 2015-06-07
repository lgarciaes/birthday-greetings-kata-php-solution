<?php

/**
* Class CustomMessageBirthday.
*/
class CustomMessageBirthday extends CustomMessage
{
    /**
     * @var string
     */
    protected static $template = 'Happy Birthday, dear %s!';

    /**
     * @var string
     */
    protected static $subject = 'Happy Birthday!';

    /**
     * @param  Employee $employee
     * @return string
     */
    protected function buildMessage(Employee $employee)
    {
        return sprintf(self::$template, $employee->getFirstName());
    }
}
