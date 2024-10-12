<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\Twig;

use WyriHaximus\TestUtilities\TestCase;

use function WyriHaximus\Twig\render;

use const PHP_EOL;

final class RenderTest extends TestCase
{
    /** @return iterable<array<mixed>> */
    public static function provideTemplatesToRender(): iterable
    {
        yield [
            '{{ name }}',
            ['name' => 'Cees-Jan'],
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
         * We can get our own template, not sure what the use is but we can.
         */
        yield [
            '{{ _______WyriHaximus_Twig_Render_template_contents_______ }}',
            [],
            '{{ _______WyriHaximus_Twig_Render_template_contents_______ }}',
        ];

        yield [
            '{% for name in names %}{{ name }}{% if loop.last == false %}, {% endif %}{% endfor %}' . PHP_EOL .
                '{{ _______WyriHaximus_Twig_Render_template_contents_______ }}',
            [
                'names' => ['Jopen', 'Oedipus', 'Texels', 'Guinness', 'De Moersleutel'],
            ],
            'Jopen, Oedipus, Texels, Guinness, De Moersleutel' .
                '{% for name in names %}{{ name }}{% if loop.last == false %}, {% endif %}{% endfor %}' . PHP_EOL .
                '{{ _______WyriHaximus_Twig_Render_template_contents_______ }}',
        ];
    }

    /**
     * @param array<mixed> $data
     *
     * @dataProvider provideTemplatesToRender
     *
     * @test
     */
    public function render(string $template, array $data, string $expected): void
    {
        $result = render($template, $data);
        self::assertSame($expected, $result);
    }
}
