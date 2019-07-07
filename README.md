# Hướng dẫn làm web tin tức bằng PHP/Laravel
[Video hướng dẫn](https://www.youtube.com/watch?v=KlKJNLweHx8&list=PLnJJBmKEuhNkpZ6rFUhDAmcV9_nKENO47&index=2)

Tài liệu download =>> File laravelDemo.rar

| Command line      | Description   |
| :---------------- | :------------ |
| php artisan serve | run sever php |

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