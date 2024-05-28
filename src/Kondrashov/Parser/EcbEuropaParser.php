<?php

namespace Kondrashov\Parser;

class EcbEuropaParser
{
	private string $uriHost = 'https://www.ecb.europa.eu';

	private function parseXml(string $content): array
	{
		$currencies = [];

		$content = simplexml_load_string($content);
		$currenciesXml = $content->{'Cube'}->{'Cube'}->{'Cube'};

		foreach ($currenciesXml as $currencyXml)
		{
			$currency = (string)$currencyXml['currency'];
			$rate = (string)$currencyXml['rate'];

			$currencies[$currency] = (float)$rate;
		}

		return $currencies;
	}

	public function getAll(): array
	{
		$uriPath = '/stats/eurofxref/eurofxref-daily.xml';
		$response = file_get_contents($this->uriHost . $uriPath);

		return $this->parseXml($response);
	}
}