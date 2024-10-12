<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\Twig;

use Mockery;
use Twig\Environment;
use WyriHaximus\TestUtilities\TestCase;

use function WyriHaximus\Twig\renderWithEnvironment;

use const WyriHaximus\Twig\NAME_AND_PLACEHOLDER;

final class RenderWithEnvironmentTest extends TestCase
{
    public function testRenderWithEnvironment(): void
    {
        $template    = '{{ name }}';
        $data        = ['name' => 'Cees-Jan'];
        $environment = Mockery::mock(Environment::class);
        $environment->shouldReceive('render')->with(
            NAME_AND_PLACEHOLDER,
            [
                'name' => 'Cees-Jan',
                NAME_AND_PLACEHOLDER => $template,
            ],
        )->once()->andReturn('');
        renderWithEnvironment($template, $data, $environment);
    }
}
