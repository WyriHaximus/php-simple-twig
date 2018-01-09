<?php declare(strict_types=1);

namespace WyriHaximus\Tests\Twig;

use PHPUnit\Framework\TestCase;
use function WyriHaximus\Twig\render;

final class RenderTest extends TestCase
{
    public function testRender()
    {
        $template = '{{ name }}';
        $data = [
            'name' => 'Jopen',
        ];
        $expected = 'Jopen';

        $result = render($template, $data);
        self::assertSame($expected, $result);
    }
}
