<html>
<head>
  <title>Магазин товаров и услуг</title>
</head>
<body>
<h1>Магазин товаров и услуг :</h1>
<?php
  // создание коротких имен переменных
  $searchtype=$_POST['searchtype'];
  $searchterm=$_POST['searchterm'];

  $searchterm= trim($searchterm);

  if (!$searchtype || !$searchterm)
  {
     echo 'Вы не ввели параметры поиска.  Пожалуйста, вернитесь на предыдущую страницу и повторите ввод.';
     exit;
  }
  
  if (!get_magic_quotes_gpc())
  {
    $searchtype = addslashes($searchtype);
    $searchterm = addslashes($searchterm);
  }
//подключаемся к БД
  @ $db = new mysqli('localhost', 'book_sc', 'password', 'book_sc');

  if (mysqli_connect_errno()) 
  {
     echo 'Ошибка: Не удалось установить соединение с базой данных. Пожалуйста, повторите попытку позже.';
     exit;
  }

  $query = "select * from books,categories where ".$searchtype." like '%".$searchterm."%'";
  $result = $db->query($query);

  $num_results = $result->num_rows;

  echo '<p>Найдено книг: '.$num_results.'</p>';

  for ($i=0; $i <$num_results; $i++)
  {
     $row = $result->fetch_assoc();
     echo '<p><strong>'.($i+1).'. Название: ';
     echo htmlspecialchars(stripslashes($row['title']));
     echo '</strong><br />Автор: ';
     echo stripslashes($row['author']);
     echo '<br />ISBN: ';
     echo stripslashes($row['isbn']);
     echo '<br />Цена: ';
     echo stripslashes($row['price']);
	 echo '<br />Категория ';
     echo stripslashes($row['catname']);
	 echo '<br />Описание ';
     echo stripslashes($row['description']);
     echo '</p>';
  }
  
  $result->free();
  $db->close();

?>
</body>
</html>
