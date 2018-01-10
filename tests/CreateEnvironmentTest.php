<?php declare(strict_types=1);

namespace WyriHaximus\Tests\Twig;

use PHPUnit\Framework\TestCase;
use Twig_Environment;
use function WyriHaximus\Twig\createEnvironment;

final class CreateEnvironmentTest extends TestCase
{
    public function testCreateEnvironment()
    {
        self::assertInstanceOf(Twig_Environment::class, createEnvironment());
    }
}
