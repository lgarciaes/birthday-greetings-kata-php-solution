<?php

/**
* Class EmployeeRepositoryCsv.
*/
class EmployeeRepositoryCsv implements EmployeeRepository
{
    /**
     * @var resource
     */
    private $fileHandler;

    /**
     * @param string $fileName
     */
    public function __construct($fileName)
    {
        $this->fileHandler = fopen($fileName, 'r');
    }

    /**
     * @param XDate $date
     * @return Employee[]
     */
    public function findAllBornOn(XDate $date)
    {
        $this->reset();

        while ($employeeData = fgetcsv($this->fileHandler, null, ',')) {
            $employee = $this->arrayDataToEmployee(array_map('trim', $employeeData));

            if ($employee->isBirthday($date)) {
                yield $employee;
            }
        }
    }

    /**
     * @param array $employeeData
     * @return Employee
     */
    private function arrayDataToEmployee(array $employeeData)
    {
        return new Employee($employeeData[1], $employeeData[0], $employeeData[2], $employeeData[3]);
    }

    private function reset()
    {
        rewind($this->fileHandler);
        fgetcsv($this->fileHandler);
    }
}
