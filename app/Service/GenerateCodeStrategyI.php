<?php

namespace App\Service;

/**
 * Encapsulate some strategy for creating code value
 */
interface GenerateCodeStrategyI
{
    /**
     * Generate code for $task
     *
     * @param  string $theme
     * @param  int    $id
     * @return string
     */
    public function generate(string $theme, int $id): string;
}
