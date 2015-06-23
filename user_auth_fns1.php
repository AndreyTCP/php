<?php

require_once('db_fns.php');

function register($name, $address, $city, $state, $zip, $country, $email, $password)
// ������������ ������ ������������ � ���� ������.
// ���������� ���� true, ���� ��������� �� ������.
{
 // ������������ � ���� ������
  $conn = db_connect();

  // ���������, ��������� �� ��� ������������ 
  $result = $conn->query("select * from customers where name='$name'"); 
  if (!$result)
     throw new Exception('���������� ��������� ������ � ��');
  if ($result->num_rows > 0) 
     throw new Exception('��� ��� ������������ ��� ������ - ��������� '
                         .'�� ����� ����������� � �������� ������ ���.');

  // ���� ��� � �������, ��������� ���������� � ��
  $result = $conn->query("insert into customers values 
                         ('' ,'$name','$address', '$city', '$state', '$zip', '$country', sha1('$password'), '$email')");
  if (!$result)
    throw new Exception('���������� ���������� � �� - ����������, '
                        .'����������� �����.');

  return true;
}
 
function login_user($name, $password)
// ��������� ������� ����� ������������ � ������ � ���� ������.
// ���� ��� ��� ����������, ������������ �������� true, 
// � ��������� ������ ������������ ����������.
{
  // ������������ � ���� ������
  $conn = db_connect();

  // ��������� ������������ ����� ������������
  $result = $conn->query("select * from user
                     where name='$name'
                     and passwd = sha1('$password')");
  if (!$result)
     throw new Exception('���� � ������� ����������');

  if ($result->num_rows > 0)
     return true;
  else
     throw new Exception('���� � ������� ����������');

	 }

function check_valid_user()    
// ����������, ����� �� ������������ � ������� �, 
// ���� ���, ������� ��������������� �����������
{
  global $valid_user;
  if (isset($_SESSION['valid_user']))
  {
      echo '�� ����� � ������� ��� ������ '
           .stripslashes($_SESSION['valid_user']).'.';
      echo "<br />";
  }
  else
  {
     // ������������ �� ����� � �������
     do_html_heading("��������:");
     echo "�� �� ����� � �������.<br />";
     do_html_url('login_user.php', '����');
     do_html_footer();
     exit;
  }
}

function change_password_user($name, $old_passwd, $new_passwd)
// �������� ������ ������ �����.
// ���������� �������� true ��� ���������� ����������
{
  // ���� ������� ������ ������ ���������,
  // �� ���������� ����� � ������������ �������� true,
  // � ��������� ������ ������������ ����������
  login_user($name, $old_passwd);
  $conn = db_connect();
  $result = $conn->query( "update customers
                           set passwd = passwd('$new_passwd')
                           where name = '$name'");
  if (!$result)
    throw new Exception('������ �� ����� ���� �������.'); 
  else
    return true;  	// ������ ������� �������
}

function get_random_word($min_length, $max_length)
// grab a random word from dictionary between the two lengths
// and return it
{
   // generate a random word
  $word = '';
  // remember to change this path to suit your system
  $dictionary = '/usr/dict/words';  // the ispell dictionary
  $fp = @fopen($dictionary, 'r');
  if(!$fp)
    return false; 
  $size = filesize($dictionary);

  // go to a random location in dictionary
  srand ((double) microtime() * 1000000);
  $rand_location = rand(0, $size);
  fseek($fp, $rand_location);

  // get the next whole word of the right length in the file
  while (strlen($word)< $min_length || strlen($word)>$max_length || strstr($word, "'"))
  {  
     if (feof($fp))   
        fseek($fp, 0);        // if at end, go to start
     $word = fgets($fp, 80);  // skip first word as it could be partial
     $word = fgets($fp, 80);  // the potential password
  };
  $word=trim($word); // trim the trailing \n from fgets
  return $word;  
}

function reset_password($name)
// ������������� ��������� �������� ��� ������.
// ���������� ����� ������ ���� �������� false � ������ ������
{
  // �������� ��������� ����� �� ������� ������ �� 6 �� 13 ��������
  $new_password = get_random_word(6, 13);

  if($new_password == false)
    throw new Exception('���������� ������������� ����� ������.');
  // �������� � ���� ����� �� 0 �� 999
  // � ����� ���������� ��������� 
  srand ((double) microtime() * 1000000);
  $rand_number = rand(0, 999);
  $new_password .= $rand_number;

  // �������� ������ � ���� ������ ��� ������� �������� false
  $conn = db_connect();
  $result = $conn->query( "update customers
                           set passwd = sha1('$new_password')
                           where name = '$name'");
  if (!$result)
    throw new Exception('���������� �������� ������.');  // ������ �� �������
  else
    return $new_password;  // ������ ������� �������
}

function notify_password($name, $password)
// ���������� ������������ � ���, ��� ��� ������ �������
{
  $conn = db_connect();
  $result = $conn->query("select email from customer
                          where name='$name'");
  if (!$result)
  {
    throw new Exception('����� ����������� ����� �� ������.'); 
  }
  else if ($result->num_rows == 0)
  {
    throw new Exception('����� ����������� ����� '
                        .'�� ������.'); // ��� ������������ ����������� � ��
  }
  else
  {
    $row = $result->fetch_object();
    $email = $row->email;
    $from = "From: support@phpshop \r\n";
    $mesg = "��� ������ ��� ����� � ������� PHPshop ������� �� $password \r\n"
            ."����������, ������ ��� ��� ������� ����� � �������. \r\n";
          
    if (mail($email, '���������� � ����� � ������� PHPBookmark', $mesg, $from))
      return true;      
    else
      throw new Exception('�� ������� ��������� ����������� �����.'); 
  }
}

?>
