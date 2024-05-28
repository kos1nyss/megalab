<?php

require_once __DIR__ . '/../src/Kondrashov/Parser/EcbEuropaParser.php';

use Kondrashov\Parser\EcbEuropaParser;
use PHPUnit\Framework\TestCase;

final class EcbEuropaParserTest extends TestCase
{
	public function testParsedDataIsNotEmpty(): void
	{
		$parser = new EcbEuropaParser();
		$data = $parser->getAll();

		$this->assertNotEmpty($data);
	}
}
