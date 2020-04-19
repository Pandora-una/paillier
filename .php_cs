<?php
   $config = PhpCsFixer\Config::create()->setRules([
    '@PSR2' => true,
    'blank_line_after_namespace' => true,
    'braces' => true,
    'cast_spaces' => true,
    'declare_equal_normalize' => true,
    'doctrine_annotation_indentation' => true,
    'indentation_type' => true,
    'no_trailing_whitespace' => true,
    'no_unneeded_control_parentheses' => true,
    'no_unused_imports' => true,
    'no_useless_else' => true,
    'no_useless_return' => true,
    'no_whitespace_in_blank_line' => true,
    'ordered_class_elements' => true,
    'ordered_imports' => true,
    'psr4' => true,
    'trailing_comma_in_multiline_array' => true,

]);


   $finder = PhpCsFixer\Finder::create()
		->in(__DIR__);

   return $config->setFinder($finder);

