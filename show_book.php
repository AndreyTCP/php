<?php
  require ('book_sc_fns.php');
  // Для покупательской тележки необходимо запустить сеанс
  session_start();

  $isbn = $_GET['isbn'];

  // Извлечь из базы данных информацию о конкретной книге
  $book = get_book_details($isbn);
  do_html_header($book['title']);
  display_book_details($book);

  // Установить url для кнопки "Продолжить"
  $target = 'index.php';
  if($book['catid'])
  {
    $target = 'show_cat.php?catid='.$book['catid'];
  }

  // Если пользователь вошел в систему как администратор, вывести 
  // ссылку на редактирование информации о книге
  if( check_admin_user() )
  {
    display_button("edit_book_form.php?isbn=$isbn", 
                   'edit-item', 'Редактировать элемент');
    display_button('admin.php', 'admin-menu', 'Меню администрирования');
    display_button($target, 'continue', 'Продолжить');
  }
  else
  {
    display_button("show_cart.php?new=$isbn", 'add-to-cart', 'Добавить '
                   .$book['title'].' в мою тележку'); 
    display_button($target, 'continue-shopping', 'Продолжить покупки');
  }
  
  do_html_footer();
?>
