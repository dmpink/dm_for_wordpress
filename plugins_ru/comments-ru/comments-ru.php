<?php
/*
Plugin Name: Количество комментариев
Plugin URI: http://blog.dmpink.ru/comments-ru
Description: Исправляет вывод количества комментариев в соответствии с правилами склонения существительных.
Author: dmpink <pink@dmpink.ru>
Author URI: http://dmpink.ru/
Version: 0.1
*/
function dm_comments_number_ru(){
	global $id;
	$number = get_comments_number($id); 
	$strnumber = (string) $number;
	$int1 = (int) $strnumber{strlen($strnumber) - 1};
	$int2 = (int) 0;
	if (strlen($strnumber) > 1){
		$int2 = (int) $strnumber{strlen($strnumber) - 2};
	}
	if ($int1 > 4){
		echo $number.' Комментариев';
	}
	else{
		if ($int1 == 0){
			if ($int2 > 0){
				echo $number.' Комментариев';
			}
			else{
				echo 'Нет комментариев';
			}
		}
		else{
			if ($int1 == 1){
				if ($int2 == 1){
					echo $number.' Комментариев';
				}
				else{
					echo $number.' Комментарий';
				}
			}
			else{
				if ($int2 == 1){
					echo $number.' Комментариев';
				}
				else{
					echo $number.' Комментария';
				}
			}
		}
	}
}
add_filter('comments_number','dm_comments_number_ru');
