<?php
   // �������� ����� ������� ��� ������� ����������
   require_once('book_sc_fns.php');

  // ������� �������� ����� ����������
  
  $email=$_POST['email'];
  $name=$_POST['name'];
  $address=$_POST['address'];
  $city=$_POST['city'];
  $state=$_POST['state'];
  $zip=$_POST['zip'];
  $country=$_POST['country'];
  $passwd=$_POST['passwd'];
  $passwd2=$_POST['passwd2'];
   // ��������� �����, ������� ����� ������������� �����.
   // ��� ������� ��������� ������, ��������� �� ������
   // ���������� ����� �����������.
   session_start();
 
   try
   {
     // ���������, ��������� �� ���� �����
     if (!filled_out($_POST))
     {
        throw new Exception('�� �� ��������� ��������� �����. ����������, ' 
                            .'��������� �� ����� � ��������� �������.');
     }    

     // ������������ ����� ����������� �����
     if (!valid_email($email))
     {
        throw new Exception('������������ ����� ����������� �����. ����������, ' 
                            .'��������� �� ����� � ��������� �������.');

     } 

     // ������������� ������ 
     if ($passwd != $passwd2)
     {
        throw new Exception('��������� ������ �� ���������. ����������, ' 
                            .'��������� �� ����� � ��������� �������.');
     }

     // ��������� ����� ������.
     if (strlen($passwd) < 6)
     {
        throw new Exception('������ ������ ����� �� ����� 6 ��������. ' 
                       .'����������, ��������� �� ����� � ��������� �������.');

     }

     // ��������� ����� ����� ������������.
     if (strlen($name) > 16)
     {
        throw new Exception('��� ������������ ������ ����� �� ����� 16 ��������.' 
                       .' ����������, ��������� �� ����� � ��������� �������.');

     }

     // ����������� ������� �����������. ��� ������� ����� �����
     // ������������� ����������
     register($name, $address, $city, $state, $zip, $country, $email, $passwd);

     // ���������������� ���������� ������ 
     $_SESSION['valid_user'] = $name;
     
     // ������� ������ �� ��������, ��������������� ��� 
     // ������������������ �������������
     do_html_header('�������� �����������');
     echo '���� ����������� ������ �������. ���������� �� �������� '
          .'��� ������������������ ������������� '
          .'� ����������� � �������� �������!';
     do_html_url('member.php' , '������� �� �������� ��� ����������������� �������������');
     // ����� ��������
     do_html_footer();
   }
   catch(Exception $e)
   {
     do_html_header('��������:');
     echo $e->getMessage();
     do_html_footer();
     exit;
   }
?>