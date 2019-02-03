<?php

namespace Tests\Unit\Events;

use App\Service\{CodeGenerator, GenerateCodeStrategy};
use PHPUnit\Framework\TestCase;

/**
 * Unit tests code generator
 */
class CodeStrategyTest extends TestCase
{

    /**
     * Test code generator.
     * @param int $id
     * @param string $theme
     * @param string $code
     * @dataProvider codeGeneratorDataProvider
     */
    public function testCodeGenerator($id, $theme, $code)
    {
        $strategy = new GenerateCodeStrategy();
        $manager = new CodeGenerator($strategy);

        $this->assertEquals($code, $manager->generate($id, $theme));
    }

    /**
     * DataProvider for code generator.
     */
    public function codeGeneratorDataProvider()
    {
        return array(
            array('Kiyv is capital of ukraine', 0, 'KICOU-0'),
            array(' - .  DFGD RT jy', 34, 'DRJ-34'),
            array('87ngui', 5, '8-5'),
            array('..,.,,,..--', 50, 'CODE-50'),
            array('Докладчик планирует', 50, 'DP-50'),
        );
    }

}
