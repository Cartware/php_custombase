<?php
declare(strict_types=1);

namespace Cartware\CustomBase;

trait CustomBase {

	/**
	 * @var String[]
	 */
	private static $customBaseAlphabetArray;

	/**
	 * @param int $number
	 * @return string
	 */
	public function encode(int $number): string
	{
		$alphabetArray = $this->getCustomBaseAlphabetTokens();
		$alphabetLength = count($alphabetArray);

		if ($number <= ($alphabetLength - 1)) {
			return $alphabetArray[$number];
		}

		return $this->encode((int) ($number / $alphabetLength)) . $this->encode($number % $alphabetLength);
	}

	/**
	 * @param string $string
	 * @return int
	 */
	public function decode(string $string): int
	{
		$tokens = array_reverse(str_split($string));
		return $this->_decode($tokens);
	}

	/**
	 * @param array $tokens
	 * @param int $step
	 * @return int
	 */
	private function _decode(array $tokens, $step = 0): int
	{
		$head = array_shift($tokens);
		$result = $this->decodeChar($head) * $this->pow(count($this->getCustomBaseAlphabetTokens()), $step);
		return $result + (empty($tokens) ? 0 : $this->_decode($tokens, $step + 1));
	}

	/**
	 * @param int $x
	 * @param int $n
	 * @return int
	 */
	private function pow(int $x, int $n): int
	{
		if ($n === 0) {
			return 1;
		}

		if ($n % 2) {
			return $x * $this->pow($x, $n - 1);
		}
	}

	/**
	 * @param string $char
	 * @return int
	 */
	private function decodeChar(string $char): int
	{
		$alphabetArray = $this->getCustomBaseAlphabetTokens();
		$index = array_search($char, $alphabetArray, true);

		if (FALSE === $index) {
			throw new \InvalidArgumentException('Non-alphabet digit found: ' . $char);
		}

		return $index;
	}

	/**
	 * @return array
	 */
	protected function getCustomBaseAlphabet(): string {
		return constant(__CLASS__ . '::CUSTOMBASE_ALPHABET') ?? '0123456789adfhijklmoqruwxy';
	}

	/**
	 * @return array
	 */
	protected function getCustomBaseAlphabetTokens(): array {
		if (self::$customBaseAlphabetArray === NULL) {
			self::$customBaseAlphabetArray = str_split($this->getCustomBaseAlphabet());
		}

		return self::$customBaseAlphabetArray;
	}

}