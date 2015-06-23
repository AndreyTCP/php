<?php
  require ('book_sc_fns.php');
  // ��� �������������� ������� ���������� ��������� �����
  session_start();

  $isbn = $_GET['isbn'];

  // ������� �� ���� ������ ���������� � ���������� �����
  $book = get_book_details($isbn);
  do_html_header($book['title']);
  display_book_details($book);

  // ���������� url ��� ������ "����������"
  $target = 'index.php';
  if($book['catid'])
  {
    $target = 'show_cat.php?catid='.$book['catid'];
  }

  // ���� ������������ ����� � ������� ��� �������������, ������� 
  // ������ �� �������������� ���������� � �����
  if( check_admin_user() )
  {
    display_button("edit_book_form.php?isbn=$isbn", 
                   'edit-item', '������������� �������');
    display_button('admin.php', 'admin-menu', '���� �����������������');
    display_button($target, 'continue', '����������');
  }
  else
  {
    display_button("show_cart.php?new=$isbn", 'add-to-cart', '�������� '
                   .$book['title'].' � ��� �������'); 
    display_button($target, 'continue-shopping', '���������� �������');
  }
  
  do_html_footer();
?>
