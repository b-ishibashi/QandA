<?php

use PhpCsFixer\Config;
use Symfony\Component\Finder\Finder;

$rules = [
   '@PSR2' => true,
   '@PHP71Migration' => true,
   'array_syntax' => ['syntax' => 'short'],
   'list_syntax' => ['syntax' => 'short'],
   'phpdoc_add_missing_param_annotation' => true,
   'phpdoc_order' => true,
   'phpdoc_types_order' => true,
];

$finder = (new Finder())
   ->notPath('config')
   ->notPath('resources')
   ->notPath('bootstrap/cache')
   ->notPath('storage')
   ->notPath('vendor')
   ->notName('*.blade.php')
   ->notName('_ide_helper.php')
   ->notName('_ide_helper_models.php')
   ->notName('.phpstorm.meta.php')
   ->notName('phpunit.xml')
   ->in(__DIR__);

$cacheDir = __DIR__;

return Config::create()
   ->setFinder($finder)
   ->setCacheFile("$cacheDir/.php_cs.cache")
   ->setRules($rules);
