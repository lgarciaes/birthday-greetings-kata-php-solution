<?php

/**
* Interface SendMessageService.
*/
abstract class SendMessageService
{
    /**
     * @var CustomMessage
     */
    protected $customMessage;

    /**
     * @param Employee $employee
     * @return bool
     */
    final public function sendToEmployee(Employee $employee)
    {
        return $this->sendMessageToEmployee($employee, $this->customMessage);
    }

    /**
     * @param Employee $employee
     * @param CustomMessage $customMessage
     * @return bool
     */
    protected abstract function sendMessageToEmployee(Employee $employee, CustomMessage $customMessage);
}
