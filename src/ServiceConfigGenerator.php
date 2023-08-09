<?php declare(strict_types = 1);

namespace WebChemistry\ServiceConfigGenerator;

use Nette\Utils\Finder;
use ReflectionClass;
use WebChemistry\ClassFinder\ClassFinder;
use WebChemistry\ServiceConfigGenerator\Attribute\ClassAttributes;
use WebChemistry\ServiceConfigGenerator\Attribute\IgnoreService;
use WebChemistry\ServiceConfigGenerator\Generator\ConfigGenerator;

final class ServiceConfigGenerator
{

	/**
	 * @param ConfigGenerator[] $generators
	 */
	public function __construct(
		private array $generators,
	)
	{
	}

	public function generate(Finder $finder, string $targetDir): void
	{
		/** @var class-string $className */
		foreach (ClassFinder::findClasses($finder) as $className) {
			$reflection = new ReflectionClass($className);
			$attributes = new ClassAttributes($reflection);

			if ($attributes->has(IgnoreService::class)) {
				continue;
			}

			foreach ($this->generators as $generator) {
				$generator->processClass($attributes, $reflection);
			}
		}

		foreach ($this->generators as $generator) {
			$generator->generate($targetDir);
		}
	}

}
