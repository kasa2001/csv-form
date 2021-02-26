<?php


namespace App\Tests\Validator;


use App\Validator\CsvConstraint;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class CsvValidatorTest extends TestCase
{

    private $validator;

    protected function setUp(): void
    {
        $this->validator = Validation::createValidator();
    }


    public function testCorrectRecordValidation()
    {
        $record = [
            'Segment'               => 'test',
            'Country'               => 'test',
            'Product'               => 'test',
            'Discount Band'         => 'test',
            'Units Sold'            => 'test',
            'Manufacturing Price'   => 'test',
            'Sale Price'            => 'test',
            'Gross Sales'           => 'test',
            'Discounts'             => 'test',
            'Sales'                 => 'test',
            'COGS'                  => 'test',
            'Profit'                => 'test',
            'Date'                  => '01/03/2014',
            'Month Number'          => '3',
            'Month Name'            => 'March',
            'Year'                  => '2014',
        ];


        $violations = $this->validator->validate(
            $record,
            [
                new CsvConstraint()
            ]
        );

        $this->assertCount(0, $violations);
    }

    /**
     * @param $record
     * @param $countError
     * @dataProvider validationDataProvider
     */
    public function testIncorrectRecordValidation($record, $countError)
    {
        $violations = $this->validator->validate(
            $record,
            [
                new CsvConstraint()
            ]
        );

        $this->assertCount($countError, $violations);
    }

    public function validationDataProvider(): array
    {
        return [
            [
                [
                    'Segment'               => 'test',
                    'Country'               => 'test',
                    'Product'               => 'test',
                    'Discount Band'         => 'test',
                    'Units Sold'            => 'test',
                    'Manufacturing Price'   => 'test',
                    'Sale Price'            => 'test',
                    'Gross Sales'           => 'test',
                    'Discounts'             => 'test',
                    'Sales'                 => 'test',
                    'COGS'                  => 'test',
                    'Profit'                => 'test',
                    'Date'                  => '01/03/2014',
                    'Month Number'          => '3',
                    'Month Name'            => 'July',
                    'Year'                  => '2014',
                ],
                1,
            ],
            [
                [
                    'Segment'               => 'test',
                    'Country'               => 'test',
                    'Product'               => 'test',
                    'Discount Band'         => 'test',
                    'Units Sold'            => 'test',
                    'Manufacturing Price'   => 'test',
                    'Sale Price'            => 'test',
                    'Gross Sales'           => 'test',
                    'Discounts'             => 'test',
                    'Sales'                 => 'test',
                    'COGS'                  => 'test',
                    'Profit'                => 'test',
                    'Date'                  => '01/03/2014',
                    'Month Number'          => '4',
                    'Month Name'            => 'March',
                    'Year'                  => '2014',
                ],
                1,
            ],
            [
                [
                    'Segment'               => 'test',
                    'Country'               => 'test',
                    'Product'               => 'test',
                    'Discount Band'         => 'test',
                    'Units Sold'            => 'test',
                    'Manufacturing Price'   => 'test',
                    'Sale Price'            => 'test',
                    'Gross Sales'           => 'test',
                    'Discounts'             => 'test',
                    'Sales'                 => 'test',
                    'COGS'                  => 'test',
                    'Profit'                => 'test',
                    'Date'                  => '01/03/2014',
                    'Month Number'          => '4',
                    'Month Name'            => 'July',
                    'Year'                  => '2014',
                ],
                2,
            ],
            [
                [
                    'Segment'               => 'test',
                    'Country'               => 'test',
                    'Product'               => 'test',
                    'Discount Band'         => 'test',
                    'Units Sold'            => 'test',
                    'Manufacturing Price'   => 'test',
                    'Sale Price'            => 'test',
                    'Gross Sales'           => 'test',
                    'Discounts'             => 'test',
                    'Sales'                 => 'test',
                    'COGS'                  => 'test',
                    'Profit'                => 'test',
                    'Date'                  => '01/03/2014',
                    'Month Number'          => '4',
                    'Month Name'            => 'July',
                    'Year'                  => '2018',
                ],
                3,
            ],
        ];
    }
}