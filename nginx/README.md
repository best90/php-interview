### Nginx配置

[nginx配置文件说明](./conf.md)

#### 状态码配置和错误文件

注意error_page配置时加=和不加=的区别, 加了=表示响应为指定的http status code, 默认为200, 不加=为原错误的状态码~
```
# 这样可以访问错误页面时 http status 为404, 并且页面内容是404.html的内容
error_page 404 /404.html
error_page 404 500 /404.html;

# 这样配置访问错误页面时 http status 为200, 但页面内容是404.html的内容
error_page 404 500 = /404.html;

# 这样配置访问错误页面时 http status 为404, 但页面内容是404.html的内容
error_page 404 500 =404 /404.html;

# 也可以把404请求直接301到某个域上
error_page 404 =301 https://abc.com/404;
```

#### 主域301重定向
```
server {
    # 设置多个域名
    server_name www.abc.com abc.com;

    # 判断host是不是abc.com，如果不是则直接301重定向，permanent表示301
    if ( $host != 'abc.com' ){
        rewrite ^/(.*)$ http://www.abc.com/$1 permanent;
    }
}
```

#### 配置反向代理
```
# 配置 www.abc.com的8001代码
server {
    server_name www.abc.com;
    listen 80;

    # 设置这个网站的根目录
    root /wwwroot/www.abc.com/;

    # 由于下面配置了文件不存在则代码到nodejs中，那么直接访问目录（不带默认主页）的话会有问题，这里做下判断
    # 如果访问目录下有index.html文件，则直接重写到该文件
    # break表示重写且停止，但url不变，而permanent表示301重定向，url会更新
    if ( -f $request_filename/index.html ){
        rewrite (.*) $1/index.html break;
    }

    # 如果请求的文件不存在，则代理到node
    if ( !-f $request_filename ){
        rewrite (.*) /index.js;
    }

    # 代理node服务 8001
    location = /index.js {
        # 设置一些代理的header信息，这些信息将被透传到nodejs服务的header信息里
        proxy_set_header Connection "";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header Host $http_host;
        proxy_set_header X-Nginx-Proxy true;

        # 代理服务
        proxy_pass http://127.0.0.1:8001$request_uri;

        # 忽略其他重写
        proxy_redirect off;
    }
}
```
#### 配置https
```
# 配置https

# 配置个http的站点，用来做重定向，当然如果你不需要把http->https可以把这个配置删了
server {
    listen       80;
    # 配置域名
    server_name www.abc.com abc.com;

    # 添加STS, 并让所有子域支持, 开启需慎重
    add_header strict-transport-security 'max-age=31536000; includeSubDomains; preload';

    # 配置让这些http的访问全部301重定向到https的
    rewrite ^(.*) https://www.abc.com$1 permanent;
}

# 配置https
server {
    # 配置域名
    server_name www.abc.com abc.com;

    # https默认端口
    listen 443;

    # 添加STS, 并让所有子域支持, 开启需慎重
    add_header strict-transport-security 'max-age=31536000; includeSubDomains; preload';

    # https配置
    ssl on;
    ssl_certificate /abc/www.abc.com.crt;
    ssl_certificate_key /abc/www.abc.com.key;

    # 其他按正常配置处理即可...
}
```

#### 配置图片防盗链
valid_referers none | blocked | server_names | string

- none: 表示没有来路
- blocked: 表示有来路
- server_names: 来路里包含当前域名
- string（忽略端口）
    + 如果是字符串：一个域名验证的规则，*表示通配符
    + 如果是以~开头：正则表达式，排除https://或http://开头的字符串
以上参数可以叠加一起使用
```
server {

    # 配置所有图片
    location ~* \.(gif|jpg|png|bmp)$ {
        # 验证可以是没有来路、或者有来路时来路匹配abc.com、或者匹配当前域名
        valid_referers none blocked *.abc.com server_names;

        # 如果验证不通过则返回403
        if ($invalid_referer) {
            return 403;
        }
    }
}
```
#### 配置 nginx CORS 跨域
```
server {
    location / {
        add_header 'Access-Control-Allow-Origin' '*';
        add_header 'Access-Control-Request-Method' 'GET';
    }
}


server {
    location / {
        # 请求白名单
        if ($http_origin ~* (baidu\.com|github.com)$) {
            add_header 'Access-Control-Allow-Origin' '$http_origin';

            # 允许cookie
            add_header 'Access-Control-Allow-Credentials' true;

            # 只允许某些方法
            add_header 'Access-Control-Request-Method' 'GET, POST, OPTIONS';

            # 支持获取其她字段, 需要前端设置 `xhr.withCredentials = true`
            add_header 'Access-Control-Allow-Headers' 'User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type';
        }
        
        # 使用判断请求文件来添加iconfont字体跨域
        if ($document_uri ~ \.(eot|otf|ttf|woff|svg)$) {
            add_header Access-Control-Allow-Origin *;
        }
    }
}
```
#### 配置浏览器缓存
```
server {
    # 设置为1月
    set $expires_time           1M;

    # 针对后台不缓存
    if ($request_uri ~* ^/admin(\/.*)?$) {
        set $expires_time       -1;
    }

    # 针对静态文件缓存最大
    if ($request_uri ~* ^/static(\/.*)?$) {
        set $expires_time       max;
    }

    # 设置吧
    expires $expires_time;
}
```
#### 配置https资源代理
```
server {
    # 全部代理
    location ~ ^/(.*)$ {
        proxy_connect_timeout    10s;
        proxy_read_timeout       10s;

        proxy_set_header Connection "";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header Host $http_host;
        proxy_set_header X-NginX-Proxy true;

        # 代理
        proxy_pass               http://$1;
    }
}
```

#### 配置nginx前置缓存
```
http {
    # 定义缓存名称、目录、类型
    proxy_cache_path    /home/proxy/cache levels=1:2 keys_zone=nginx_cache:100m inactive=30d max_size=1g;
    proxy_temp_path     /home/proxy/temp;
    proxy_cache_key     $host$uri$is_args$args;   

    server {
        # 定义缓存的规则
        location ~ ^/(static|upload)\/(.*)$ {
            proxy_connect_timeout    10s;
            proxy_read_timeout       10s;
            proxy_cache              nginx_cache;
            proxy_cache_valid        200 30d;
            proxy_cache_lock         on;
            proxy_cache_lock_timeout 5s;
            proxy_cache_use_stale    updating error timeout invalid_header http_500 http_502;

            # 添加缓存的标识到header头
            add_header               X-Cache "$upstream_cache_status from cache.xuexb";

            expires                  1d;
            proxy_set_header Connection "";
            proxy_set_header X-Real-IP $remote_addr;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            proxy_set_header Host $http_host;
            proxy_set_header X-NginX-Proxy true;

            # 目标机器
            proxy_pass  http://blog;
        }
    }
}
```
#### nginx负载均衡
```
http {
    upstream blog {
        server 127.0.0.1:8003;
        server 127.0.0.2:8080 weight=3;
    }

    server {
        server_name www.abc.com abc.com;
        listen 80;

        location / {
            proxy_set_header Connection "";
            proxy_set_header X-Real-IP $remote_addr;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            proxy_set_header Host $http_host;
            proxy_set_header X-NginX-Proxy true;
            proxy_pass  http://blog.abc.com;
        }
        access_log off;
    }
}
```

#### nginx其他配置

```
# 此指令设置NGINX能处理的最大请求主体大小。 如果请求大于指定的大小，则NGINX发回HTTP 413（Request Entity too large）错误。 如果服务器处理大文件上传，则该指令非常重要。
client_max_body_size 10M
```
##### 配合修改php.ini 参数 upload_max_filesize = 8M;post_max_size = 16M;