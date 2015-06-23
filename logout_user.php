<?php

// �������� ����� ������� ��� ����� ����������
require_once('book_sc_fns.php'); 
session_start();
$old_user = $_SESSION['valid_user1'];  
// ��������� ��� ��������, ���� ���-�� ����� � ������� *�����*
unset($_SESSION['valid_user1']);
$result_dest = session_destroy();

// ������ ����� html-�����������
do_html_header('�����');

if (!empty($old_user))
{
  if ($result_dest)
  {
    // ���� ������������ ����� � ������� � ������ ������� �� ���
    echo '�������� ����� �� �������.<br />';
    do_html_url('login_user.php', '����');
  }
  else
  {
   // ������������ ����� � ������� � �� ����� ����� �� ���
    echo '����� �� ������� ����������.<br />';
  }
}
else
{
  // ���� ������������ �� ������ � �������, �� �����-�� ������� ����� �� ��� ��������
  echo '�� �� ������� � �������, ������� � �������� �� ��� �� �����.<br />';
  do_html_url('login_user.php', '����');
}

do_html_footer();

?>
