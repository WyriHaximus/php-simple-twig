<?php

declare(strict_types=1);

namespace WyriHaximus\Twig;

use Twig\Environment;
use Twig\Extension\SandboxExtension;
use Twig\Extension\StringLoaderExtension;
use Twig\Loader\ArrayLoader;
use Twig\Sandbox\SecurityPolicy;

/**
 * Do not use this name in your data array as it will be overwritten.
 */
const NAME_AND_PLACEHOLDER = '_______WyriHaximus_Twig_Render_template_contents_______';

/**
 * @param array<string, mixed> $data
 */
function render(string $template, array $data): string
{
    return renderWithEnvironment($template, $data, createEnvironment());
}

/**
 * @param array<string, mixed> $data
 */
function renderWithEnvironment(string $template, array $data, Environment $environment): string
{
    $data[NAME_AND_PLACEHOLDER] = $template;

    return $environment->render(NAME_AND_PLACEHOLDER, $data);
}

function createEnvironment(): Environment
{
    $environment = new Environment(
        new ArrayLoader([
            NAME_AND_PLACEHOLDER => '{{ include(template_from_string(' . NAME_AND_PLACEHOLDER . ')) }}',
        ])
    );
    $environment->addExtension(new StringLoaderExtension());
    $environment->addExtension(new SandboxExtension(new SecurityPolicy()));

    return $environment;
}
