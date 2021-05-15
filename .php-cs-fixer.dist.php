<?php

$finder = Symfony\Component\Finder\Finder::create()
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/config');

$fixer = new PhpCsFixer\Config;

return $fixer->setFinder($finder)->setRules([
    '@PSR12' => true,
    'array_syntax' => ['syntax' => 'short'],
    'array_indentation' => true,
    'trim_array_spaces' => true,
    'ordered_imports' => ['sortAlgorithm' => 'alpha'],
    'no_unused_imports' => true,
    'not_operator_with_successor_space' => true,
    'trailing_comma_in_multiline_array' => true,
    'phpdoc_scalar' => true,
    'unary_operator_spaces' => true,
    'binary_operator_spaces' => true,
    'blank_line_before_statement' => [
        'statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try'],
    ],
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_var_without_name' => true,
    'class_attributes_separation' => true,
    'method_argument_space' => [
        'on_multiline' => 'ensure_fully_multiline',
        'keep_multiple_spaces_after_comma' => true,
    ],
    'single_trait_insert_per_statement' => true,
    'no_superfluous_phpdoc_tags' => [
        'allow_mixed' => true,
    ]
]);