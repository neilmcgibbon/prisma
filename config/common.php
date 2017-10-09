<?php

/**
 * Services and helper functions
 */

use Symfony\Component\Translation\Translator;

/**
 * App instance.
 *
 * @return \DI\Bridge\Slim\App
 */
function app()
{
    static $app = null;
    if ($app === null) {
        $app = new class() extends \DI\Bridge\Slim\App
        {
            protected function configureContainer(\DI\ContainerBuilder $builder)
            {
                $builder->addDefinitions(__DIR__ . '/container.php');

                $settings = read(__DIR__ . '/config.php');
                if ($settings['env'] !== 'development') {
                    // composer require doctrine/cache
                    $cacheDirectory = $settings['temp'] . '/container-cache';
                    $builder->setDefinitionCache(new \Doctrine\Common\Cache\PhpFileCache($cacheDirectory));
                }
                // composer require doctrine/annotations
                $builder->useAnnotations(true);
            }
        };
    }
    return $app;
}

/**
 * A simple PHP Dependency Injection Container.
 *
 * @return \DI\Container
 */
function container()
{
    return app()->getContainer();
}

/**
 * Get application settings.
 *
 * @return mixed
 */
function settings()
{
    return container()->get('settings');
}

/**
 * Text translation (I18n)
 *
 * @param string $message
 * @param ...$context
 * @return string
 *
 * <code>
 * echo __('Hello');
 * echo __('There are %s persons logged', 7);
 * </code>
 */
function __($message)
{
    /* @var $translator Translator */
    $translator = container()->get(Translator::class);
    $translated = $translator->trans($message);
    $context = array_slice(func_get_args(), 1);
    if (!empty($context)) {
        $translated = vsprintf($translated, $context);
    }
    return $translated;
}