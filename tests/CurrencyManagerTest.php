<?php

require_once __DIR__ . '/../src/Kondrashov/Manager/CurrencyManager.php';

use Kondrashov\Manager\CurrencyManager;
use Kondrashov\Parser\EcbEuropaParser;
use PHPUnit\Framework\TestCase;

final class CurrencyManagerTest extends TestCase
{
	public function testUpdateCurrencyRate(): void
	{
		$manager = new CurrencyManager();

		$currency = 'EUR';
		$newRate = 3.49;
		$manager->update($currency, $newRate);
		$this->assertEquals($manager->get($currency), $newRate);

		$manager->update($currency, 1);
	}

	public function testEuroRateIsExists(): void
	{
		$manager = new CurrencyManager();
		$currency = 'EUR';

		$rate = $manager->get($currency);

		$this->assertIsNumeric($rate);
	}
}
