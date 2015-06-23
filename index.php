<?php
  require ('book_sc_fns.php');
  // Для покупательской тележки необходимо запустить сеанс
  session_start();
  do_html_header('Добро пожаловать в магазин Товаров и Услуг');
?>
<div id="leftblock1">
    
         <div class="brands">
		 <?php
  
  // Извлечь категории из базы данных
  $cat_array = get_categories();

  // Отобразить в виде ссылок на соответствующие страницы категорий
  display_categories($cat_array);
  display_categories($cat_array);
 ?></div> </div><?php
 
 
 
  // Если пользователь вошел в систему как администратор, вывести 
  // ссылки на добавление, удаление и редактирование категорий
  if(isset($_SESSION['admin_user']))
  {
    display_button('admin.php', 'admin-menu', 'Меню администрирования');
  }

  do_html_footer();
?>
