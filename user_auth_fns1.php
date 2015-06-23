<?php

require_once('db_fns.php');

function register($name, $address, $city, $state, $zip, $country, $email, $password)
// Регистрирует нового пользователя в базе данных.
// Возвращает либо true, либо сообщение об ошибке.
{
 // Подключиться к базе данных
  $conn = db_connect();

  // Проверить, уникально ли имя пользователя 
  $result = $conn->query("select * from customers where name='$name'"); 
  if (!$result)
     throw new Exception('Невозможно выполнить запрос к БД');
  if ($result->num_rows > 0) 
     throw new Exception('Это имя пользователя уже занято - вернитесь '
                         .'на форму регистрации и выберите другое имя.');

  // Если все в порядке, сохранить информацию в БД
  $result = $conn->query("insert into customers values 
                         ('' ,'$name','$address', '$city', '$state', '$zip', '$country', sha1('$password'), '$email')");
  if (!$result)
    throw new Exception('Невозможно сохранение в БД - пожалуйста, '
                        .'попытайтесь позже.');

  return true;
}
 
function login_user($name, $password)
// Проверяет наличие имени пользователя и пароля в базе данных.
// Если они там содержатся, возвращается значение true, 
// в противном случае генерируется исключение.
{
  // Подключиться к базе данных
  $conn = db_connect();

  // Проверить уникальность имени пользователя
  $result = $conn->query("select * from user
                     where name='$name'
                     and passwd = sha1('$password')");
  if (!$result)
     throw new Exception('Вход в систему невозможен');

  if ($result->num_rows > 0)
     return true;
  else
     throw new Exception('Вход в систему невозможен');

	 }

function check_valid_user()    
// Определяет, вошел ли пользователь в систему и, 
// если нет, выводит соответствующее уведомление
{
  global $valid_user;
  if (isset($_SESSION['valid_user']))
  {
      echo 'Вы вошли в систему под именем '
           .stripslashes($_SESSION['valid_user']).'.';
      echo "<br />";
  }
  else
  {
     // Пользователь не вошел в систему
     do_html_heading("Проблема:");
     echo "Вы не вошли в систему.<br />";
     do_html_url('login_user.php', 'Вход');
     do_html_footer();
     exit;
  }
}

function change_password_user($name, $old_passwd, $new_passwd)
// Заменяет старый пароль новым.
// Возвращает значение true или генерирует исключение
{
  // Если прежний пароль введен правильно,
  // он заменяется новым и возвращается значение true,
  // в противном случае генерируется исключение
  login_user($name, $old_passwd);
  $conn = db_connect();
  $result = $conn->query( "update customers
                           set passwd = passwd('$new_passwd')
                           where name = '$name'");
  if (!$result)
    throw new Exception('Пароль не может быть изменен.'); 
  else
    return true;  	// Пароль успешно изменен
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
// Устанавливает случайное значение для пароля.
// Возвращает новый пароль либо значение false в случае ошибки
{
  // Получить случайное слово из словаря длиной от 6 до 13 символов
  $new_password = get_random_word(6, 13);

  if($new_password == false)
    throw new Exception('Невозможно сгенерировать новый пароль.');
  // Добавить к нему число от 0 до 999
  // с целью небольшого улучшения 
  srand ((double) microtime() * 1000000);
  $rand_number = rand(0, 999);
  $new_password .= $rand_number;

  // Изменить пароль в базе данных или вернуть значение false
  $conn = db_connect();
  $result = $conn->query( "update customers
                           set passwd = sha1('$new_password')
                           where name = '$name'");
  if (!$result)
    throw new Exception('Невозможно изменить пароль.');  // Пароль не изменен
  else
    return $new_password;  // Пароль успешно изменен
}

function notify_password($name, $password)
// Уведомляет пользователя о том, что его пароль изменен
{
  $conn = db_connect();
  $result = $conn->query("select email from customer
                          where name='$name'");
  if (!$result)
  {
    throw new Exception('Адрес электронной почты не найден.'); 
  }
  else if ($result->num_rows == 0)
  {
    throw new Exception('Адрес электронной почты '
                        .'не найден.'); // имя пользователя отсутствует в БД
  }
  else
  {
    $row = $result->fetch_object();
    $email = $row->email;
    $from = "From: support@phpshop \r\n";
    $mesg = "Ваш пароль для входа в систему PHPshop изменен на $password \r\n"
            ."Пожалуйста, учтите это при будущем входе в систему. \r\n";
          
    if (mail($email, 'Информация о входе в систему PHPBookmark', $mesg, $from))
      return true;      
    else
      throw new Exception('Не удается отправить электронную почту.'); 
  }
}

?>
