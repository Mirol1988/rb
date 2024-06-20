## Развернуть:
- копируем и правим `cp .env.example .env`
- Выбираем платформу в .env `PLATFORM=linux/arm64 or linux/x86_64`
- копируем и правим `cp .env.example .env.test` для тестовой базы
- создаем схему `CREATE SCHEMA rb DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;`
- `make up`
- запускаем в нутри контейнера`composer update`
- запускаем из контейнера `php console.php migrate`
- запускаем из контейнера для добовления app_token `php console.php appToken/create site token`

## Api документация
- доступна по url `http://localhost:1900/doc/v1#tag/Status/operation/viewStatusList`

## Для запуска тестов:
- запускаем из контейнера `php console.php recreate/test`
- используем `test/phpunit.xml`   


