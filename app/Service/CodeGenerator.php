<?php

namespace App\Service;

/**
 * Manage strategy for code generating
 */
class CodeGenerator
{
    /**
     * @var GenerateCodeStrategyI
     */
    private $codeStrategy;

    public function __construct(GenerateCodeStrategyI $codeStrategy)
    {
        $this->codeStrategy = $codeStrategy;
    }

    /**
     * Generate code for model by some strategy
     *
     * @param  string $theme
     * @param  int    $id
     * @return string
     */
    public function generate(string $theme, int $id): string
    {
        return $this->codeStrategy->generate($theme, $id);
    }
}
