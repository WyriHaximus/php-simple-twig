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

        yield [
            '{% for name in names %}{{ name }}{% if loop.last == false %}, {% endif %}{% endfor %}',
            [
                'names' => ['Jopen', 'Oedipus', 'Texels', 'Guinness', 'De Moersleutel'],
            ],
            'Jopen, Oedipus, Texels, Guinness, De Moersleutel',
        ];

        /**
         * We can get our own template, not sure what the use is but we can
         */
        yield [
            '{{ _______WyriHaximus_Twig_Render_template_contents_______ }}',
            [],
            '{{ _______WyriHaximus_Twig_Render_template_contents_______ }}',
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
