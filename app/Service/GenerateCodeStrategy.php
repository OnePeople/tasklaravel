<?php

namespace App\Service;

/**
 * Generate code like CODE-{number}
 */
class GenerateCodeStrategy implements GenerateCodeStrategyI
{


    /**
     * Generate code for model
     *
     * @param  string $theme
     * @param  int    $id
     * @return string
     */
    public function generate(string $theme, int $id): string
    {

        return $this->getSlug($theme) . '-' . $id;
    }

    /**
     * Generates slug from string.
     *
     * @param  string $string
     * @return string
     */
    private function getSlug(string $string): string
    {
        $string = transliterator_transliterate(
            "Any-Latin;
            Latin-ASCII;
            NFD;
            [:Nonspacing Mark:] Remove;
            [^\u0020\u002D\u0030-\u0039\u0041-\u005A\u0041-\u005A\u005F\u0061-\u007A\u007E] Remove;
            NFC;
            Lower();",
            $string
        );
        preg_match_all('/\b\w/', $string, $prefix);
        if (isset($prefix[0]) && $prefix[0]) {
            $prefix = mb_strtoupper(implode('', $prefix[0]));
            $prefix = mb_substr($prefix, 0, 10);
            return trim($prefix, '-');
        } else {
            return "CODE";
        }
    }
}
