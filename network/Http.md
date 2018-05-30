### 概念

Hypertext Transfer Protocol, 超文本传输(转移)协议，是客户端和服务端传输文本制定的协议。构建WWW的具体的三项技术如下：

WWW: world wide web, 万维网
    
    - HTML: Hypertext Markup Language, 超文本标记语言
    - HTTP: Hypertext Transfer Protocol, 超文本传输(转移)协议 (HTTP是TCP/IP的应用层协议)
    - URL: Uniform Resource Locator, 统一资源定位符号 

> URI: Uniform Resource Identitier, 统一资源标示符号，URL是URI的子集


#### 简述 HTTP 协议的工作流程
> 1. 地址解析;  
> 在浏览器中输入 URL，浏览器会从中分解出协议名、主机名、端口、对象路径等部分
> 2. 封装 HTTP 请求数据包
> 3. 浏览器获取主机 IP 地址，建立 TCP 链接（TCP 的三次握手）
> 4. TCP 链接建立后发送 HTTP 请求  
> 请求方式的格式为：统一资源标识符（URL）、协议版本号，后边是 MIME 信息包括请求修饰符、客户机信息和可内容。
> 5. 服务器接到请求后，给予相应的响应信息  
> 其格式为一个状态行，包括信息的协议版本号、一个成功或错误的代码，后边是 MIME 信息包括服务器信息、实体信息和可能的内容
> 6. 服务器断开 TCP 连接

### TCP/IP

```
    应用层(http/https/websocket/ftp...) => 定义：文本传输协议
      |
    传输层(tcp/udp) => 定义：端口
      |
    网络层(ip)　=> 定义：IP
      |
    链路层(mac&数据包) => 定义：数据包，MAC地址
      |
    实体层(光缆/电缆/交换机/路由/终端...) => 定义：物理
```

TCP/IP:

- 解释一：分别代表tcp协议和ip协议
- 解释二：如果按照网络五层架构，TCP/IP代表除了应用层其他层所有协议簇的统称

TCP/IP connect: TCP/IP的三次握手:
```
          标有syn的数据包
          ------------->
          标有syn/ack的数据包
  client  <-------------  server
          标有ack的数据包
          -------------->
```

##### TCP 三次握手的流程
```
1. 客户端发送一个 SYN 标志位置 1 的包，指明客户端要连接服务器端的接口，发送完毕后，客户端进入 SYN_SEND 状态
2. 服务器发回确认包 (ACK) 应答。即 SYN 标志位和 ACK 标志位均为1。服务器端选择自己 ISN 序列号，放到 Seq 域里，同时将确认序号(Acknowledgement Number)设置为客户的 ISN 加1，即X+1。 发送完毕后，服务器端进入 SYN_RCVD 状态。
3. 客户端再次发送确认包(ACK)，SYN 标志位为0，ACK 标志位为1，并且把服务器发来 ACK 的序号字段+1，放在确定字段中发送给对方，并且在数据段放写ISN的+1

发送完毕后，客户端进入 ESTABLISHED 状态，当服务器端接收到这个包时，也进入 ESTABLISHED 状态，TCP 握手结束。
```

TCP/IP finish: TCP/IP的四次握手:
```
                          fin
                    <-------------
                          ack
client(或server)    -------------> server(或client)
                          fin
                    ------------->
                          ack
                    <-------------
```

### HTTP 报文

HTTP 报文由三部分组成:
- Start Line
- Headers
- Entity Body

HTTP 报文分为两类:
- 请求报文
- 响应报文

#### 请求报文Start Line

语法 : <方法> <请求URL> <版本>

#### HTTP Method

+ get: 获取资源，不携带http body,支持查询参数，大小2KB
+ post: 传输资源，http body, 大小默认8M，1000个input variable
+ put: 传输资源，http body，资源更新
+ delete: 删除资源,不携带http body
+ patch: 传输资源，http body，存在的资源局部更新
+ head: 获取http header,不携带http body
+ options: 获取支持的method,不携带http body
+ trace: 追踪，返回请求回环信息,不携带http body
+ connect: 建立隧道通信

### 响应报文Start Line

语法 : <方法> <状态码> <原因短语>

#### HTTP Status Code

+ 200: ok
+ 301: 永久重定向
+ 302: 临时重定向
+ 303: 临时重定向，要求用get请求资源
+ 304: not modified, 返回缓存，和重定向无关
+ 307: 临时重定向,严格不从post到get
+ 400: 参数错误
+ 401: 未通过http认证
+ 403: forbidden，未授权
+ 404: not found，不存在资源
+ 500: internet server error，代码错误
+ 502: bad gateway，fastcgi返回的内容web server不明白
+ 503: service unavailable，服务不可用
+ 504: gateway timeout，fastcgi响应超时

### HTTP Header Fields

常见通用头部

+ Cache-Control:
  - no-cache: 不缓存过期的缓存
  - no-store: 不缓存
+ Pragma: no-cache, 不使用缓存，http1.1前的历史字段
+ Connection: 
  - 控制不在转发给代理首部不字段
  - Keep-Alive/Close: 持久连接
+ Date: 创建http报文的日期 

常见请求头

+ Accept: 可以处理的媒体类型和优先级 
+ Host: 目标主机域名
+ Referer: 请求从哪发起的原始资源URI
+ User-Agent: 创建请求的用户代理名称
+ Cookie: cookie信息  

常见响应头

+ Location: 重定向地址
+ Server: 被请求的服务web server的信息
+ Set-Cookie: 要设置的cookie信息
  - NAME: 要设置的键值对
  - expires: cookie过期时间
  - path: 指定发送cookie的目录
  - domain: 指定发送cookie的域名
  - Secure: 指定之后只有https下才发送cookie
  - HostOnly: 指定之后javascript无法读取cookie
+ Keep-Alive: 

HTTP协议初期每次连接结束后都会断开TCP连接，之后HEADER的connection字段定义Keep-Alive（HTTP 1.1 默认　持久连接），代表如果连接双方如果没有一方主动断开都不会断开TCP连接，减少了每次建立HTTP连接时进行TCP连接的消耗。

### Cookie/Session

+ Cookie: 工作机制是用户识别和状态管理，服务端为了管理用户的状态会通过客户端，把一些临时的数据写入到设备中Set-Cookie，当用户访问服务的时候，服务可以通过通信的方式取回之前存放的cookie。
+ Session:　由于http是无状态的，请求之间无法维系上下文，所以就出现了session作为会话控制，服务端存放用户的会话信息。

### HTTPs

概念:在http协议上增加了ssl(secure socket layer)层。

```
    SSL层
      |
    应用层
      |
    传输层
      |
    网络层
      |
    链路层
      |
    实体层
```

HTTPS 认证流程
```

                              发起请求
                     --------------------------->　　server 
                              下发证书
                      <---------------------------   server 
                      证书数字签名(用证书机构公钥加密)
                     --------------------------->　　证书机构 
                          证书数字签名验证通过
client(内置证书机构证书) <---------------------------   证书机构
                      公钥加密随机密码串(未来的共享秘钥)
                     --------------------------->　　server私钥解密(非对称加密)
                        SSL协议结束　HTTP协议开始
                      <---------------------------   server(对称加密)
                            共享秘钥加密 HTTP
                     --------------------------->　　server(对称加密)
```

+ 核对证书证书： 证书机构的公开秘钥验证证书的数字签名
+ 公开密钥加密建立连接：非对称加密
+ 共享密钥加密

##### 什么是 HTTPS？实现过程是什么？ 

> HTTPS（超文本传输安全协议）是一种通过计算机网络进行安全通信的传输协议，提供对网站服务器的身份认证，保护数据传输的完整性、安全性。
> 
> 实现过程：
> 1. 客户端发起一个 https 的请求
> 2. 服务端接收客户端请求，返回数字证书相关信息
> 3. 客户端收到服务端响应
>    1. 验证证书的合法性  
>    2. 如果证书受信任，生成随机数的密码
>    3. 使用约定好的 HASH 算法计算握手消息，并使用生成的随机数对消息进行加密，然后发送给服务端
> 4. 网站接收浏览器发来的密文后
>    1. 使用私钥来解密握手消息取出随机数密码，再用随机数密码解密，握手消息与 HASH 值，并与传过来的HASH值做对比确认是否一致
>    2. 使用密码加密一段握手消息，发送给浏览器
> 5. 浏览器解密并计算握手消息的 HASH，如果与服务端发来的 HASH 一致，此时握手过程结束，之后所有的通信数据，将由之前浏览器生成的随机密码，并利用对称加密算法进行加密。

[HTTPS实现流程图](http://img.blog.csdn.net/20130924102812796)


##### 数字证书都包含那些信息？

> - 证书的版本信息；
> - 证书的序列号，每个证书都有一个唯一的证书序列号；
> - 证书所使用的签名算法；
> - 证书的发行机构名称；
> - 证书的有效期；
> - 证书所有人的名称、公开密钥；
> - 证书发行者对证书的签名


### Websocket

+ 基于http协议建立连接，header的upgrade字段转化协议为websocket
+ 全双工通信，客户端建立连接

##### 什么是 Socket？工作流程是怎样的？

> Socket 又称网络套接字，是一种操作系统提供的进程间通信机制。
> 
> 工作流程：
> 
> 1. 服务端先用 socket 函数来建立一个套接字，并调用 listen 函数，使服务端的这个端口和 IP 处于监听状态，等待客户端的连接
> 2. 客户端用 socket 函数建立一个套接字，设定远程 IP 和端口，并调用 connect 函数
> 3. 服务端用 accept 函数来接受远程计算机的连接，建立起与客户端之间的通信
> 4. 完成通信以后，最后使用 close 函数关闭 socket 连接。

##### HTTP1.1 与 WebSocket 的区别？

> - HTTP 是一个单链接，只能做单向通讯，而 WebSocket 是一个持久链接，可用作双向通讯。
> - WebSocket 是基于 HTTP 来建立连接的，但在建立连接之后，真正的数据传输阶段是不需要 HTTP 协议参与的
> - WebSocket 的请求的头部和 HTTP 请求头部不同
> - WebSocket 传输的数据是二进制流，是以帧为单位，HTTP 是明文字符串传输

### HTTP2

+ 多路复用：多个请求共享一个tcp连接
+ 全双工通信
+ 必须https://
+ 头部压缩
+ 二进制传输


##### 什么是 OAuth2.0 协议？运行流程是怎样的？
```
OAuth(Open Authorization) 协议为用户资源的授权提供了一个安全的、开放而又简易的标准，第三方无需使用用户的用户名与密码，就可以申请获得该用户资源的授权。

运行流程：

1. 用户打开客户端以后，客户端要求用户给予授权。
2. 用户同意给予客户端授权
3. 客户端使用上一步获得的授权，向认证服务器申请令牌。
4. 认证服务器对客户端进行认证以后，确认无误，同意发放令牌。
5. 客户端使用令牌，向资源服务器申请获取资源。
6. 资源服务器确认令牌无误，同意向客户端开放资源
```
OAuth 2.0 定义了四种授权方式，授权码模式、简化模式、密码模式、客户端模式，具体的授权流程，请看阮一峰老师的文章[理解OAuth 2.0](http://www.ruanyifeng.com/blog/2014/05/oauth_2_0.html)。

#### 扩展阅读

- [https 原理](http://blog.csdn.net/clh604/article/details/22179907)
- [HTTPS 原理解析](https://juejin.im/entry/59f1b593f265da430b7a7898)
- [HTTPS 的工作原理](https://www.cnblogs.com/ttltry-air/archive/2012/08/20/2647898.html)
- [socket](https://baike.baidu.com/item/socket/281150)
- [HTTP与WebSocket的区别](http://blog.csdn.net/baiye_xing/article/details/73938360)
- [理解OAuth 2.0](http://www.ruanyifeng.com/blog/2014/05/oauth_2_0.html)