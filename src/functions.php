<?php declare(strict_types=1);

namespace WyriHaximus\Twig;

use Twig_Environment;
use Twig_Extension_StringLoader;
use Twig_Loader_Array;

function render(string $template, array $data): string
{
    return renderWithEnvironment($template, $data, createEnvironment());
}

function renderWithEnvironment(string $template, array $data, Twig_Environment $environment): string
{
    $data['string'] = $template;

    return $environment->render('string', $data);
}

function createEnvironment(): Twig_Environment
{
    $environment = new Twig_Environment(
        new Twig_Loader_Array([
            'string' => '{{ include(template_from_string(string)) }}',
        ])
    );
    $environment->addExtension(new Twig_Extension_StringLoader());

    return $environment;
}
