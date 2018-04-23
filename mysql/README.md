### MySQL常用SQL
一、增
- 创建表
```
CREATE TABLE IF NOT EXISTS `table_name`(
   `id` INT UNSIGNED AUTO_INCREMENT,
   `title` VARCHAR(100) NOT NULL,
   `author` VARCHAR(40) NOT NULL,
   `submission_date` DATE,
   PRIMARY KEY ( `id` )
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
- 插入数据
```
INSERT INTO table_name ( field1, field2,...fieldN )
                       VALUES
                       ( value1, value2,...valueN );
```
- 增加字段
```
ALTER TABLE `table_name`
ADD `column_name` ...
AFTER `column_name`;
```
- 增加索引
    + 主键
    ```
    ALTER TABLE `table_name`
    ADD PRIMARY KEY index_name(column_name);
    ```
    + 唯一索引
    ```
    ALTER TABLE `table_name`
      ADD UNIQUE index_name(column_name);
    ```
    + 普通索引
    ```
    ALTER TABLE `table_name`
      ADD INDEX index_name(column_name)
    ```
    + 全文索引
    ```
    ALTER TABLE `table_name`
      ADD FULLTEXT index_name(column_name)
    ```

二、删
- 删除记录
```
DELETE FROM `table_name`
WHERE column_name = ...
```
- 清空表
```
TRUNCATE TABLE `table_name`
```
- 删除表
```
DROP TABLE `table_name`
```
- 删除字段
```
ALTER TABLE `table_name`
DROP column_name
```
- 删除索引
```
ALTER TABLE `table_name`
DROP INDEX index_name(column_name)
```
三、改
- 修改记录
```
UPDATE `table_name` SET column_name = value
    WHERE column_name = ...
```
- 变更字段
```
ALTER TABLE `table_name`
CHANGE column_name ...
```
- 修改记录为另一表的值
```
UPDATE `your_table_name`
AS a
JOIN `your_anther_table_name`
AS b
SET a.column = b.anther_column
WHERE a.id = b.a_id...;
```

四、查
- 普通查询
```
SELECT `column_name_one`, `column_name_two` FROM `table_name`
WHERE column_name = ...
```
- 关联查询 join/left join/right join
```
SELECT *
FROM `table_name`
AS a
JOIN `anther_table_name`
AS b
WHERE a.column_name = b.column_name...;
```
- 合计函数条件查询：WHERE 关键字无法与合计函数一起使用
```
SELECT aggregate_function(column_name)
FROM your_table_name
GROUP BY column_name
HAVING aggregate_function(column_name)...;
```
- 复制表结构
```
CREATE TABLE `table_name`
LIKE `destination_table_name`;
```
- 完全复制一张表：表结构+全部数据
```
CREATE TABLE `table_name`
LIKE `destination_table_name`;

INSERT INTO `table_name`
SELECT *
FROM `destination_table_name`;
```

五、其他
- 连接
```
mysql -h host -u username -p
```
- 导入
```
source file.sql
```
- 导出
```
mysqldump -h 127.0.0.1 -u root -p "database_name" "table_name" --where="condition" > file_name.sql
```
- 慢日志
```
mysqldumpslow -s [c:按记录次数排序/t:时间/l:锁定时间/r:返回的记录数] -t [n:前n条数据] -g "正则"　/path
```
- 分析查询:通过这个查询可以分析查询语句的索引使用情况
```
explain select * from xxx where id = xxx
```
