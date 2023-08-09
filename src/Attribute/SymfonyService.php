<?php declare(strict_types = 1);

namespace WebChemistry\ServiceConfigGenerator\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final class SymfonyService
{

	/**
	 * @param array<string, mixed> $bind
	 */
	public function __construct(
		public array $bind = [],
	)
	{
	}

}
