<?php
# 1. 可为空（Nullable）类型
function testReturn() : ?string
{
    return 1111;
}
var_dump(testReturn()); //自动转string

function testParameter(?string $a)
{
    return $a;
}
var_dump(testParameter(1111)); //string(4) "1111"
var_dump(testParameter(false)); //string(0) ""

# 2. void函数
function swap(&$a, &$b) : void
{
    if ($a == $b) {
        return;
    }
    $tmp = $a;
    $a = $b;
    $b = $tmp;
}

$a = 1;
$b = 2;
var_dump(swap($a, $b), $a, $b);

# 3. 短数组语法, list()做备选
[$a, $b] = [1, 2];
var_dump($a,$b);

# 4.类常量可见性
class ConstDemo
{
    const CONST = 0;
    public const PUBLIC_CONST = 1;
    protected const PROTECTED_CONST = 2;
    private const PRIVATE_CONST = 3;
}
var_dump(ConstDemo::CONST, ConstDemo::PUBLIC_CONST);

# 5.iterable 伪类
function iterator(iterable $iter)
{
    foreach ($iter as $val) {
        //
    }
}

# 6. 多异常捕获处理
try {
    // some code
} catch (FirstException | SecondException $e) {
    // handle first and second exceptions
}

# 7. list()现在支持键名
list('id' => $id1, 'name' => $name1) = ['id' => 1, 'name' => 'AAA'];

# 8.支持为负的字符串偏移量
var_dump("abcdef"[-2]);

# 9. ext/openssl 支持 AEAD
class Test
{
    public function exposeFunction()
    {
        return Closure::fromCallable([$this, 'privateFunction']);
    }

    private function privateFunction($param)
    {
        var_dump($param);
    }
}

$privFunc = (new Test)->exposeFunction();
$privFunc('some value');

# 10.异步信号处理
pcntl_async_signals(true); // turn on async signals

pcntl_signal(SIGHUP,  function($sig) {
    echo "SIGHUP\n";
});

posix_kill(posix_getpid(), SIGHUP);