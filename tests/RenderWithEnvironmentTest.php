<?php declare(strict_types=1);

namespace WyriHaximus\Tests\Twig;

use PHPUnit\Framework\TestCase;
use Twig_Environment;
use const WyriHaximus\Twig\NAME_AND_PLACEHOLDER;
use function WyriHaximus\Twig\renderWithEnvironment;

final class RenderWithEnvironmentTest extends TestCase
{
    public function testRenderWithEnvironment()
    {
        $template = '{{ name }}';
        $data = [
            'name' => 'Cees-Jan',
        ];
        $environment = $this->prophesize(Twig_Environment::class);
        $environment->render(NAME_AND_PLACEHOLDER, [
            'name' => 'Cees-Jan',
            NAME_AND_PLACEHOLDER => $template,
        ])->shouldBeCalled()->willReturn('');
        renderWithEnvironment($template, $data, $environment->reveal());
    }
}
