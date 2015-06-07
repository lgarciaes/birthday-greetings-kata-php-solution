<?php

/**
 * Interface EmployeeRepository
 */
interface EmployeeRepository
{
    /**
     * @param XDate $date
     * @return Employee[]
     */
    public function findAllBornOn(XDate $date);
}
