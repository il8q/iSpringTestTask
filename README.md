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

Сделал так как это сделал бы на прошлом месте работы, за исключением того, что нет swagger-а.
В боевых проектах нужно ли возвращать какой-то кроме 200? Работая в WhiteTiger всегда возвращали 200,
даже если присылал текст ошибки. Текст ошибки может описать гораздо больше чем просто код, 
поэтому всегда возвращали 200.(сделал по ТЗ, но не уверен что это корректно)

По доп. заданиям:
- для получения архивных задач используйте http://frontend.test/list-element/my-list c параметром isCompleted=1
- Тесты для Postman импортировал, находятся в iSprinTestTask.postman_collection.json(на прошлой работе не делал авто тесты в postman, не было необходимости)
- Docker не стал испольовать для ускорения сдачи задания(работал с ним в магистратуре).


