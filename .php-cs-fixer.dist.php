<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Import\OrderedImportsFixer;

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests')
    ->append([__FILE__])
;

$config = new PhpCsFixer\Config();

return $config->setUsingCache(true)
    ->setRules([
        '@DoctrineAnnotation' => true,
        '@PSR2' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'array_indentation' => true,
        'class_definition' => ['multi_line_extends_each_single_line' => true],
        'compact_nullable_typehint' => true,
        'concat_space' => ['spacing' => 'one'],
        'declare_strict_types' => true,
        'heredoc_to_nowdoc' => true,
        'global_namespace_import' => [
            'import_classes' => false,
            'import_constants' => false,
            'import_functions' => false,
        ],
        'list_syntax' => ['syntax' => 'short'],
        'no_null_property_initialization' => true,
        'phpdoc_to_comment' => false,
        'ordered_imports' => [
            'imports_order' => [
                OrderedImportsFixer::IMPORT_TYPE_CONST,
                OrderedImportsFixer::IMPORT_TYPE_FUNCTION,
                OrderedImportsFixer::IMPORT_TYPE_CLASS,
            ],
        ],
        'pow_to_exponentiation' => true,
        'phpdoc_align' => ['align' => 'left'],
        'phpdoc_summary' => false,
        'ternary_to_null_coalescing' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
