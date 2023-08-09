<?php declare(strict_types = 1);

namespace WebChemistry\ServiceConfigGenerator\Generator;

use WebChemistry\ServiceConfigGenerator\Attribute\SymfonyService;

final class SymfonyServiceItem
{

	/**
	 * @param class-string $className
	 */
	public function __construct(
		public string $className,
		public SymfonyService $attribute,
	)
	{
	}

	/**
	 * @return mixed[]
	 */
	public function buildConfig(): array
	{
		$config = [];

		if ($this->attribute->bind) {
			$config['bind'] = $this->attribute->bind;
		}

		return $config;
	}

}
