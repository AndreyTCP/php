<?php
  require ('book_sc_fns.php');
  // Для покупательской тележки необходимо запустить сеанс
  session_start();

  $catid = $_GET['catid'];
  $name = get_category_name($catid);
 
  do_html_header($name);
  
  
    // Извлечь категории из базы данных
  $cat_array = get_categories();
  ?><table height="100%"><tr><td >
<div id="leftblock1">
    
         <div class="brands">
		 <?php
  // Отобразить в виде ссылок на соответствующие страницы категорий
  display_categories($cat_array);
  display_categories($cat_array);
?></div> </div></td>
<td>     <?php
  // Извлечь из базы данных информацию о книге
  $book_array = get_books($catid);

  display_books($book_array);
 ?>   </td></tr>
    
 
 </table>
 <?php
  // Если пользователь вошел в систему как администратор, вывести 
  // ссылки на добавление и удаление ссылок на книги
  if(isset($_SESSION['admin_user']))
  {
    display_button('index.php', 'continue', 'Продолжить покупки');
    display_button('admin.php', 'admin-menu', 'Меню администрирования');
    display_button("edit_category_form.php?catid=$catid", 
     'edit-category', 'Редактировать категорию');
  }
  else
   
  
  do_html_footer();
?>
