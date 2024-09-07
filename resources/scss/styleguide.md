## Препроцессор
- в качестве основного препроцессора используем SASS в синтаксисе SCSS

## Методолгия
- в основе лежит Bem методология наименования и структуры классов
- Файловая структура разбита на блоки в директории blocks по схеме Flex, без разбивки элементов и модификаторов на отдельные файлы

## SCSS
- все блоки, переменные, миксины подключаются через общий файл
```
@import '~/modern-normalize/modern-normalize.css';
@import "functions";
@import "mixins";
@import "fonts";
@import "colors";
@import "variables";

@import "../blocks/header/header";
@import "../blocks/main-menu/main-menu";
```
- наименование переменных происходит по схеме kebab-case (dash-case)


## Нормализация
Для нормализации стилей используется https://github.com/sindresorhus/modern-normalize

## Форматирование и основные правила CSS
- каждое правило пишется с новой строки
- для форматирования используем tab (4 пробела)
- после названия свойства между : и значением обязателен пробел
- используем двойные кавычки
- все строки свойств заканчиваем точкой с запятой ;
- не используем 0 в дробных значениях свойств, начинаем сразу с точки (.8, .3s)
- жирность шрифта задаем цифрами
- для цветов используем формат hsla
- в свойствах с нулевым значением, а также свойствам высоты строки, межстрочного расстояния используем только значения, без единиц измерения
- открывающая скобка находится в одном ряду с именем селектора и отделена от него пробелом. Закрывающая скобка находится на новой строке
```
.button::after {
    content: "";
    display: block;
    font-size: 1rem;
    font-weight: 500;
    line-height: 1.2;
    color: hsla(238, 15%, 41%, .8);
    transition: .3s;
}
```
- каждый селектор с новой строки
```
.btn,
.button {
    display: block;
    font-size: 1rem;
}
```
- в качестве основных единиц величины шрифта используем rem
- порядок объявления свойств
```
.selector {
    /* Содержимое */
    content: counter(num);
    counter-increment: num;
                
    /* Позиционирование */
    position: absolute;
    z-index: 10;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;

    /* Формат блока и его размеры */
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100px;
    height: 100px;
    box-sizing: border-box;
    padding-top: 10px;
    margin-bottom: 10px;
    border: 10px solid hsla(238, 15%, 41%, .8);
    overflow: hidden;

    /* Типографика */
    font-family: sans-serif;
    font-size: 16px;
    line-height: 1.4;
    text-align: right;
    color: hsla(0, 0%, 100%, 1);
    
    /* Свойства фона */
    background-color: hsla(238, 15%, 41%, .8);
    background-size: cover;

    /* Остальные свойства */
    opacity: .8;
    transition: .3s;
    cursor: pointer;
}
```



