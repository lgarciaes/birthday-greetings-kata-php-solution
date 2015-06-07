<?php

/**
* Class CustomMessage.
*/
abstract class CustomMessage
{
    /**
     * @var string
     */
    protected static $template;

    /**
     * @var string
     */
    protected static $subject;

    /**
     * @param Employee $employee
     * @return string
     */
    public function message(Employee $employee)
    {
        return $this->buildMessage($employee);
    }

    /**
     * @return string
     */
    public function subject()
    {
        return static::$subject;
    }

    /**
     * @param  Employee $employee
     * @return string
     */
    abstract protected function buildMessage(Employee $employee);
}
