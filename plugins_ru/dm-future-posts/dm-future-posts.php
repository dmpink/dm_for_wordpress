<?php
/*
Plugin Name: Список постов с отложенной датой публикации.
Plugin URI: http://blog.dmpink.ru/dm-future-posts
Description: Виджет. Выводит список постов с отложенной датой публикации.
Author: dmpink <pink@dmpink.ru>
Author URI: http://dmpink.ru/
Version: 0.3

	Список постов с отложенной датой публикации.

История версий:
	0.4	- Добавлена настройка вывода даты поста.
	0.3	- Добавлена настройка количества постов для отображения.
	0.2	- Добавлена очистка параметров при удалении виджета.
	0.1	- Первый релиз виджета.
	
Планы:
		- сделать английскую версию
		
*/
function dm_future_posts_widget_init(){
register_sidebar_widget('Список постов с отложенной датой публикации', 'dm_future_posts_widget_show');
register_widget_control('Список постов с отложенной датой публикации', 'dm_future_posts_widget_control' );
register_uninstall_hook(__FILE__, 'dm_future_posts_widget_uninstall');
} 
function dm_future_posts_widget_show($args){
extract($args);
$options = get_option('dm_future_posts_widget');
$title = apply_filters('widget_title', $options['title']);
$info = apply_filters('widget_info', $options['info']);
$number = intval(apply_filters('widget_number', $options['number']));
$showdate = intval(apply_filters('widget_number', $options['showdate']));
$dateformat = apply_filters('widget_info', $options['dateformat']);
if (empty($title))
 $title = "Скоро на сайте";
if (empty($info))
 $info = "На данный момент нет запланированных публикаций";
if ($number <= 0)
 $number = 5;
if (empty($dateformat))
 $dateformat = "d.m";
echo $before_widget . $before_title . $title . $after_title;
echo '<div id="dm_future_posts_widget_wrap">';
$allposts = get_posts('numberposts='.$number.'&post_type=post&post_status=future');
if (!empty($allposts)){
foreach($allposts as $postinfo){
  if ($showdate == 1)
   echo '<span class="fp-date">&nbsp;'.date($dateformat,strtotime($postinfo->post_date)).'</span>&nbsp;';
  echo $postinfo->post_title.'<br />';
  }}
else {echo $info;}
echo '</div>';
echo $after_widget;
}
function dm_future_posts_widget_control(){
$options = $newoptions = get_option('dm_future_posts_widget');
if ($_POST["dm-future-posts-widget-submit"]){
 $newoptions['title'] = strip_tags(stripslashes($_POST["dm-future-posts-widget-title"]));
 $newoptions['info'] = strip_tags(stripslashes($_POST["dm-future-posts-widget-info"]));
 $newoptions['number'] = intval(strip_tags(stripslashes($_POST["dm-future-posts-widget-number"])));
 $newoptions['showdate'] = intval(strip_tags(stripslashes($_POST["dm-future-posts-widget-showdate"])));
 $newoptions['dateformat'] = strip_tags(stripslashes($_POST["dm-future-posts-widget-dateformat"]));
 }
if ($options != $newoptions){
 $options = $newoptions;
 update_option('dm_future_posts_widget', $options);}
$title = attribute_escape($options['title']);
$info = attribute_escape($options['info']);
$number = attribute_escape($options['number']);
if ($number <= 0)
 $number = 5;
$showdate = attribute_escape($options['showdate']);
if ($showdate == 1)
 $is_checked = 'checked';
$dateformat = attribute_escape($options['dateformat']);
if (empty($dateformat))
 $dateformat = "d.m";
echo '<p><label for="dm-future-posts-widget-title">Заголовок:<input class="widefat" id="dm-future-posts-widget-title" name="dm-future-posts-widget-title" type="text" value="'.$title.'" /></label></p>';
echo '<p><label for="dm-future-posts-widget-info">Выводить, когда нет постов:<input class="widefat" id="dm-future-posts-widget-info" name="dm-future-posts-widget-info" type="text" value="'.$info.'" /></label></p>';
echo '<p><label for="dm-future-posts-widget-number">Количество выводимых постов:<input class="widefat" id="dm-future-posts-widget-number" name="dm-future-posts-widget-number" type="text" value="'.$number.'" /></label></p>';
echo '<p><input type="checkbox" class="checkbox" id="dm-future-posts-widget-showdate" name="dm-future-posts-widget-showdate" value="1" '.$is_checked.'/><label for="dm-future-posts-widget-showdate">Выводить дату постов</label></p>';
echo '<p><label for="dm-future-posts-widget-dateformat">Формат выводимой даты:<input class="widefat" id="dm-future-posts-widget-dateformat" name="dm-future-posts-widget-dateformat" type="text" value="'.$dateformat.'" /></label></p>';
echo '<input type="hidden" id="dm-future-posts-widget-submit" name="dm-future-posts-widget-submit" value="1" />';
}
function dm_future_posts_widget_uninstall(){
delete_option('dm_future_posts_widget');
}
add_action('plugins_loaded', 'dm_future_posts_widget_init');
?>