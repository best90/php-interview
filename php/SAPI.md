#### php 运行模式(SAPI)
SAPI 为 PHP 提供了一个和外部通信的接口， PHP 就是通过这个接口来与其它的应用进行数据交互的。
常见的有：apache、apache2filter、apache2handler、cli、cgi、embed 、fast-cgi、isapi 

- CLI 模式

    CLI（ Command Line Interface ）， 也就是命令行接口，PHP 默认会安装。通过这个接口，可以在 shell 环境下与 PHP 进行交互 。
    
- CGI 模式

    CGI（Common Gateway Interface，通用网关接口）是一种重要的互联网技术，可以让一个客户端，从网页浏览器向执行在网络服务器上的程序请求数据。CGI 描述了服务器和请求处理程序之间传输数据的一种标准。
    
    原理：当 Nginx 收到浏览器 /index.php 这个请求后，首先会创建一个对应实现了 CGI 协议的进程，这里就是 php-cgi（PHP 解析器）。接下来 php-cgi 会解析 php.ini 文件，初始化执行环境，然后处理请求，再以 CGI 规定的格式返回处理后的结果，退出进程。最后，Nginx 再把结果返回给浏览器。整个流程就是一个 Fork-And-Execute 模式。
    
    当用户请求数量非常多时，会大量挤占系统的资源如内存、CPU 时间等，造成效能低下。所以在用 CGI 方式的服务器下，有多少个连接请求就会有多少个 CGI 子进程，子进程反复加载是 CGI 性能低下的主要原因。
    
- FastCGI 模式

    FastCGI（Fast Common Gateway Interface，快速通用网关接口）是一种让交互程序与 Web 服务器通信的协议。FastCGI 是早期通用网关接口（CGI）的增强版本。
    FastCGI 致力于减少网页服务器与 CGI 程序之间交互的开销，从而使服务器可以同时处理更多的网页请求。
    
    PHP-FPM（PHP-FastCGI Process Manager）是 PHP 语言中实现了 FastCGI 协议的进程管理器，由 Andrei Nigmatulin 编写实现，已被 PHP 官方收录并集成到内核中。
    
    FastCGI 模式的优点：
    
    + 从稳定性上看，FastCGI 模式是以独立的进程池来运行 CGI 协议程序，单独一个进程死掉，系统可以很轻易的丢弃，然后重新分配新的进程来运行逻辑；
    + 从安全性上看，FastCGI 模式支持分布式运算。FastCGI 程序和宿主的 Server 完全独立，FastCGI 程序挂了也不影响 Server；
    + 从性能上看，FastCGI 模式把动态逻辑的处理从 Server 中分离出来，大负荷的 I O处理还是留给宿主 Server，这样宿主 Server 可以一心一意处理 IO，对于一个普通的动态网页来说, 逻辑处理可能只有一小部分，大量的是图片等静态。

- Module 模式
    
    PHP 常常与 Apache 服务器搭配形成 LAMP 配套的运行环境。把 PHP 作为一个子模块集成到 Apache 中，就是 Module 模式
    
- ISAPI 模式

    SAPI（Internet Server Application Program Interface）是微软提供的一套面向 Internet 服务的 API 接口，一个 ISAPI 的 DLL，可以在被用户请求激活后长驻内存，等待用户的另一个请求，还可以在一个 DL L里设置多个用户请求处理函数，此外，ISAPI 的 DLL 应用程序和 WEB 服务器处于同一个进程中，效率要显著高于CGI。由于微软的排他性，只能运行于 Windows 环境。