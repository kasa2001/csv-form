<?php


namespace App\Validator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CsvConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $date = \DateTime::createFromFormat("d/m/Y", $value['Date']);

        $month = $date->format('m');
        $year = $date->format('Y');
        $monthName = $date->format('F');


        if ($month != $value['Month_Number']) {
            $this->context->addViolation('Wrong month number');
        }

        if ($year != $value['Year']) {
            $this->context->addViolation('Wrong year number');
        }

        if ($monthName != $value['Month_Name']) {
            $this->context->addViolation('Wrong month name');
        }
    }
}