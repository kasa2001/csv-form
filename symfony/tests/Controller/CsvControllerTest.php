<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CsvControllerTest extends WebTestCase
{

    protected $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    /**
     * Render form test
     */
    public function testRenderForm()
    {
        $crawler = $this->client->request("GET", "csv-form");

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(
            1,
            $crawler->filter('input')
                ->count()
        );
    }

    /**
     * File extends
     */
    public function testWrongFileExtend()
    {
        $this->client->request("GET", "csv-form");
        $crawler = $this->client->submitForm('Send data', [
            // to upload a file, the value must be the absolute file path
            'csv_file_upload[file]' => dirname(__DIR__) . "/files/test.txt",
        ]);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(
            1,
            $crawler->filter('li:contains("Wrong file extension")')
                ->count()
        );
    }

    /**
     * Csv Header
     */
    public function testWrongCsvHeader()
    {
        $this->client->request("GET", "csv-form");
        $crawler = $this->client->submitForm('Send data', [
            // to upload a file, the value must be the absolute file path
            'csv_file_upload[file]' => dirname(__DIR__) . "/files/wrong_csv.csv",
        ]);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(
            1,
            $crawler->filter('li:contains("Wrong csv header")')
                ->count()
        );
    }

    /**
     * Valid csv file
     */
    public function testValidCsv()
    {
        $this->client->request("GET", "csv-form");
        $crawler = $this->client->submitForm('Send data', [
            // to upload a file, the value must be the absolute file path
            'csv_file_upload[file]' => dirname(__DIR__) . "/files/good_csv.csv",
        ]);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(
            1,
            $crawler->filter('p:contains("Financial report")')
                ->count()
        );

        $this->assertEquals(
            1,
            $crawler->filter('p:contains("France: $ 10 890,00")')
                ->count()
        );

        $this->assertEquals(
            1,
            $crawler->filter('p:contains("Germany: $ 17 650,00")')
                ->count()
        );

        $this->assertEquals(
            1,
            $crawler->filter('p:contains("Midmarket: $ 15 330,00")')
                ->count()
        );

        $this->assertEquals(
            1,
            $crawler->filter('p:contains("Government: $ 13 210,00")')
                ->count()
        );
    }
}