#### Zval的基本结构
```
struct _zval_struct {
    zvalue_value value;     /* value */
    zend_uint refcount__gc;  /* variable ref count */
    zend_uchar type;          /* active type */
    zend_uchar is_ref__gc;    /* if it is a ref variable */
};
typedef struct _zval_struct zval;
```
- zval_value value
变量的实际值，具体来说是一个zvalue_value的联合体（union）
```
typedef union _zvalue_value {
    long lval;                  /* long value */
    double dval;                /* double value */
    struct {                    /* string */
        char *val;
        int len;
    } str;
    HashTable *ht;              /* hash table value,used for array */
    zend_object_value obj;      /* object */
} zvalue_value;
```
- zend_uint refcount__gc  
该值实际上是一个计数器，用来保存有多少变量。在变量生成时，其refcount=1，典型的赋值操作如$a = $b会令zval的refcount加1，而unset操作会相应的减1。

- zend_uchar type
该字段用于表明变量的实际类型。
```
#define IS_NULL     0
#define IS_LONG     1
#define IS_DOUBLE   2
#define IS_BOOL     3
#define IS_ARRAY    4
#define IS_OBJECT   5
#define IS_STRING   6
#define IS_RESOURCE 7
#define IS_CONSTANT 8
#define IS_CONSTANT_ARRAY   9
#define IS_CALLABLE 10
```

- is_ref__gc
这个字段用于标记变量是否是引用变量。对于普通的变量，该值为0，而对于引用型的变量，该值为1。这个变量会影响zval的共享、分离等。

创建变量时，会创建一个zval。
变量赋值给另外一个变量时，会增加zval的refcount值。
使用unset时，对减少相应zval的refcount值。
数组变量与普通变量生成的zval非常类似，但也有很大不同。（与标量这些普通变量不同，数组和对象这类复合型的变量在生成zval时，会为每个item项生成一个zval容器。）

从数组中移除元素时，会从符号表中删除相应的符号，同时减少对应zval的refcount值。同样，如果zval的refcount值减少到0，那么就会从内存中删除该zval。

引用的出现，会令zval的规则变得复杂
Unset之后，虽然没有变量指向该zval，但是该zval却不能被GC（指PHP5.3之前的单纯引用计数机制的GC）清理掉，因为zval的refcount均大于0。这样，这些zval实际上会一直存在内存中，直到请求结束（参考SAPI的生命周期）。在此之前，这些zval占据的内存不能被使用，便白白浪费了，换句话说，无法释放的内存导致了内存泄露。
如果这种内存泄露仅仅发生了一次或者少数几次，倒也还好，但如果是成千上万次的内存泄露，便是很大的问题了。尤其在长时间运行的脚本中（例如守护程序，一直在后台执行不会中断），由于无法回收内存，最终会导致系统“再无内存可用”。

 zval分离（Copy on write和change on write）
 一个共享的zval，需要将该zval分离出去，以保证单独变化互不影响，这种机制叫做COW –Copy on write。在很多场景下，COW都是一种比较高效的策略。
