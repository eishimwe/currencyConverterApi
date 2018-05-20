## Installation
### Step 1
In the root directory of the cloned project run.

```bash
$ composer install
```

### Step 2
Update/Add below settings in your .env file 
```php
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
QUEUE_DRIVER=database
GUZZLE_API_KEY=your_apilayer_key
GUZZLE_API_URL=http://apilayer.net/api/live
```


### Step 3
In the root directory of the cloned project.

```bash
$ php artisan migrate --seed
```

### Step 4
In the root directory of the cloned project.

```bash
$ php artisan serve
```

### Step 5
In the root directory of the cloned project.Use Different Terminal Session

```bash
$ php artisan queue:listen
```