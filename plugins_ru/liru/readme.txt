=== Импорт записей из XML файла LiveInternet.ru ===
Contributors: dmpink
Tags: import liru liveinternetru
Requires at least: 3.7
Tested up to: 4.8
Stable tag: 0.3
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Импорт записей из XML файла LiveInternet.ru в WordPress.

== Description ==

Импорт записей из XML файла LiveInternet.ru в WordPress.

== Installation ==

Установка:  Скопировать файл в папку с плагинами. В панели управления активировать плагин.
            После этого в списке импорта появится вариант LiveInternet.ru.

В экспортном файле содержатся: заголовок поста, пост, дата и тэги. Комментарии
представлены в виде ссылки, поэтому не импортируются. Не импортируются рисунки
и остаётся ссылка на них. При просмотре они будут подгружаться с LiveInternet.ru.
Переносить их надо вручную.

Функции импорта написаны на основе файла livejournal.php, использующегося для
импорта записей из XML файла LiveJournal.com.

== Changelog ==

История версий:
	0.3	- Обновлено в соответствии с требованиями WordPress.
	0.2	- Добавлен импорт поля guid из XML файла LiveInternet.ru 
		в поле guid для записи WordPress. И сохрание поля post_name
		на основе поля guid.
