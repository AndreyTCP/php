<?php
  require ('book_sc_fns.php');
  // ��� �������������� ������� ���������� ��������� �����
  session_start();
  do_html_header('����� ���������� � ������� ������� � �����');
?>
<div id="leftblock1">
    
         <div class="brands">
		 <?php
  
  // ������� ��������� �� ���� ������
  $cat_array = get_categories();

  // ���������� � ���� ������ �� ��������������� �������� ���������
  display_categories($cat_array);
  display_categories($cat_array);
 ?></div> </div><?php
 
 
 
  // ���� ������������ ����� � ������� ��� �������������, ������� 
  // ������ �� ����������, �������� � �������������� ���������
  if(isset($_SESSION['admin_user']))
  {
    display_button('admin.php', 'admin-menu', '���� �����������������');
  }

  do_html_footer();
?>
