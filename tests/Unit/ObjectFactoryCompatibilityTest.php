<?php

namespace Telegram\Bot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use Telegram\Bot\Objects\BaseObject;

class ObjectFactoryCompatibilityTest extends TestCase
{
    public function test_it_keeps_object_make_methods_compatible_with_illuminate_collections(): void
    {
        $checkedClasses = 0;

        foreach ($this->objectClasses() as $class) {
            $reflection = new ReflectionClass($class);

            if (! $reflection->isSubclassOf(BaseObject::class) || ! $reflection->hasMethod('make')) {
                continue;
            }

            $method = $reflection->getMethod('make');

            if ($method->getDeclaringClass()->getName() !== $class) {
                continue;
            }

            $parameters = $method->getParameters();
            $lastParameter = end($parameters);
            $checkedClasses++;

            $this->assertNotFalse($lastParameter, "{$class}::make() must declare parameters.");
            $this->assertTrue(
                $lastParameter->isVariadic(),
                "{$class}::make() must accept variadic arguments to remain compatible with Illuminate Collection::make()."
            );
        }

        $this->assertGreaterThan(0, $checkedClasses);
    }

    /**
     * @return array<class-string>
     */
    private function objectClasses(): array
    {
        $root = dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Objects';
        $classes = [];

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));

        foreach ($iterator as $file) {
            if (! $file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }

            $relativePath = substr($file->getPathname(), strlen($root) + 1);
            $relativeClass = str_replace(DIRECTORY_SEPARATOR, '\\', substr($relativePath, 0, -4));
            $class = 'Telegram\\Bot\\Objects\\'.$relativeClass;

            if (class_exists($class)) {
                $classes[] = $class;
            }
        }

        sort($classes);

        return $classes;
    }
}
