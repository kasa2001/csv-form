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
            $crawler->filter('input[name=file]')
                ->count()
        );
    }

    /**
     * File extends
     */
    public function testWrongFileExtend()
    {
        $files = [
            new UploadedFile(
                dirname(__DIR__) . "/files/test.txt",
                "test.txt"
            )
        ];
        $crawler = $this->client->request("POST", "csv-form", [], $files);

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(
            1,
            $crawler->filter('p:contains("Wrong file extension")')
                ->count()
        );
    }

    /**
     * Csv Header
     */
    public function testWrongCsvHeader()
    {
        $files = [
            new UploadedFile(
                dirname(__DIR__) . "/files/wrong_csv.csv",
                "wrong_csv.csv"
            )
        ];
        $crawler = $this->client->request("POST", "csv-form", [], $files);

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());

        $this->assertEquals(
            1,
            $crawler->filter('p:contains("Wrong csv header")')
                ->count()
        );
    }

    /**
     * Valid csv file
     */
    public function testValidCsv()
    {
        $files = [
            new UploadedFile(
                dirname(__DIR__) . "/files/good_csv.csv",
                "good_csv.csv"
            )
        ];
        $crawler = $this->client->request("POST", "csv-form", [], $files);

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