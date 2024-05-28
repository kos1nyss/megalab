<?php

namespace Kondrashov\Manager;

use Kondrashov\Parser\EcbEuropaParser;

require_once __DIR__ . '/../Parser/EcbEuropaParser.php';

class CurrencyManager
{

	private static array $currencies = [];
	private static bool $currenciesIsLoaded = false;

	public function __construct()
	{
		$this->prepareCurrencies();
	}

	private function prepareCurrencies(): void
	{
		if (!self::$currenciesIsLoaded)
		{
			$this->parseCurrencies();
			self::$currenciesIsLoaded = true;

			self::$currencies['EUR'] = 1;
		}
	}

	private function parseCurrencies(): void
	{
		$ecbEuropaParser = new EcbEuropaParser();
		$newCurrencies = $ecbEuropaParser->getAll();

		$this->setAll($newCurrencies);
	}

	private function setAll(array $newCurrencies): void
	{
		self::$currencies = $newCurrencies;
	}

	public function getAll(): array
	{
		return self::$currencies;
	}

	public function update(string $currency, float|int $rate): void
	{
		self::$currencies[$currency] = $rate;
	}

	public function delete(string $currency): void
	{
		unset(self::$currencies[$currency]);
	}

	public function get(string $currency): float|null
	{
		return self::$currencies[$currency];
	}
}