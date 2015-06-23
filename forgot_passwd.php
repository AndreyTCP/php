<?php
  require_once('book_sc_fns.php');
  do_html_header('������������� ������');

  // ������� �������� ����� ����������
  $username = $_POST['username'];

  try
  {
    $password = reset_password($username);
    notify_password($username, $password);
    echo '����� ������ ��������� �� ������ ����������� �����, '
         .'������� �� ������� ��� �����������.';
  }
  catch (Exception $e)
  {
      echo '������ �� ����� ���� ��������������. '
           .'����������, ��������� ������� �����.';
  }
  do_html_url('login.php', '����');
  do_html_footer();
?>
