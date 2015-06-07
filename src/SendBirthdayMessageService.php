<?php

/**
* Class SendMessageServiceEmail.
*/
class SendBirthdayMessageService extends SendMessageService
{
    /**
     * @param SendMessageService $sendMessageService
     */
    final public function __construct(SendMessageService $sendMessageService)
    {
        $this->sendMessageService = $sendMessageService;
        $this->customMessage = new CustomMessageBirthday();
    }

    /**
     * @param Employee $employee
     * @param CustomMessage $customMessage
     * @return bool
     */
    protected function sendMessageToEmployee(Employee $employee, CustomMessage $customMessage)
    {
        return $this->sendMessageService->sendMessageToEmployee($employee, $customMessage);
    }
}
