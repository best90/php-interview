Shell 是一个用 C 语言编写的程序，它是用户使用 Linux 的桥梁。Shell 既是一种命令语言，又是一种程序设计语言。
Shell 是指一种应用程序，这个应用程序提供了一个界面，用户通过这个界面访问操作系统内核的服务。

#### Shell变量
定义变量时，变量名不加美元符号
```
your_name="cccc"
```

使用一个定义过的变量，只要在变量名前面加美元符号即可
```
your_name="ccccc"
echo $your_name
echo ${your_name}
```

使用 readonly 命令可以将变量定义为只读变量，只读变量的值不能被改变。
```
#!/bin/bash
myUrl="http://www.google.com"
readonly myUrl
myUrl="http://www.baidu.com"
```

使用 unset 命令可以删除变量
```
unset your_name
```

获取字符串长度
```
string="abcd"
echo ${#string} #输出 4
```

提取子字符串
```
string="abcdefg"
echo ${string:1:4} 
```

Shell 数组
````
array_name=(value0 value1 value2 value3)

# 取得数组元素的个数
length=${#array_name[@]}
# 或者
length=${#array_name[*]}
# 取得数组单个元素的长度
lengthn=${#array_name[n]}
````

#### Shell 传递参数
在执行 Shell 脚本时，向脚本传递参数，脚本内获取参数的格式为：$n。n 代表一个数字，1 为执行脚本的第一个参数，2 为执行脚本的第二个参数，以此类推……

```
$ chmod +x test.sh 
$ ./test.sh 1 2 3
Shell 传递参数实例！
执行的文件名：./test.sh
第一个参数为：1
第二个参数为：2
第三个参数为：3
```

$#	传递到脚本的参数个数
$*	以一个单字符串显示所有向脚本传递的参数。
如"$*"用「"」括起来的情况、以"$1 $2 … $n"的形式输出所有参数。
$$	脚本运行的当前进程ID号
$!	后台运行的最后一个进程的ID号
$@	与$*相同，但是使用时加引号，并在引号中返回每个参数。
如"$@"用「"」括起来的情况、以"$1" "$2" … "$n" 的形式输出所有参数。
$-	显示Shell使用的当前选项，与set命令功能相同。
$?	显示最后命令的退出状态。0表示没有错误，其他任何值表明有错误。

#### Shell 基本运算符

算术运算符

| 运算符 | 说明                                          | 举例                           |
| ------ | --------------------------------------------- | ------------------------------ |
| +      | 加法                                          | `expr $a + $b` 结果为 30。     |
| -      | 减法                                          | `expr $a - $b` 结果为 -10。    |
| *      | 乘法                                          | `expr $a \* $b` 结果为  200。  |
| /      | 除法                                          | `expr $b / $a` 结果为 2。      |
| %      | 取余                                          | `expr $b % $a` 结果为 0。      |
| =      | 赋值                                          | `a=$b` 将把变量 b 的值赋给 a。 |
| ==     | 相等。用于比较两个数字，相同则返回 true。     | [ `$a == $b` ] 返回 false。    |
| !=     | 不相等。用于比较两个数字，不相同则返回 true。 | [` $a != $b` ] 返回 true。     |

 关系运算符

| 运算符 | 说明                                                  | 举例                         |
| ------ | ----------------------------------------------------- | ---------------------------- |
| -eq    | 检测两个数是否相等，相等返回 true。                   | [ `$a` -eq $b ] 返回 false。 |
| -ne    | 检测两个数是否不相等，不相等返回 true。               | [ `$a` -ne $b ] 返回 true。  |
| -gt    | 检测左边的数是否大于右边的，如果是，则返回 true。     | [` $a` -gt $b ] 返回 false。 |
| -lt    | 检测左边的数是否小于右边的，如果是，则返回 true。     | [ `$a` -lt $b ] 返回 true。  |
| -ge    | 检测左边的数是否大于等于右边的，如果是，则返回 true。 | [ `$a` -ge $b ] 返回 false。 |
| -le    | 检测左边的数是否小于等于右边的，如果是，则返回 true。 | [` $a` -le $b ] 返回 true。  |

 布尔运算符

| 运算符 | 说明                                                | 举例                                      |
| ------ | --------------------------------------------------- | ----------------------------------------- |
| !      | 非运算，表达式为 true 则返回 false，否则返回 true。 | [ ! false ] 返回 true。                   |
| -o     | 或运算，有一个表达式为 true 则返回 true。           | [ `$a` -lt 20 -o  $b -gt 100 ] 返回 true。  |
| -a     | 与运算，两个表达式都为 true 才返回 true。           | [ `$a` -lt 20 -a  $b -gt 100 ] 返回 false。 |

 逻辑运算符

| 运算符 | 说明       | 举例                                        |
| ------ | ---------- | ------------------------------------------- |
| &&     | 逻辑的 AND | [[ `$a -lt 100 && $b -gt 100` ]] 返回 false |
| \|\|   | 逻辑的 OR  | [[ `$a -lt 100 || $b -gt 100` ]] 返回 true  |

字符串运算符

| 运算符 | 说明                                      | 举例                       |
| ------ | ----------------------------------------- | -------------------------- |
| =      | 检测两个字符串是否相等，相等返回 true。   | [` $a = $b` ] 返回 false。 |
| !=     | 检测两个字符串是否相等，不相等返回 true。 | [` $a != $b `] 返回 true。 |
| -z     | 检测字符串长度是否为0，为0返回 true。     | [` -z $a` ] 返回 false。   |
| -n     | 检测字符串长度是否为0，不为0返回 true。   | [ `-n "$a"` ] 返回 true。  |
| str    | 检测字符串是否为空，不为空返回 true。     | [ $a ] 返回 true。         |

文件测试运算符

| 操作符  | 说明                                                         | 举例                      |
| ------- | ------------------------------------------------------------ | ------------------------- |
| -b file | 检测文件是否是块设备文件，如果是，则返回 true。              | [ -b $file ] 返回 false。 |
| -c file | 检测文件是否是字符设备文件，如果是，则返回 true。            | [ -c $file ] 返回 false。 |
| -d file | 检测文件是否是目录，如果是，则返回 true。                    | [ -d $file ] 返回 false。 |
| -f file | 检测文件是否是普通文件（既不是目录，也不是设备文件），如果是，则返回 true。 | [ -f $file ] 返回 true。  |
| -g file | 检测文件是否设置了 SGID 位，如果是，则返回 true。            | [ -g $file ] 返回 false。 |
| -k file | 检测文件是否设置了粘着位(Sticky Bit)，如果是，则返回 true。  | [ -k $file ] 返回 false。 |
| -p file | 检测文件是否是有名管道，如果是，则返回 true。                | [ -p $file ] 返回 false。 |
| -u file | 检测文件是否设置了 SUID 位，如果是，则返回 true。            | [ -u $file ] 返回 false。 |
| -r file | 检测文件是否可读，如果是，则返回 true。                      | [ -r $file ] 返回 true。  |
| -w file | 检测文件是否可写，如果是，则返回 true。                      | [ -w $file ] 返回 true。  |
| -x file | 检测文件是否可执行，如果是，则返回 true。                    | [ -x $file ] 返回 true。  |
| -s file | 检测文件是否为空（文件大小是否大于0），不为空返回 true。     | [ -s $file ] 返回 true。  |
| -e file | 检测文件（包括目录）是否存在，如果是，则返回 true。          | [ -e $file ] 返回 true。  |

#### Shell test命令

Shell中的 test 命令用于检查某个条件是否成立，它可以进行数值、字符和文件三个方面的测试 。

#### Shell 流程控制

```
if condition
then
    command1 
    command2
    ...
    commandN 
fi

if condition1
then
    command1
elif condition2 
then 
    command2
else
    commandN
fi
```

```
for var in item1 item2 ... itemN
do
    command1
    command2
    ...
    commandN
done
```

```
while condition
do
    command
done
```

```
until condition
do
    command
done
```

```
case 值 in
模式1)
    command1
    command2
    ...
    commandN
    ;;
模式2）
    command1
    command2
    ...
    commandN
    ;;
esac
```

#### Shell 输入/输出重定向

| 命令            | 说明                                               |
| --------------- | -------------------------------------------------- |
| command > file  | 将输出重定向到 file。                              |
| command < file  | 将输入重定向到 file。                              |
| command >> file | 将输出以追加的方式重定向到 file。                  |
| n > file        | 将文件描述符为 n 的文件重定向到 file。             |
| n >> file       | 将文件描述符为 n 的文件以追加的方式重定向到 file。 |
| n >& m          | 将输出文件 m 和 n 合并。                           |
| n <& m          | 将输入文件 m 和 n 合并。                           |
| << tag          | 将开始标记 tag 和结束标记 tag 之间的内容作为输入。 |

#### Shell 文件包含

和其他语言一样，Shell 也可以包含外部脚本。这样可以很方便的封装一些公用的代码作为一个独立的文件。

```
. filename   # 注意点号(.)和文件名中间有一空格
或
source filename
```