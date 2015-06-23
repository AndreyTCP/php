<html>
<head>
  <title>������� ������� � �����</title>
</head>
<body>
<h1>������� ������� � ����� :</h1>
<?php
  // �������� �������� ���� ����������
  $searchtype=$_POST['searchtype'];
  $searchterm=$_POST['searchterm'];

  $searchterm= trim($searchterm);

  if (!$searchtype || !$searchterm)
  {
     echo '�� �� ����� ��������� ������.  ����������, ��������� �� ���������� �������� � ��������� ����.';
     exit;
  }
  
  if (!get_magic_quotes_gpc())
  {
    $searchtype = addslashes($searchtype);
    $searchterm = addslashes($searchterm);
  }
//������������ � ��
  @ $db = new mysqli('localhost', 'book_sc', 'password', 'book_sc');

  if (mysqli_connect_errno()) 
  {
     echo '������: �� ������� ���������� ���������� � ����� ������. ����������, ��������� ������� �����.';
     exit;
  }

  $query = "select * from books,categories where ".$searchtype." like '%".$searchterm."%'";
  $result = $db->query($query);

  $num_results = $result->num_rows;

  echo '<p>������� ����: '.$num_results.'</p>';

  for ($i=0; $i <$num_results; $i++)
  {
     $row = $result->fetch_assoc();
     echo '<p><strong>'.($i+1).'. ��������: ';
     echo htmlspecialchars(stripslashes($row['title']));
     echo '</strong><br />�����: ';
     echo stripslashes($row['author']);
     echo '<br />ISBN: ';
     echo stripslashes($row['isbn']);
     echo '<br />����: ';
     echo stripslashes($row['price']);
	 echo '<br />��������� ';
     echo stripslashes($row['catname']);
	 echo '<br />�������� ';
     echo stripslashes($row['description']);
     echo '</p>';
  }
  
  $result->free();
  $db->close();

?>
</body>
</html>
