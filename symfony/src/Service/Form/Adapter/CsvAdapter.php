<?php


namespace App\Service\Form\Adapter;


use App\Exception\AbstractFileException;
use App\Exception\FileExtensionException;
use App\Exception\HeaderFileException;
use App\Model\Csv;
use App\Service\Parser\ParserServiceInterface;
use App\Validator\CsvConstraint;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validation;

class CsvAdapter implements FormAdapterInterface
{

    private $parserService;

    private $validator;

    public function __construct(ParserServiceInterface $parserService)
    {
        $this->parserService = $parserService;
        $this->validator = Validation::createValidator();
    }

    /**
     * @param FormInterface $form
     * @throws AbstractFileException
     */
    public function doAdapter(FormInterface $form): array
    {
        $file = $form->get('file')->getData();

        if ($file->getClientOriginalExtension() !== 'csv') {
            throw new FileExtensionException();
        }

        $content = $this->parserService->parseFile($file->getContent());

        $header = $this->parserService->parseHeader($content[0]);

        $csv = new \ReflectionClass(Csv::class);

        if ($this->compareHeader($header, array_keys($csv->getDefaultProperties()))) {
            throw new HeaderFileException();
        }

        unset($content[0]);

        $result = [];

        foreach ($content as $item) {
            $parsedRecord = $this->parserService->parse($item);

            $valid = $this->validator->validate(
                $parsedRecord,
                [
                    new CsvConstraint()
                ]
            );

            $result['data'][] = [
                'data' => $parsedRecord,
                'errors' => $valid->getIterator()->getArrayCopy(),
            ];

            if (!$valid->count()) {
                $this->groupData($result, $parsedRecord);
            }
        }

        return $result;
    }


    /**
     * @param $csv
     * @param $expected
     * @return int
     */
    private function compareHeader($csv, $expected): int
    {
        return count(array_diff($csv, $expected));
    }

    private function groupData(&$result, $record)
    {
        if (!isset($result['group']['Segment'][$record['Segment']])) {
            $result['group']['Segment'][$record['Segment']] = 0;
        }

        if (!isset($result['group']['Country'][$record['Country']])) {
            $result['group']['Country'][$record['Country']] = 0;
        }

        $sales = intval(preg_replace("/[$\s]/", "", $record['Profit']));

        $result['group']['Segment'][$record['Segment']] += $sales;

        $result['group']['Country'][$record['Country']] += $sales;
    }
}