<?php
  require ('book_sc_fns.php');
  // ��� �������������� ������� ���������� ��������� �����
  session_start();

  $catid = $_GET['catid'];
  $name = get_category_name($catid);
 
  do_html_header($name);
  
  
    // ������� ��������� �� ���� ������
  $cat_array = get_categories();
  ?><table height="100%"><tr><td >
<div id="leftblock1">
    
         <div class="brands">
		 <?php
  // ���������� � ���� ������ �� ��������������� �������� ���������
  display_categories($cat_array);
  display_categories($cat_array);
?></div> </div></td>
<td>     <?php
  // ������� �� ���� ������ ���������� � �����
  $book_array = get_books($catid);

  display_books($book_array);
 ?>   </td></tr>
    
 
 </table>
 <?php
  // ���� ������������ ����� � ������� ��� �������������, ������� 
  // ������ �� ���������� � �������� ������ �� �����
  if(isset($_SESSION['admin_user']))
  {
    display_button('index.php', 'continue', '���������� �������');
    display_button('admin.php', 'admin-menu', '���� �����������������');
    display_button("edit_category_form.php?catid=$catid", 
     'edit-category', '������������� ���������');
  }
  else
   
  
  do_html_footer();
?>
