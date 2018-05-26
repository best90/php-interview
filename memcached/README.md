### Memcached
Memcached是一个自由开源的，高性能，分布式内存对象缓存系统。
Memcached是一种基于内存的key-value存储，用来存储小块的任意数据（字符串、对象）

特点：
- 协议简单
- 基于libevent的事件处理
- 内置内存存储方式
- memcached不互相通信的分布式

#### Memcached 存储命令


set 命令用于将 value(数据值) 存储在指定的 key(键) 中
```
set key flags exptime bytes [noreply] 
```

add 命令用于将 value(数据值) 存储在指定的 key(键) 中
```
add key flags exptime bytes [noreply]
```

replace 命令用于替换已存在的 key(键) 的 value(数据值)
```
replace key flags exptime bytes [noreply]
```

append 命令用于向已存在 key(键) 的 value(数据值) 后面追加数据
```
append key flags exptime bytes [noreply]
```

prepend 命令用于向已存在 key(键) 的 value(数据值) 前面追加数据
```
prepend key flags exptime bytes [noreply]
```

CAS（Check-And-Set 或 Compare-And-Swap） 命令用于执行一个"检查并设置"的操作
它仅在当前客户端最后一次取值后，该key 对应的值没有被其他客户端修改的情况下， 才能够将值写入
```  
   cas key flags exptime bytes unique_cas_token [noreply]
```

#### Memcached 查找命令

get 命令获取存储在 key(键) 中的 value(数据值) ，如果 key 不存在，则返回空
```
get key1 key2 key3
```

gets 命令获取带有 CAS 令牌存 的 value(数据值) ，如果 key 不存在，则返回空
```
gets key
```

delete 命令用于删除已存在的 key(键)
```
delete key [noreply]
```
incr 与 decr 命令用于对已存在的 key(键) 的数字值进行自增或自减操作
```
incr key increment_value
```

#### Memcached 统计命令

stats 命令用于返回统计信息例如 PID(进程号)、版本号、连接数等

stats items 命令用于显示各个 slab 中 item 的数目和存储时长(最后一次访问距离现在的秒数)

stats slabs 命令用于显示各个slab的信息，包括chunk的大小、数目、使用情况等

stats sizes 命令用于显示所有item的大小和个数

flush_all 命令用于清理缓存中的所有 key=>value(键=>值) 对