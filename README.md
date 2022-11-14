### [1. Задание Laravel](#1)
### [2. Инструкция по запуску проекта](#2)

### <a name="1">1. Задание Laravel</a> 

Backend

Напишите REST API для анонимного блога.
Необходимо реализовать следующие методы

Добавить запись
(имя автора, текст сообщения) -> (id добавленной записи)
Добавить комментарий
(id записи, имя автора, текст сообщения) -> (id добавленного комментария)
Получить запись
(id записи) -> (объект записи)
Получить список записей и последние 3 комментария к каждой записи
(page id) -> (список объектов)
Получить список комментариев к записи
(id записи) -> (список комментариев)

Требования:
- Любой современный фреймворк
- MySQL
- Документация

Будет плюсом:
- Docker окружение для запуска
- Валидация данных
  -- Комментарий не более 200 символов
  -- Пост не боле 5000 символов
  -- Не больше одного комментария в минуту от одного имени

Не выполнил:
Будет большим плюсом
- Юнит тесты

Не выполнил:
Очень большой плюс
- Swagger документация


### <a name="2">2. Инструкция по запуску проекта</a> 

Скачать с GitHub

    git clone https://github.com/al-zv/macro.git
    
Запустить проект через Docker (Docker должен быть установлен и запущен)

    ./vendor/bin/sail up -d

Выполнить миграции

    ./vendor/bin/sail artisan migrate


### <a name="3">3. Работа с проектом</a> 

Рекомендую проверять запросы в Postman (бесплатный инструмент для тестирования API) или в любом подобном инструменте.
В корне проекта есть коллекция Postman macro.postman_collection.json, которую можно добавить в Postman для проверки работы запросов.

Добавить запись

    http://localhost/api/record?author=Петров&message=Запись в блог
    
<img width="856" alt="image" src="https://user-images.githubusercontent.com/63869857/201673100-a7aec60b-f13a-4ddf-8463-0af51ce588c7.png">
    
Добавить комментарий

    http://localhost/api/comment?author=Иван Петров&message=Комментарий Ивана Петрова&record_id=1
    
<img width="856" alt="image" src="https://user-images.githubusercontent.com/63869857/201673633-986b87b3-060a-4c39-bc61-b63b8d783dd9.png">

Получить запись
    
    http://localhost/api/record/1
    
    <img width="856" alt="image" src="https://user-images.githubusercontent.com/63869857/201672462-fbd41e46-0620-49d1-94c0-61c211bb63c2.png">
    
Получить список записей и последние 3 комментария к каждой записи

    http://localhost/api/records
    
<img width="856" alt="image" src="https://user-images.githubusercontent.com/63869857/201673920-f613a61a-f07c-4350-9065-3b4a48577145.png">

<img width="856" alt="image" src="https://user-images.githubusercontent.com/63869857/201674020-bade43fb-73cb-4259-af29-51a562e16019.png">

<img width="856" alt="image" src="https://user-images.githubusercontent.com/63869857/201674106-23035b47-fcd1-4e47-87c7-cb37274488fe.png">
    
Получить список комментариев к записи
    
    http://localhost/api/comments?record_id=1
    
<img width="856" alt="image" src="https://user-images.githubusercontent.com/63869857/201674213-97e30d73-ec17-47a0-ab69-4d7ec483302b.png">

