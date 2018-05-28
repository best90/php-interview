### MongoDB

它的特点是高性能、易部署、易使用，存储数据非常方便。主要功能特性有：

* 模式自由。

* 支持动态查询。

* 支持完全索引，包含内部对象。

* 支持查询。

* 支持复制和故障恢复。

* 使用高效的二进制数据存储，包括大型对象（如视频等）。

* 自动处理碎片，以支持云计算层次的扩展性。

* 支持RUBY，PYTHON，JAVA，C++，PHP，C#等多种语言。

* 文件存储格式为BSON（一种JSON的扩展）。

* 可通过网络访问。

  

MongoDB主要场景：

1）网站实时数据处理。它非常适合实时的插入、更新与查询，并具备网站实时数据存储所需的复制及高度伸缩性。

2）缓存。由于性能很高，它适合作为信息基础设施的缓存层。在系统重启之后，由它搭建的持久化缓存层可以避免下层的数据源过载。

3）高伸缩性的场景。非常适合由数十或数百台服务器组成的数据库，它的路线图中已经包含对MapReduce引擎的内置支持。

不适用的场景如下：1）要求高度事务性的系统。

2）传统的商业智能应用。

3）复杂的跨文档（表）级联查询。

| SQL术语/概念 | MongoDB术语/概念 | 解释/说明                           |
| ------------ | ---------------- | ----------------------------------- |
| database     | database         | 数据库                              |
| table        | collection       | 数据库表/集合                       |
| row          | document         | 数据记录行/文档                     |
| column       | field            | 数据字段/域                         |
| index        | index            | 索引                                |
| table joins  |                  | 表连接,MongoDB不支持                |
| primary key  | primary key      | 主键,MongoDB自动将_id字段设置为主键 |

MongoDB 创建数据库 

```
use DATABASE_NAME
```

MongoDB 删除数据库

```
db.dropDatabase()
```

MongoDB 中使用 **createCollection()** 方法来创建集合。

```
db.createCollection(name, options)
```

MongoDB 中使用 drop() 方法来删除集合。

```
db.collection.drop()
```

MongoDB 使用 insert() 或 save() 方法向集合中插入文档

```
db.COLLECTION_NAME.insert(document)
```

update() 方法用于更新已存在的文档

```
db.collection.update(
   <query>,
   <update>,
   {
     upsert: <boolean>,
     multi: <boolean>,
     writeConcern: <document>
   }
)
```

save() 方法通过传入的文档来替换已有文档

```
db.collection.save(
   <document>,
   {
     writeConcern: <document>
   }
)
```

remove() 方法

```
db.collection.remove(
   <query>,
   <justOne>
)
```

MongoDB 查询数据

```
db.collection.find(query, projection)

db.COLLECTION_NAME.find().limit(NUMBER)
```

skip()方法来跳过指定数量的数据，skip方法同样接受一个数字参数作为跳过的记录条数 

```
db.COLLECTION_NAME.find().limit(NUMBER).skip(NUMBER)
```

ensureIndex() 方法中你也可以设置使用多个字段创建索引（关系型数据库中称作复合索引） 

```
db.COLLECTION_NAME.ensureIndex({KEY:1})
```

aggregate主要用于处理数据(诸如统计平均值,求和等)，并返回计算后的数据结果。有点类似sql语句中的 count(*) 

```
db.COLLECTION_NAME.aggregate(AGGREGATE_OPERATION)
```

要排序MongoDB中的文档，需要使用 sort()方法。 sort() 方法接受一个包含字段列表以及排序顺序的文档。 要使用1和-1指定排序顺序。1用于升序，而-1是用于降序。 

```
db.COLLECTION_NAME.find().sort({KEY:1})
```

#### MongoDB复制的工作原理

MongoDB通过使用副本集的复制来实现。副本集是一组承载同一个数据集的mongod实例。在副本的一个节点是接收所有的写操作主节点。所有的实例，次级，应用操作从主以便它们具有相同的数据集。副本集只能有一个主节点。

1. 副本集是一组两个或更多个节点（通常至少3节点是必需的）。
2. 在副本集一个节点是主节点和其余的节点都是次要的。
3. 所有的数据复制是从主到次节点。
4. 在自动故障转移或维护时，选建立了主要和一个新的主节点被选择。
5. 故障节点的恢复后，再次加入副本集，并可以作为一个辅助节点。