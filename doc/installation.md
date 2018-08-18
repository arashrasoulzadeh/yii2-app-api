
### INSTALLATION

**Install via Composer**

If you do not have [Composer](http://getcomposer.org/), you may install it by following the
[instructions at getcomposer.org](https://getcomposer.org/doc/00-intro.md).

You can then install the application using the following commands:

```
composer global require "fxp/composer-asset-plugin:~1.0.0"
composer create-project --prefer-dist -s dev "aminkt/yii2-app-api" .
```

### GETTING STARTED

After you install the application, you have to conduct the following steps to initialize the installed application.
You only need to do these once for all.

- Cd to `core` directory and Run command `php init --env=Development` to initialize the application with a specific environment.
- Create a new database and adjust the `components['db']` configuration in `core/common/config/main-local.php` accordingly.
- Apply migrations with console command ``php yii migrate`` in `core` directory. This will create tables needed for the application to work.
- Set document roots of your Web server:

for rest `/path/to/yii-application/` and using the URL `http://localhost/`

Use `demo/demo` to login into the application on [http://localhost/v1/user/login](http://localhost/v1/user/login). See 
[`/core/rest/config/url-rules.php`](/core/rest/config/url-rules.php) for more info by URL

### URL RULE

See [/core/rest/config/url-rules.php](/core/rest/config/url-rules.php)

API available:

```php
// version 1
OPTIONS /index.php?r=v1/user/login
POST /index.php?r=v1/user/login
```

You can hide `index.php` from URL. For that see [server.md](server.md)