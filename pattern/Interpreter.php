<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/6 0006
 * Time: 下午 23:47
 */

namespace Pattern;


abstract class Expression
{
    abstract public function interpreter($context);
}

class TerminalExpression extends Expression
{
    public function interpreter($context)
    {
        // TODO: Implement interpreter() method.
        return null;
    }
}

class NonterminalExpress extends Expression
{
    public function interpreter($context)
    {
        // TODO: Implement interpreter() method.
        return null;
    }
}