<?php

// Включить файлы функций для данного приложения
require_once('book_sc_fns.php'); 
session_start();

// Создать короткие имена переменных
$name = $_POST['name'];
$passwd = $_POST['passwd'];

if ($name && $passwd)
// Пользователь только что попытался войти в систему
{
    try
    {
      login($name, $passwd);
      // Если пользователь записан в базе данных, 
      // зарегистрировать его идентификатор
      $_SESSION['valid_user'] = $name;
    }  
    catch (Exception $e)
    {
      // Неудачный вход в систему
      do_html_header('Проблема:');
      echo 'Вход в систему невозможен. '
           .'Для просмотра этой страница необходимо войти в систему.';
      do_html_url('login_user.php', 'Вход');
      do_html_footer();
      exit;
    }      
}

do_html_header('Домашняя страница');
check_valid_user();

// Извлечь все закладки, сохраненные этим пользователем
if ($url_array = get_user_urls($_SESSION['valid_user']));
  display_user_urls($url_array);

// Вывести меню опций
display_user_menu();

do_html_footer();
?>
