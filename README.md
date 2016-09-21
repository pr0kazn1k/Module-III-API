# Класс для работы с ботом «А-я-яй»
> [Demo] (https://valentineus.link/iii/)

## Инициализация бота:
```
define('BOT_TOKEN', $token);
$bot = new Bot(BOT_TOKEN);
// $token - Токен бота, например: «109cd867-0ef3-4473-af71-7543a9b2fccd»
```

## Инициализация сессии:
```
// Создание новой сессии:
$session = $bot->session();
// Инициализация уже имеющийся сесии:
$session = $bot->session($session_id);
```
## Разработчик
- [Paul Belinsky] (https://vk.com/vskyd1)
- [Valentin Popov] (https://vk.com/valentineus)

## Контакты
[dev@valentineus.link] (mailto:dev@valentineus.link)

## TODO
- [x] Оформить основной README;
- [ ] Оформить README для демонстрационной работы;
