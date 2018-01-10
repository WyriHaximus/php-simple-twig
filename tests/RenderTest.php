<?php declare(strict_types=1);

namespace WyriHaximus\Tests\Twig;

use PHPUnit\Framework\TestCase;
use function WyriHaximus\Twig\render;

final class RenderTest extends TestCase
{
    public function provideTemplatesToRender()
    {
        yield [
            '{{ name }}',
            [
                'name' => 'Cees-Jan',
            ],
            'Cees-Jan',
        ];
    }

    /**
     * @dataProvider provideTemplatesToRender
     */
    public function testRender(string $template, array $data, string $expected)
    {
        $result = render($template, $data);
        self::assertSame($expected, $result);
    }
}
