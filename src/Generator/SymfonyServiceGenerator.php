<?php declare(strict_types = 1);

namespace WebChemistry\ServiceConfigGenerator\Generator;

use Nette\Utils\FileSystem;
use ReflectionClass;
use Symfony\Component\Yaml\Yaml;
use WebChemistry\ServiceConfigGenerator\Attribute\ClassAttributes;
use WebChemistry\ServiceConfigGenerator\Attribute\SymfonyService;

final class SymfonyServiceGenerator implements ConfigGenerator
{

	/** @var SymfonyServiceItem[] */
	private array $items = [];

	/**
	 * @param mixed[] $defaults
	 */
	public function __construct(
		private string $fileName,
		private array $defaults = [],
	)
	{
	}

	public function processClass(ClassAttributes $attributes, ReflectionClass $reflection): void
	{
		$attribute = $attributes->getFirst(SymfonyService::class);

		if (!$attribute) {
			return;
		}

		$this->items[] = new SymfonyServiceItem($reflection->getName(), $attribute);
	}

	public function generate(string $targetDir): void
	{
		$services = $this->defaults;

		foreach ($this->items as $item) {
			$services[$item->className] = $item->buildConfig();
		}

		$yaml = Yaml::dump(
			['services' => $services],
			4,
			2,
			Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK | Yaml::DUMP_EMPTY_ARRAY_AS_SEQUENCE,
		);

		FileSystem::write(rtrim($targetDir, '/') . '/' . $this->fileName, $yaml);
	}

}
