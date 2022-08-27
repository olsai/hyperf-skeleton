> 基于hyperf 框架封装的骨架

# 谈谈项目分层架构

>  如果不想看的 直接调到下面 看使用方法

回顾我开发历史，我经历了几种项目分层

## v1.0 controller -> model -> view (mvc)

>  那个时候前端是jquery + boostrap  的天下，也是后端去写前端头秃的时候，拿到前端同事写好的页面，然后后端自己去填页面数据或者通过ajax 去渲染数据， 然而页面往往还需要前端再来几次调整。
>
> 那个时候除了公司定义的代码规范还会要求“胖模型瘦控制器”。
>
> 当然诟病太多了我就不吐槽了，但是最少有2点可以赞扬的， 页面缓存 和  seo

## v2.0  controller -> service -> model

> 前后端饱受混编折磨，后面就分化出 前端使用 ajax 来对接页面数据，这样各司其职，后端就安安心心的出接口。
>
> msc 和 mvc 差不多， 只是吧 view 换成了 service ，把业务逻辑放到服务去做了

### v2.1 controller -> serviceInterface -> serviceImpl -> model

>这个变异版的原因， 项目负责人是java 转到php 的，把java 一些思想带过来，所以整的不伦不类的
>
>这个版本，美名其曰 面向接口开发。说实话 还不如 msc 写着简单

### 2.2 controller -> service -> dao -> model

> 随着项目业务复杂度起来，mysql 不能满足需求，加入了 es, mongdb其他数据库类型，dao层 也是参照java而来， 做了一层数据驱动接口



上述2版本依然还是存在毒瘤

- 单体应用，多端服务的时候，在共同使用 service层后， 各种兼容
- service 各种依赖注入， 蜘蛛网满天飞，还会出现死循环
- 接口文档 只有请求参数 大部分没有返回参数

当然也人有说，你给每个端各写一个service，不就行了，自己控制业务逻辑就可以避免出现死循环，接口文档可以手动写。马后炮，这是我经历的痛

##  3.0 controller -> logic -> service-> dao-> model

> 当前这个骨架就是基于此分层，多服务 多数据库类型。
>
> logic 层 为 每个应用的 独立业务逻辑层
>
> service 层，为公共服务层，serviceInterface 是为了定义rpc
>
> 同时定义  请求实体 和 返回实体
>
> 请求实体是为了验证请求字段，同时过滤 不是请求实体的属性字典
>
> 返回实体 是为了实现接口文档返回数据， 同时自动翻译字典数据
>
> ------------------
>
> 这个版本好是好，就是创建文件有点多 10几个文件，如果不使用模版生成，能把人写的崩溃



接口 我也经历了几个版本

- get，post
- restful api接口规范
- 万能 post

当前这个骨架 就是用 万能post，  如果不喜欢 或者不习惯，通过代码生成后， 去控制把请求方式修改一下就行了， 对吧。



# 如何使用

## 安装

```php
composer create-project hashwallet/hyperf-skeleton:3.1.x-dev demo
```
> 当前这个骨架 是 hyperf 3.0 版本， php8

## 代码生成器命令

```php
php bin/hyperf.php gen:code
```

> 1，代码生成器是基于数据库表来实现的， 所以执行此命名之前，先确认一下 数据库 是否创建了表。如果想使用我二次封装的model,在表里面需要  添加至少 3个字段
>
> - enable  是否能使用（类似软删字段）默认为1
> - create_at  创建时间戳，默认为0
> - update_at 更新时间戳，默认为0
>
> 2，生成器配置文件在 `config/autoload/generate.php` 
>
> ```php
> return [
>     // 定义应用端
>     'applications' => [
>         'app',
>         'platform',
>     ],
>     // 是否通过 表名（下划线分割）来生成 ddd 目录结构， 
>     'for_table_ddd' => false,
>     // 模块，定义模块顺序
>     'modules' => [],
> ];
> ```
>
> 3，`php bin/hyperf.php gen:code --help` 查看命令参数
>
> 4，会自动生成curd 代码，同时会生成一个常量访问接口

## 目录结构

### 普通目录

| 目录名称                | 说明                                                   |
| ----------------------- | ------------------------------------------------------ |
| Common                  | 骨架自带的公共类                                       |
| Constants               | 静态枚举类目录，建议再创建Status,Enums,Types三个子目录 |
| Constants/Errors        | 自定义错误码目录                                       |
| Controller              | 接口控制器目录                                         |
| Entity                  | 请求和返回实体                                         |
| Infrastructure          | 服务接口，可对外暴露提供RPC接口，实现微服务调用        |
| Logic                   | 逻辑层目录，业务代码在此编写                           |
| Repository              | 仓库                                                   |
| Repository\Dao\Contract | DAO接口定义                                            |
| Repository\Dao\MySQL    | DAO的MySQL访问实现                                     |
| Repository\Model        | mysql model                                            |
| Service                 | 公共服务， 可对外暴露提供RPC接口，实现微服务调用       |

### DDD 目录结构

| 目录名称                     | 说明                                                   |
| ---------------------------- | ------------------------------------------------------ |
| Common                       | 骨架自带的公共类                                       |
| Infrastructure               | 服务接口，可对外暴露提供RPC接口，实现微服务调用        |
| 领域/Application             | 接口控制器目录                                         |
| 领域/Constants               | 静态枚举类目录，建议再创建Status,Enums,Types三个子目录 |
| 领域/Constants/Errors        | 自定义错误码目录                                       |
| 领域/Entity                  | 请求和返回实体                                         |
| 领域/Logic                   | 逻辑层目录，业务代码在此编写                           |
| 领域/Repository              | 仓库                                                   |
| 领域/Repository\Dao\Contract | DAO接口定义                                            |
| 领域/Repository\Dao\MySQL    | DAO的MySQL访问实现                                     |
| 领域/Repository\Model        | mysql model                                            |
| 领域/Service                 | 公共服务， 可对外暴露提供RPC接口，实现微服务调用       |

## 自定义错误字典合并

```php 
composer error
```

## 项目启动

```php
composer start
    
//  会自动启动 swagger 服务，访问http://127.0.0.1:9501/swagger， 如果不需要 可以再 config/autoload/api_docs.php 关闭
```

## 比较常用用法提示

### 1，枚举

> 在没有使用php8.1 的时候官方自带enum，先使用 `marc-mabe/php-enum` 封装的枚举类对象

```php

<?php

declare(strict_types=1);

namespace Lengbin\Hyperf\Common\Constants;

use Lengbin\ErrorCode\AbstractEnum;
use Lengbin\ErrorCode\Annotation\EnumMessage;

/**
 * 基础状态
 * @method static BaseStatus FROZEN()
 * @method static BaseStatus NORMAL()
 */
class BaseStatus extends AbstractEnum
{
    /**
     * @Message("禁用")
     */
    #[EnumMessage("禁用")]
    const FROZEN = 0;

    /**
     * @Message("正常")
     */
    #[EnumMessage("正常")]
    const NORMAL = 1;
}


// 使用
    $status = BaseStatus::NORMAL();
    var_dump($status->getValue()); // 获取数字值
    var_dump($status->getMessage()); // 获取关联信息
// 具体用法 查看 `marc-mabe/php-enum` 库
```

### 2 BaseObject

```php
/**
 * Class SystemHelpItem.
 */
class SystemHelpItem extends BaseObject
{
    #[ApiModelProperty('ID')]
    public int $id;

    #[ApiModelProperty('名称')]
    public string $name;

    #[ApiModelProperty('名称'), Integer]
    public BaseStatus $status;
}

// 使用
$item = new SystemHelpItem([
    'id' => 1,
    'name' => "demo",
    'status' => 1
]);

  var_dump($item->status->getValue()) // 1
  var_dump($item->toArray()); // ['id' => 1,'name' => "demo", 'status' => 1]

```

### 3 自定义注解

```php
use Lengbin\Common\Annotation\EnumView;
use Lengbin\Common\Annotation\ArrayType;

/**
 * Class SystemHelpItem.
 */
class SystemHelpItem extends BaseObject
{
    #[EnumView]
    public BaseStatus $status;
}

// 使用
$item = new SystemHelpItem([
    'status' => 1,
]);

  var_dump($item->toArray()) // ["status" => ["message" => "正常", "value" => 1]]
      
 //   #[ArrayType(type: 'int')]  
 //   public array $item;
 //   等价于
 //   /**
 //    * @var int[]
 //    */
      
 //   #[ArrayType(className: SystemHelpItem::class)]  
 //   public array $item;
 //   等价于
 //   /**
 //    * @var SystemHelpItem[]
 //    */
      
```

简要说明 暂时到这，后面有问题 提issues， 散会
