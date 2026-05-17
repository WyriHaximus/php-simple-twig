<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\Twig;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use WyriHaximus\TestUtilities\TestCase;

use function WyriHaximus\Twig\render;

use const PHP_EOL;

final class RenderTest extends TestCase
{
    /** @return iterable<string, array<string, mixed>> */
    public static function provideTemplatesToRender(): iterable
    {
        /**
         * Good enough
         *
         * @phpstan-ignore generator.valueType
         */
        yield 'name' => [
            '{{ name }}',
            ['name' => 'Cees-Jan'],
            'Cees-Jan',
        ];

        /**
         * Good enough
         *
         * @phpstan-ignore generator.valueType
         */
        yield 'beers' => [
            '{% for name in names %}{{ name }}{% if loop.last == false %}, {% endif %}{% endfor %}',
            [
                'names' => ['Jopen', 'Oedipus', 'Texels', 'Guinness', 'De Moersleutel'],
            ],
            'Jopen, Oedipus, Texels, Guinness, De Moersleutel',
        ];

        /**
         * We can get our own template, not sure what the use is but we can.
         *
         * Good enough
         *
         * @phpstan-ignore generator.valueType
         */
        yield 'own' => [
            '{{ _______WyriHaximus_Twig_Render_template_contents_______ }}',
            [],
            '{{ _______WyriHaximus_Twig_Render_template_contents_______ }}',
        ];

        /**
         * Good enough
         *
         * @phpstan-ignore generator.valueType
         */
        yield 'all' => [
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

    /** @param array<string, mixed> $data */
    #[Test]
    #[DataProvider('provideTemplatesToRender')]
    public function render(string $template, array $data, string $expected): void
    {
        $result = render($template, $data);
        self::assertSame($expected, $result);
    }
}
