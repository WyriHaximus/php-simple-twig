<?php declare(strict_types=1);

namespace WyriHaximus\Twig;

use Twig_Environment;
use Twig_Extension_StringLoader;
use Twig_Loader_Array;

/**
 * Do not use this name in your data array as it will be overwritten.
 */
const NAME_AND_PLACEHOLDER = '_______WyriHaximus_Twig_Render_template_contents_______';

function render(string $template, array $data): string
{
    return renderWithEnvironment($template, $data, createEnvironment());
}

function renderWithEnvironment(string $template, array $data, Twig_Environment $environment): string
{
    $data[NAME_AND_PLACEHOLDER] = $template;

    return $environment->render(NAME_AND_PLACEHOLDER, $data);
}

function createEnvironment(): Twig_Environment
{
    $environment = new Twig_Environment(
        new Twig_Loader_Array([
            NAME_AND_PLACEHOLDER => '{{ include(template_from_string(' . NAME_AND_PLACEHOLDER . ')) }}',
        ])
    );
    $environment->addExtension(new Twig_Extension_StringLoader());

    return $environment;
}
