<?php

namespace Kondrashov\Service;

require_once __DIR__ . '../Manager/CurrencyManager.php';

use Kondrashov\Manager\CurrencyManager;

class CurrencyConverterService
{
	private CurrencyManager $currencyManager;

	public function __construct()
	{
		$this->currencyManager = new CurrencyManager();
	}

	public function convert(string $from, string $to, float $amount): float
	{
		$toRate = $this->currencyManager->get($to);

		if ($from === 'EUR')
		{
			return $amount * $toRate;
		}

		$fromRate = $this->currencyManager->get($from);

		return $amount / $fromRate * $toRate;
	}
}