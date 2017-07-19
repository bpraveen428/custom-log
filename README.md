# custom-log

> Create custom folder structure for the log files 

## Installation

Begin by installing this package through Composer.

```js
{
    "require": {
		"praveen/customlog": "~0.0.4"
	}
}
```
### Laravel Users

If you are a Laravel user, there is a service provider you can make use of to automatically prepare the bindings and such.

```php

// app/config/app.php

'providers' => [
    Praveen\Customlog\CustomLogger::class,
];
```