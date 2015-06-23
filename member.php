<?php

// �������� ����� ������� ��� ������� ����������
require_once('book_sc_fns.php'); 
session_start();

// ������� �������� ����� ����������
$name = $_POST['name'];
$passwd = $_POST['passwd'];

if ($name && $passwd)
// ������������ ������ ��� ��������� ����� � �������
{
    try
    {
      login($name, $passwd);
      // ���� ������������ ������� � ���� ������, 
      // ���������������� ��� �������������
      $_SESSION['valid_user'] = $name;
    }  
    catch (Exception $e)
    {
      // ��������� ���� � �������
      do_html_header('��������:');
      echo '���� � ������� ����������. '
           .'��� ��������� ���� �������� ���������� ����� � �������.';
      do_html_url('login_user.php', '����');
      do_html_footer();
      exit;
    }      
}

do_html_header('�������� ��������');
check_valid_user();

// ������� ��� ��������, ����������� ���� �������������
if ($url_array = get_user_urls($_SESSION['valid_user']));
  display_user_urls($url_array);

// ������� ���� �����
display_user_menu();

do_html_footer();
?>
