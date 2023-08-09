<?php declare(strict_types = 1);

namespace WebChemistry\ServiceConfigGenerator\Generator;

use ReflectionClass;
use WebChemistry\ServiceConfigGenerator\Attribute\ClassAttributes;

interface ConfigGenerator
{

	/**
	 * @template T of object
	 * @param ReflectionClass<T> $reflection
	 */
	public function processClass(ClassAttributes $attributes, ReflectionClass $reflection): void;

	public function generate(string $targetDir): void;

}
