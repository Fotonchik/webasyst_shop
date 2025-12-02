
# Webasyst Shop CRM с плагином «Подарок для вас»

Полнофункциональная CRM система Webasyst с магазином Shop-Script и плагином для розыгрыша подарков.

## Структура проекта
```
webasyst_shop/
├── wa-apps/shop/ # Приложение магазина Shop-Script
│ └── plugins/gift4you/ # Плагин «Подарок для вас»
├── wa-apps/itservices/ # Тестовое приложение «IT Services»
├── wa-config/ # Конфигурация Webasyst
├── wa-system/ # Фреймворк Webasyst
├── wa-content/ # Контент и темы
├── wa-data/ # Данные приложений
├── docker-compose.yml # Конфигурация Docker
└── README.md # документация
```


### Предварительные требования
- Docker Desktop (Windows/Mac) или Docker Engine (Linux)
- Git
- 4 ГБ+ оперативной памяти
- Docker Compose версии 3.8+

### 1. Клонирование репозитория
```bash
git clone https://github.com/Fotonchik/webasyst_shop.git
cd webasyst_shop
```
2. Выбор ветки
```bash
# Для работы с плагином подарка (минимальная версия)
git checkout main
```
# Для полной версии Webasyst CRM + магазин
```git checkout dev```
3. Запуск контейнеров

# Сборка и запуск
```
docker compose up -d --build
```
# Проверка статуса
```
docker compose ps
```
4. Настройка базы данных
Откройте в браузере: http://localhost:8001/webasyst/

- Настройка плагина «Подарок для вас»
- После установки Webasyst:
- Включите плагин:
- Админ-панель → Магазин → Настройки → Плагины
- Найдите "Подарок для вас" → Активировать
- Настройте подарки:
- В настройках плагина выберите товары для розыгрыша
- Настройте внешний вид страницы

Страница подарка:
```text
http://localhost:8001/webasyst/?plugin=gift4you&action=gift
```
или

```text
http://localhost:8001/shop/?plugin=gift4you&action=gift
```
Доступ к системе
```
Главная страница: http://localhost:8001/webasyst/
Магазин: http://localhost:8001/shop/
Страница подарков: http://localhost:8001/webasyst/?plugin=gift4you&action=gift
Админ-панель: http://localhost:8001/webasyst/
```

Ветки проекта
```
main
```
gift4you, README и docker-compose.


```
dev
```
Полная версия Webasyst CRM включая:
- Shop-Script (магазин)
- Плагин gift4you
- Приложение IT Services
- Все системные файлы


# Правильные права
```
docker compose exec web chmod -R 755 /var/www/html/
docker compose exec web chown -R www-data:www-data /var/www/html/
docker compose exec web chmod -R 777 /var/www/html/wa-data/
docker compose exec web chmod -R 777 /var/www/html/wa-cache/
```

# Технические характеристики

- Web-сервер: Apache 2.4 с PHP 8.2
- База данных: MariaDB 10.5
- PHP расширения: mysqli, pdo, pdo_mysql

Порты:
- 8001 → Web-интерфейс
- 3306 → База данных (внутренний)
