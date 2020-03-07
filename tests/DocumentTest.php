<?php
require __DIR__ . '/../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\Documents;
//use Dotenv\Dotenv;

final class DocumentTest extends TestCase
{
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        //$dotenv = Dotenv::createImmutable(__DIR__ . '\..\src');
        //$dotenv->load();
    }

    /**
     * @test
     */
    public function readAllDocuments(): void
    {
        $data = json_decode((new Documents(getenv('AUTENTIQUE_TOKEN')))->listAll(), true);

        $this->assertArrayHasKey('data', $data);
    }
}
