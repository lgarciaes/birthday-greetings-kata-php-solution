<?php

/**
 * Class BirthdayService
 */
class BirthdayService
{
    /**
     * @var EmployeeRepository
     */
    private $employeeRepository;

    /**
     * @var SendMessageService
     */
    private $sendMessageService;

    /**
     * @param EmployeeRepository $employeeRepository
     * @param SendBirthdayMessageService $sendMessageService
     */
    public function __construct(EmployeeRepository $employeeRepository, SendBirthdayMessageService $sendMessageService)
    {
        $this->employeeRepository = $employeeRepository;
        $this->sendMessageService = $sendMessageService;
    }

    public function sendGreetings(XDate $xDate)
    {
        foreach ($this->employeeRepository->findAllBornOn($xDate) as $employee) {
            $this->sendMessageService->sendToEmployee($employee);
        }
    }
}