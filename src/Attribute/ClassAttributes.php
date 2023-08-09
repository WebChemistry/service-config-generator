<?php declare(strict_types = 1);

namespace WebChemistry\ServiceConfigGenerator\Attribute;

use ReflectionClass;


final class ClassAttributes
{

	public function __construct( // @phpstan-ignore-line
		private ReflectionClass $reflection,
	)
	{
	}

	/**
	 * @param class-string $attribute
	 */
	public function has(string $attribute): bool
	{
		return (bool) $this->reflection->getAttributes($attribute);
	}

	/**
	 * @template T of object
	 * @param class-string<T> $attribute
	 * @return T|null
	 */
	public function getFirst(string $attribute): ?object
	{
		$attributes = $this->reflection->getAttributes($attribute);

		return ($attributes[0] ?? null)?->newInstance();
	}

}
