# Тествое задание на вакансию "Backend-разработчика"

Задание сделано с помощью Yii2, так как с ним недавно работал.
Используется advanced шаблон, в нем есть необходимая инфраструктура для дальнейшего расширения и с ним привычнее работать(в базомо шаблоне нет frontend части)
В качестве бд использую MySql по той же причине что и Yii.
Для развертки сервера использовался OpenServer.
## Установка
1. Инициализируем проект 
      
         composer update
         php init --env=Development --overwrite=All --delete=All

2. В common/config/main-local.php ищем components['db'] и меняем host и dbname на нужный нам(я поставил dbname=testDb)
3. Создаем бд с именем уазанным в dbname
4. Применяем миграции

         php yii migrate

5. Задаем настройки серверов в Apache(используются стандартные из руководтсва):

        <VirtualHost *:80>
           ServerName frontend.test
           DocumentRoot "/path/to/yii-application/frontend/web/"
   
             <Directory "/path/to/yii-application/frontend/web/">
                 # use mod_rewrite for pretty URL support
                 RewriteEngine on
                 # If a directory or a file exists, use the request directly
                 RewriteCond %{REQUEST_FILENAME} !-f
                 RewriteCond %{REQUEST_FILENAME} !-d
                 # Otherwise forward the request to index.php
                 RewriteRule . index.php
   
                 # use index.php as index file
                 DirectoryIndex index.php
   
                 # ...other settings...
                 # Apache 2.4
                 Require all granted
               
                 ## Apache 2.2
                 # Order allow,deny
                 # Allow from all
             </Directory>
         </VirtualHost>
        <VirtualHost *:80>
           ServerName backend.test
           DocumentRoot "/path/to/yii-application/backend/web/"
   
             <Directory "/path/to/yii-application/backend/web/">
                 # use mod_rewrite for pretty URL support
                 RewriteEngine on
                 # If a directory or a file exists, use the request directly
                 RewriteCond %{REQUEST_FILENAME} !-f
                 RewriteCond %{REQUEST_FILENAME} !-d
                 # Otherwise forward the request to index.php
                 RewriteRule . index.php
   
                 # use index.php as index file
                 DirectoryIndex index.php
   
                 # ...other settings...
                 # Apache 2.4
                 Require all granted
               
                 ## Apache 2.2
                 # Order allow,deny
                 # Allow from all
             </Directory>
         </VirtualHost>
   
6. Задаем доменные имена в hosts:

         127.0.0.1   frontend.test
         127.0.0.1   backend.test

# Примечание
Для генерации моделей используется скрипт(в базовом хранится модель из бд, в осноном классе логика)

         ./generate-model.sh

