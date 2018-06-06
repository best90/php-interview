<?php 

/**
* 迭代模式
* 构造特定的对象，那些对象能够提供单一的标准接口循环或迭代任何类型的可计数器数据
*/
class ArrayContainer implements Iterator
{
	protected $data = [];
	protected $index;

	public function __construct($data)
	{
		# code...
		$this->data = $data;
	}

	//返回当前指针数据
	public function current()
	{
		return $this->data[$this->index];
	}

	//指针加1
	public function next()
	{
		return $this->index ++;
	}

	//验证指针是否越界
	public function vaild()
	{
		# code...
		return $this->index < count($this->data);
	}

	//重置指针
	public function rewind()
	{
		# code...
		$this->index = 0;
	}

	//返回当前指针
	public function key()
	{
		# code...
		return $this->index;
	}
}

//初始化数组容器
$array = [
	0 => '唐朝',
	1 => '宋朝',
	2 => '元朝'
];
$container = new ArrayContainer($array);

//遍历数组容器
foreach ($container as $key => $value) {
	echo '如果有时光机，我想去'.$value.PHP_EOL;
}