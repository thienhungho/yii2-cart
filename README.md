Yii2 Cart System
====================
Cart System for Yii2

Installation
------------

This is just an example, memorible moment. The source code may not work for known reasons. This source code include against loss license feature.

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist thienhungho/yii2-cart "*"
```

or add

```
"thienhungho/yii2-cart": "*"
```

to the require section of your `composer.json` file.

### Migration

Run the following command in Terminal for database migration:

```
yii migrate/up --migrationPath=@vendor/thienhungho/Cart/migrations
```

Or use the [namespaced migration](http://www.yiiframework.com/doc-2.0/guide-db-migrations.html#namespaced-migrations) (requires at least Yii 2.0.10):

```php
// Add namespace to console config:
'controllerMap' => [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationNamespaces' => [
            'thienhungho\Cart\migrations\namespaced',
        ],
    ],
],
```

Then run:
```
yii migrate/up
```

Modules
------------

[CartBase](https://github.com/thienhungho/yii2-cart/tree/master/src/modules/CartBase)

Functions
------------

[Core](https://github.com/thienhungho/yii2-cart/tree/master/src/functions/core.php)

Constant
------------

[Core](https://github.com/thienhungho/yii2-cart/tree/master/src/const/core.php)
