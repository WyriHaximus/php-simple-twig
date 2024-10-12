<?php

declare(strict_types=1);

namespace WyriHaximus\Twig;

use Twig\Environment;
use Twig\Extension\SandboxExtension;
use Twig\Extension\StringLoaderExtension;
use Twig\Loader\ArrayLoader;
use Twig\Sandbox\SecurityPolicy;

final class SimpleTwig
{
    /**
     * Do not use this name in your data array as it will be overwritten.
     */
    private const NAME_AND_PLACEHOLDER = '_______WyriHaximus_Twig_Render_template_contents_______';

    /** @param array<string, mixed> $data */
    public static function render(string $template, array $data): string
    {
        return self::renderWithEnvironment($template, $data, self::createEnvironment());
    }

    /** @param array<string, mixed> $data */
    public static function renderWithEnvironment(string $template, array $data, Environment $environment): string
    {
        $data[self::NAME_AND_PLACEHOLDER] = $template;

        return $environment->render(self::NAME_AND_PLACEHOLDER, $data);
    }

    public static function createEnvironment(): Environment
    {
        $environment = new Environment(
            new ArrayLoader([
                self::NAME_AND_PLACEHOLDER => '{{ include(template_from_string(' . self::NAME_AND_PLACEHOLDER . ')) }}',
            ]),
        );
        $environment->addExtension(new StringLoaderExtension());
        $environment->addExtension(new SandboxExtension(new SecurityPolicy()));

        return $environment;
    }
}
