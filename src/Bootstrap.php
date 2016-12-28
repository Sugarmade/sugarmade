<?php

use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\TwigServiceProvider;

$app['locale'] = 'en';
$app['session.default_locale'] = $app['locale'];

$app['cache.path'] = __DIR__ . '/../cache';
$app['http_cache.cache_dir'] = $app['cache.path'] . '/http';
$app['twig.options.cache'] = $app['cache.path'] . '/twig';

$app->register(new TwigServiceProvider(), [
    'twig.options' => [
        'cache' => false,//$app['twig.options.cache'],
        'strict_variables' => true,
    ],
    'twig.path' => [__DIR__ . '/../resources/views'],
]);
$app->register(new HttpCacheServiceProvider());
$app->register(new MonologServiceProvider(), [
    'monolog.logfile' => __DIR__ . '/../resources/log/app.log',
    'monolog.name'    => 'app',
    'monolog.level'   => 300,
]);

return $app;
