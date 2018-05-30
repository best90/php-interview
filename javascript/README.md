### JavaScript
JavaScript 是互联网上最流行的脚本语言，这门语言可用于 HTML 和 web，更可广泛用于服务器、PC、笔记本电脑、平板电脑和智能手机等设备。

#### JavaScript 数据类型

字符串（String）、数字(Number)、布尔(Boolean)、数组(Array)、对象(Object)、空（Null）、未定义（Undefined）。

#### JavaScript 可以通过不同的方式来输出数据：
- 使用 window.alert() 弹出警告框。
- 使用 document.write() 方法将内容写到 HTML 文档中。
- 使用 innerHTML 写入到 HTML 元素。
- 使用 console.log() 写入到浏览器的控制台。

#### JavaScript 变量
- 局部 JavaScript 变量：
  在 JavaScript 函数内部声明的变量（使用 var）是局部变量，所以只能在函数内部访问它。（该变量的作用域是局部的）。
  您可以在不同的函数中使用名称相同的局部变量，因为只有声明过该变量的函数才能识别出该变量。
  只要函数运行完毕，本地变量就会被删除。
- 全局 JavaScript 变量：
  在函数外声明的变量是全局变量，网页上的所有脚本和函数都能访问它。
  
JavaScript 变量的生命期从它们被声明的时间开始。局部变量会在函数运行以后被删除。全局变量会在页面关闭后被删除。

#### JavaScript 事件
- HTML 事件（常用）
    + onchange	HTML 元素改变
    + onclick	用户点击 HTML 元素
    + onmouseover	用户在一个HTML元素上移动鼠标
    + onmouseout	用户从一个HTML元素上移开鼠标
    + onkeydown	用户按下键盘按键
    + onload	浏览器已完成页面的加载
    + onkeydown	某个键盘按键被按下
    + onkeypress	某个键盘按键被按下并松开
    + onkeyup	某个键盘按键被松开
    + onblur	元素失去焦点时触发	
    + onfocus	元素获取焦点时触发	
    + onfocusin	元素即将获取焦点时触发	
    + onfocusout	元素即将失去焦点时触发	
    + oninput	元素获取用户输入时触发	
    + onreset	表单重置时触发	
    + onsearch	用户向搜索域输入文本时触发 ( <input="search">)	 
    + onselect	用户选取文本时触发 ( <input> 和 <textarea>)	
    + onsubmit	表单提交时触发

    
#### JavaScript JSON
JSON.parse()	用于将一个 JSON 字符串转换为 JavaScript 对象。
JSON.stringify()	用于将 JavaScript 值转换为 JSON 字符串。

#### JavaScript HTML DOM

查找 HTML 元素
```
var x=document.getElementById("main");
var y=x.getElementsByTagName("p");
var z=document.getElementsByClassName("intro");
```

改变 HTML 内容
```
document.getElementById(id).innerHTML=新的 HTML
```

改变 HTML 样式
```
document.getElementById(id).style.property=新样式
```

addEventListener() 方法
```
element.addEventListener(event, function, useCapture);
```
removeEventListener() 方法
removeEventListener() 方法移除由 addEventListener() 方法添加的事件句柄
```
element.removeEventListener("mousemove", myFunction);
```

#### JavaScript Window - 浏览器对象模型
```
- window.open() - 打开新窗口
- window.close() - 关闭当前窗口
- window.moveTo() - 移动当前窗口
- window.resizeTo() - 调整当前窗口的尺寸
- screen.availWidth - 可用的屏幕宽度
- screen.availHeight - 可用的屏幕高度
- location.hostname 返回 web 主机的域名
- location.pathname 返回当前页面的路径和文件名
- location.port 返回 web 主机的端口 （80 或 443）
- location.protocol 返回所使用的 web 协议（http:// 或 https://）
- history.back() - 与在浏览器点击后退按钮相同
- history.forward() - 与在浏览器中点击向前按钮相同
- window.alert("sometext");
- window.confirm("sometext");
- window.prompt("sometext","defaultvalue");
- setInterval() 间隔指定的毫秒数不停地执行指定的代码
- clearInterval() 方法用于停止 setInterval() 方法执行的函数代码。
- setTimeout() 方法
```

#### 事件冒泡或事件捕获？

```
事件传递有两种方式：冒泡与捕获。
事件传递定义了元素事件触发的顺序。 如果你将 <p> 元素插入到 <div> 元素中，用户点击 <p> 元素, 哪个元素的 "click" 事件先被触发呢？
在 冒泡 中，内部元素的事件会先被触发，然后再触发外部元素，即： <p> 元素的点击事件先触发，然后会触发 <div> 元素的点击事件。
在 捕获 中，外部元素的事件会先被触发，然后才会触发内部元素的事件，即： <div> 元素的点击事件先触发 ，然后再触发 <p> 元素的点击事件。
```