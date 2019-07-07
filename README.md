# Hướng dẫn làm web tin tức bằng PHP/Laravel
[Video hướng dẫn](https://www.youtube.com/watch?v=KlKJNLweHx8&list=PLnJJBmKEuhNkpZ6rFUhDAmcV9_nKENO47&index=2)

[Create and using models](https://laravel.com/docs/5.8/eloquent)

Tài liệu download =>> File laravelDemo.rar

| Command line                      | Description                  |
| :-------------------------------- | :--------------------------- |
| laravel new blog                  | create project laravel blog  |
| php artisan serve                 | run sever php                |
| php artisan make:model model_name | create model call model_name |

## Step 1: Create Database and Config file
1.1 Create database on phpMyAdmin http://localhost/phpmyadmin/
    
- Name: laravel_demo
- Code: utf8_general_ci

1.2 Import data from file __laravel_demo.sql__ from __laravelDemo.rar__

1.3 Config file __.env__
```env
DB_DATABASE=laravel_demo
DB_USERNAME=root
DB_PASSWORD=
```

1.4 Config time_zone __config/app.php__
```php
'timezone' => 'Asia/Ho_Chi_Minh'
```

1.5 Move file __slide and tintuc__ to folder __public__

## Step 2: Create Model

2.1 Generate Modle using artisan
```
# Run on Terminal
php artisan make:model TheLoai
php artisan make:model LoaiTin
php artisan make:model TinTuc
php artisan make:model Comment
php artisan make:model Slide
php artisan make:model TheLoai
```

2.2 Create relationship between models

> File Model in folder __app/name.php__

2.3 Test connection to database

- in __routers/web.php__ create route to check
```php
// Using model
$theloai = App\TheLoai::All();
$abc = App\TheLoai:
foreach($theloai as $value) {
    echo "$value <br>";
}
```

## Step 3: Create admin view
- extend and include