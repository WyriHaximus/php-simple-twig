<?php

declare(strict_types=1);

namespace WyriHaximus\Twig;

use Twig\Environment;
use Twig\Extension\ExtensionInterface;

/**
 * Do not use this name in your data array as it will be overwritten.
 */
const NAME_AND_PLACEHOLDER = '_______WyriHaximus_Twig_Render_template_contents_______';

/** @param array<string, mixed> $data */
function render(string $template, array $data): string
{
    return SimpleTwig::render($template, $data);
}

/** @param array<string, mixed> $data */
function renderWithEnvironment(string $template, array $data, Environment $environment): string
{
    return SimpleTwig::renderWithEnvironment($template, $data, $environment);
}

function createEnvironment(ExtensionInterface ...$extensions): Environment
{
    return SimpleTwig::createEnvironment(...$extensions);
}
