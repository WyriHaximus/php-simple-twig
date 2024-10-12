<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\Twig;

use Twig\Extension\SandboxExtension;
use Twig\Extension\StringLoaderExtension;
use WyriHaximus\TestUtilities\TestCase;

use function in_array;
use function WyriHaximus\Twig\createEnvironment;
use function WyriHaximus\Twig\renderWithEnvironment;

final class CreateEnvironmentTest extends TestCase
{
    /** @test */
    public function renderWithEnvironment(): void
    {
        $template = '{{ name }}';
        $data     = ['name' => 'Cees-Jan'];
        $render   = renderWithEnvironment($template, $data, createEnvironment());
        self::assertSame('Cees-Jan', $render);
    }

    /** @test */
    public function addedExtensions(): void
    {
        $environment = createEnvironment();
        $extensions  = [];

        foreach ($environment->getExtensions() as $extension) {
            $extensions[] = $extension::class;
        }

        self::assertTrue(in_array(StringLoaderExtension::class, $extensions, true));
        self::assertTrue(in_array(SandboxExtension::class, $extensions, true));
    }
}
