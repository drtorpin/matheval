<?php
include(dirname(__DIR__).'\lib\MathEval.php');
use PHPUnit\Framework\TestCase;
use lib\MathEval;

/**
 * UNIT-test MathEval
 * Class MathEvalTest
 */

final class MathEvalTest extends PHPUnit\Framework\TestCase
{

    /**
     * Проверка вычисления одного действия
     * @throws ReflectionException
     */

    public function testEvalMathAction()
    {
        $mathEvalMethod = new ReflectionMethod('lib\MathEval', 'evalMathAction');
        if ($mathEvalMethod->isPrivate()) {
            $mathEvalMethod->setAccessible(true);
        }
        $result = $mathEvalMethod->invokeArgs(new lib\MathEval,['3','-','1']);
        $this->assertTrue(($result == 2 ? true : false));

        $result = $mathEvalMethod->invokeArgs(new lib\MathEval,['3',':','0']);
        $this->assertTrue(($result === false ? true : false));
    }

    /**
     * Проверка валидации входящего математического выражения
     * @throws ReflectionException
     */
    public function testValidateExpression()
    {
        $mathEvalMethod = new ReflectionMethod('lib\MathEval', 'validateExpression');
        if ($mathEvalMethod->isPrivate()) {
            $mathEvalMethod->setAccessible(true);
        }
        $result = $mathEvalMethod->invokeArgs(new lib\MathEval,['3-1']);
        $this->assertTrue(($result ? true : false));

        $result = $mathEvalMethod->invokeArgs(new lib\MathEval,['3-11+0*2']);
        $this->assertTrue(($result ? true : false));

        $result = $mathEvalMethod->invokeArgs(new lib\MathEval,['-1+9']);
        $this->assertTrue((!$result ? true : false));

        $result = $mathEvalMethod->invokeArgs(new lib\MathEval,['10+9*']);
        $this->assertTrue((!$result ? true : false));

        $result = $mathEvalMethod->invokeArgs(new lib\MathEval,['10 +9']);
        $this->assertTrue((!$result ? true : false));

        $result = $mathEvalMethod->invokeArgs(new lib\MathEval,['10+9T']);
        $this->assertTrue((!$result ? true : false));
    }

    /**
     * Првоерка вычисления выражения
     * @throws ReflectionException
     */
    public function testEvalExpression()
    {
        $mathEvalMethod = new ReflectionMethod('lib\MathEval', 'evalExpression');
        if ($mathEvalMethod->isPrivate()) {
            $mathEvalMethod->setAccessible(true);
        }
        $result = $mathEvalMethod->invokeArgs(new lib\MathEval,['123']);
        $this->assertTrue(($result == 123 ? true : false));

        $result = $mathEvalMethod->invokeArgs(new lib\MathEval,['30:3+2-1']);
        $this->assertTrue(($result == 11 ? true : false));

        $result = $mathEvalMethod->invokeArgs(new lib\MathEval,['+3-3']);
        $this->assertTrue((!$result ? true : false));

        $result = $mathEvalMethod->invokeArgs(new lib\MathEval,['']);
        $this->assertTrue((!$result ? true : false));

        $result = $mathEvalMethod->invokeArgs(new lib\MathEval,['3+2_1']);
        $this->assertTrue((!$result ? true : false));

        $result = $mathEvalMethod->invokeArgs(new lib\MathEval,['12 1']);
        $this->assertTrue((!$result ? true : false));
    }
}
