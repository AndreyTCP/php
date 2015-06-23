<?php

function do_html_header($title = '')
{
  // ������� HTML-���������
 
  // �������� ���������� ������
  if(!$_SESSION['items']) $_SESSION['items'] = '0';
  if(!$_SESSION['total_price']) $_SESSION['total_price'] = '0.00';
?>
  <html>
  <head>
  <link href="css/style.css" rel="stylesheet" type="text/css" />
    <title><?php echo $title; ?></title>
    <style>
      h2 { font-family: Arial, Helvetica, sans-serif; font-size: 22px; color = red; margin = 6px }
      body { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      li, td { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      hr { color: #FF0000; width=70%; text-align=center}
      a { color: #000000 }
    </style>
  </head>
  <body>
  <div id="top-line"></div>

<div id="header1">
    <div id="top-menu">
        <a href="#">� ��������</a>
        
        <a href="#">������� �������</a>
        
        <a href="#">������ � ��������</a>
        
        <a href="#">��������</a>
        
          
    </div>
	<div id="top-menu1">
	<a href="login_user.php">�����</a> 
	           ���
	<a href="register_form.php">������������������</a>
	</div>
  
  <div id="header2">	
	
    <a id="logo" href = 'index.php'></a>
    
    <div id="call1">
	
        �������� ������� ���������������<br> ������� ����� �������
    </div>
	<div id="icon"><a href="#"><img src="userfiles/V.png" alt="" /></a>
	</div>
    <div id="call2">
	    �� �������������� ���������� �����<br> 1000 ������� �������
	</div>
	<div id="icon"><a href="#"><img src="userfiles/ph.png" alt="" /></a>
	</div>
	<div id="call3">
	    8(097)097097097</br> �������� �������� ������
	</div>
	
    
    
    <div id="search">
        <form action="results.php" method="post" action=""id="search-form">
            <input type="text" name="searchterm" value="" >
            <input type="submit" name="" value=" " >		
            <select name="searchtype" id="selection" >
			<option value="">�������� ������</option>
            <option value="author">�� �������������</option>
            <option value="title">�� ��������</option>
            <option value="isbn">�� ISBN</option>
	        <option value="description">�� ��������</option>
            </select>
        </form>
	</div>
    
	
    <div id="call4">
     <?php if(isset($_SESSION['admin_user']))
       echo '&nbsp;';
     else
       echo '����� ����� = $'.number_format($_SESSION['total_price'],2); 
  ?></br> <?php if(isset($_SESSION['admin_user']))
       echo '&nbsp;';
     else
       echo '����� ���� = '.$_SESSION['items']; 
  ?>
	</div>
    <div id="icon2"><a href="#"><img src="userfiles/crt.png" alt="" />
	<?php if(isset($_SESSION['admin_user']))
       display_button('logout.php', 'log-out', '�����');
     else
       display_button1('show_cart.php', 'crt', '�������� �������');
    ?>
	</a>
	</div>
	
	</div>
	
	<div id="header3">
<hr>   <a href="#">������� </a> - <a href="#">����������� </a> - <a href="#"> ���������</a> - <a href="#">��� ����� �����</a>
</div>
<?php
  if($title)
    do_html_heading($title);
}

function do_html_footer()
{
  // ������� ����������� HTML-�����������
?>
  
<div id="footer">
    <div id="footer1">
    <div id="footer-menu">
        <a href="#">������� �������</a>
        <div class="top-menu-line"></div>
        <a href="#">���� �� ��������</a>
        <div class="top-menu-line"></div>
        <a href="#">�����������</a>
		<div class="top-menu-line"></div>
        <a href="#">����������� ������ � ������</a>
		<div class="top-menu-line"></div>
        <a href="#">��������</a>
		  <div class="top-menu-line"></div>
        <a href="#">�������������</a>
		  <div class="top-menu-line"></div>
        <a href="#">����������� � ����������</a>
    </div>
    </div>
	<div id="footer1">
    <div id="footer-menu">
        <a href="#">��������, �������������</a>
        <div class="top-menu-line"></div>
        <a href="#">����������� ���������</a>
        <div class="top-menu-line"></div>
        <a href="#">���������</a>
		<div class="top-menu-line"></div>
        <a href="#">���������������</a>
		<div class="top-menu-line"></div>
        <a href="#">�������</a>
		
    </div>
    </div>
	<div id="footer1">
    <div id="footer-menu">
        <a href="#">��������</a>
        <div class="top-menu-line"></div>
        <a href="#">�������� �������� ������</a>
		<a href="#"><img src="userfiles/phone.png" alt="" /></a>
        <div class="top-menu-line"></div>
        <a href="#">��������</a>
		<a href="#"><img src="userfiles/email.png" alt="" /></a>
    </div>
    </div>
	<div id="footer1">
    <div id="footer-menu">
        <a href="#">������� ������</a>
        <div class="top-menu-line"></div>
        <a href="#"><img src="userfiles/visa.png" alt="" /></a>
        <div class="top-menu-line"></div>
        <a href="#">����������� �� ������</a>
		<div id="search1">
        <form method="post" action="" id="search-form1">
            <input type="text" name="" value="��� email @" >
            <input type="submit" name="" value=" " >
        </form>
    </div>
    </div>
    </div>
  </body>
  </html>
<?php
}

function do_html_heading($heading)
{
  // ������� ���������
?>
  <h2><?php echo $heading; ?></h2>
<?php
}

function do_html_URL($url, $name)
{
  // ������� URL � ���� ������ � ���������� ����� ������
?>


            <a href="<?php echo $url; ?>"> <?php echo $name; ?></a>  
        
  
  
<?php
}
/*�������� ��������� �����*/
function display_categories($cat_array)
{
  if (!is_array($cat_array))
  {
     echo '� ��������� ������ ��� ��������� ���������<br />';
     return;
  }
 
  foreach ($cat_array as $row)
  {
    $url = 'show_cat.php?catid='.($row['catid']);
    $title = $row['catname']; 
    
    do_html_url($url, $title); 
    
  }    

  
}

function display_books($book_array)
{

  // ������� ��� �����, ���������� � �������
  if (!is_array($book_array))
  {
     echo '<br />� ��������� ������ ��� ��������� ���� � ���� ���������<br />';
  }
  else
  {
    // ������� �������
    echo '<div id="rightblock">';
    
    // ������� ������ ������� ��� ������ ����� 
    foreach ($book_array as $row)
    {
      $url = 'show_book.php?isbn='.($row['isbn']);
      echo '<div class="product">';
      if (@file_exists('images/'.$row['isbn'].'.jpg'))
      {
        $title = '<img src=\'images/'.($row['isbn']).'.jpg\' border=0 />';
        do_html_url($url, $title);
      }
      else
      {
        echo '&nbsp;';
      }
      echo '<a href="#" class="product-title">';
      $title =  $row['title'].' by '.$row['author'].' by '.$row[price];
      do_html_url($url, $title);
      echo '</a><a href="#" class="to-cart">� �������</a></div>';
    }
    echo '</div>';
  }
  echo '<hr />';
}

function display_book_details($book)
{
  // ������� ��������� ���������� �� ���������� �����
  if (is_array($book))
  {
    echo '<table><tr>'; 
    // ������� ����������� �������, ���� ��� ������� 
    if (@file_exists('images/'.($book['isbn']).'.jpg'))
    {
      $size = GetImageSize('images/'.$book['isbn'].'.jpg');
      if($size[0]>0 && $size[1]>0)
        echo '<td><img src=\'images/'.$book['isbn'].'.jpg\' border=0 '.$size[3].'></td>';
    }
    echo '<td><ul>';
    echo '<li><b>�����:</b> ';
    echo $book['author'];
    echo '</li><li><b>ISBN:</b> ';
    echo $book['isbn'];
    echo '</li><li><b>���� ����:</b> ';
    echo number_format($book['price'], 2);
    echo '</li><li><b>���������:</b> ';
    echo $book['description'];
    echo '</li></ul></td></tr></table>'; 
  }
  else
    echo '���������� ������� �������� � ������ �����.';
  echo '<hr />';
}

function display_checkout_form()
{
  // ������� �����, ������� ����������� ��� � �����
?>
  <br />
  <table border = 0 width = '100%' cellspacing = 0>
  <form action = 'purchase.php' method = 'post'>
  <tr><th colspan = 2 bgcolor='#cccccc'>���������� � ���</th></tr>
  <tr>
    <td>���</td>
    <td><input type = 'text' name = 'name' value = "" maxlength = 40 size = 40></td>
  </tr>
  <tr>
    <td>�����</td>
    <td><input type = 'text' name = 'address' value = "" maxlength = 40 size = 40></td>
  </tr>
  <tr>
    <td>�����/����</td>
    <td><input type = 'text' name = 'city' value = "" maxlength = 20 size = 40></td>
  </tr>
  <tr>
    <td>�������</td>
    <td><input type = 'text' name = 'state' value = "" maxlength = 20 size = 40></td>
  </tr>
  <tr>
    <td>�������� ������</td>
    <td><input type = 'text' name = 'zip' value = "" maxlength = 10 size = 40></td>
  </tr>
  <tr>
    <td>������</td>
    <td><input type = 'text' name = 'country' value = "" maxlength = 20 size = 40></td>
  </tr>
  <tr><th colspan = 2 bgcolor='#cccccc'>����� ��� �������� (�� ���������� ����, ���� ��������� � ��������� ����)</th></tr>
  <tr>
    <td>���</td>
    <td><input type = 'text' name = 'ship_name' value = "" maxlength = 40 size = 40></td>
  </tr>
  <tr>
    <td>�����</td>
    <td><input type = 'text' name = 'ship_address' value = "" maxlength = 40 size = 40></td>
  </tr>
  <tr>
    <td>�����/����</td>
    <td><input type = 'text' name = 'ship_city' value = "" maxlength = 20 size = 40></td>
  </tr>
  <tr>
    <td>�������</td>
    <td><input type = 'text' name = 'ship_state' value = "" maxlength = 20 size = 40></td>
  </tr>
  <tr>
    <td>�������� ������</td>
    <td><input type = 'text' name = 'ship_zip' value = "" maxlength = 10 size = 40></td>
  </tr>
  <tr>
    <td>������</td>
    <td><input type = 'text' name = 'ship_country' value = "" maxlength = 20 size = 40></td>
  </tr>
  <tr>
    <td colspan = 2 align = 'center'>
      <b>����������, �������� �� ������ "Purchase" ��� ����, ����� ����������� �������,
         ���� �� ������ "Continue Shopping" ��� ����������� �������.</b> 
     <?php display_form_button('purchase', '���������� ���������'); ?>
    </td>
  </tr>
  </form>
  </table><hr />
<?php
}

function display_shipping($shipping)
{
  // ������� ������ ������� �� ���������� �������� � ����� ���������� ������, ������� ��������
?>
  <table border = 0 width = '100%' cellspacing = 0>
  <tr><td align = 'left'>��������</td>
      <td align = 'right'> <?php echo number_format($shipping, 2); ?></td></tr>
  <tr><th bgcolor='#cccccc' align = 'left'>�����, ������� ��������</th>
      <th bgcolor='#cccccc' align = 'right'>$<?php echo number_format($shipping+$_SESSION['total_price'], 2); ?></th>
  </tr>
  </table><br />
<?php
}

function display_card_form($name)
{
  // ������� �����, ������������� �������� � ��������� ��������
?>
  <table border = 0 width = '100%' cellspacing = 0>
  <form action = 'process.php' method = 'post'>
  <tr><th colspan = 2 bgcolor="#cccccc">�������� � ��������� ��������</th></tr>
  <tr>
    <td>���</td>
    <td><select name = 'card_type'><option>VISA<option>MasterCard<option>American Express</select></td>
  </tr>
  <tr>
    <td>�����</td>
    <td><input type = 'text' name = 'card_number' value = "" maxlength = 16 size = 40></td>
  </tr>
  <tr>
    <td>AMEX-��� (���� ���������)</td>
    <td><input type = 'text' name = 'amex_code' value = "" maxlength = 4 size = 4></td>
  </tr>
  <tr>
    <td>���� ���������</td>
    <td>����� <select name = 'card_month'><option>01<option>02<option>03<option>04<option>05<option>06<option>07<option>08<option>09<option>10<option>11<option>12</select>
    ��� <select name = 'card_year'><option>00<option>01<option>02<option>03<option>04<option>05<option>06<option>07<option>08<option>09<option>10</select></td>
  </tr>
  <tr>
    <td>��������� ��������</td>
    <td><input type = 'text' name = 'card_name' value = "<?php echo $name; ?>" maxlength = 40 size = 40></td>
  </tr>
  <tr>
    <td colspan = 2 align = 'center'>
      <b>����������, �������� �� ������ "Purchase" ��� ����, ����� ����������� �������,
         ���� �� ������ "Continue Shopping" ��� ����������� �������.</b> 
     <?php display_form_button('purchase', '���������� ���������'); ?>
    </td>
  </tr>
  </table>
<?php
}

function display_cart($cart, $change = true, $images = 1)
{
  // ������� ��������, ����������� � �������������� �������.
  // ������������� �������� �������� $change, ����������� (true)
  // ��� ����������� (false) �������� ���������.
  // ������������� �������� �������� $images, ����������� (true)
  // ��� ����������� (false) ����� ����������� �������.

  echo '<table border="0" width="100%" cellspacing="0">
        <form action="show_cart.php" method="post">
        <tr><th colspan="'. (1+$images) .'" bgcolor="#cccccc">�����</th>
        <th bgcolor="#cccccc">����</th><th bgcolor="#cccccc">����������</th>
        <th bgcolor="#cccccc">�����</th></tr>';

  // ���������� ������ ������� � ���� ������ �������
  foreach ($cart as $isbn => $qty)
  {
    $book = get_book_details($isbn);
    echo '<tr>';
    if($images ==true)
    {
      echo '<td align="left">';
      if (file_exists("images/$isbn.jpg"))
      {
         $size = GetImageSize('images/'.$isbn.'.jpg');  
         if($size[0]>0 && $size[1]>0)
         {
           echo '<img src="images/'.$isbn.'.jpg" border=0 ';
           echo 'width = '. $size[0]/3 .' height = ' .$size[1]/3 . '>';
         }
      }
      else
         echo '&nbsp;';
      echo '</td>';
    }
    echo '<td align="left">';
    echo '<a href="show_book.php?isbn='.$isbn.'">'.$book['title'].
         '</a> by '.$book['author'];
    echo '</td><td align="center">$'.number_format($book['price'], 2);
    echo '</td><td align="center">';
    // ���� ��������� ���������, ����������� ���������� � ��������� ����� �����
    if ($change == true)
      echo "<input type='text' name=\"$isbn\" value=\"$qty\" size=\"3\">";
    else
      echo $qty;
    echo '</td><td align="center">$'.number_format($book['price']*$qty,2).
         "</td></tr>\n";

  }
  // ������� ������ ������ ���������� � ����� ������
  echo "<tr>
          <th colspan=". (2+$images) ." bgcolor=\"#cccccc\">&nbsp;</td>
          <th align = \"center\" bgcolor=\"#cccccc\"> 
              ".$_SESSION['items']."
          </th>
          <th align = center bgcolor=\"#cccccc\">
              \$".number_format($_SESSION['total_price'], 2).
          '</th>
        </tr>';
  // ������� ������ ���������� ���������
  if($change == true)
  {
    echo '<tr>
            <td colspan="'. (2+$images) .'">&nbsp;</td>
            <td align="center">
              <input type="hidden" name="save" value="true">  
              <input type="image" src="images/save-changes.gif" 
                     border="0" alt="��������� ���������">
            </td>
            <td>&nbsp;</td>
        </tr>';
  }
  echo '</form></table>';
}

function display_login_form()
{
  // ������� �����, ������������� ��� ������������ � ������
?>
  <form method='post' action="admin.php">
 <table bgcolor='#cccccc'>
   <tr>
     <td>��� ������������:</td>
     <td><input type='text' name='username'></td></tr>
   <tr>
     <td>������:</td>
     <td><input type='password' name='passwd'></td></tr>
   <tr>
     <td colspan=2 align='center'>
     <input type='submit' value="�����"></td></tr>
   <tr>
 </table></form>
<?php
}

// ����������� �������������
function display_login_form_user()
{
?>
  <a href='register_form.php'>������������������</a>
  <form method='post' action='member.php'>
  <table bgcolor='#cccccc'>
   <tr>
     <td colspan=2>���� ��� ������������������ �������������:</td>
   <tr>
     <td>���:</td>
     <td><input type='text' name='name'></td></tr>
   <tr>
     <td>������:</td>
     <td><input type='password' name='passwd'></td></tr>
   <tr>
     <td colspan=2 align='center'>
     <input type='submit' value='����'></td></tr>
   <tr>
     <td colspan=2><a href='forgot_form.php'>������ ������?</a></td>
   </tr>
 </table></form>
<?php
}
function display_admin_menu()
{
?>
<br />
<a href="index.php">������� �� �������� ����</a><br />
<a href="insert_category_form.php">�������� ����� ���������</a><br />
<a href="insert_book_form.php">�������� ����� �����</a><br />
<a href="change_password_form.php">�������� ������ ��������������</a><br />
<?php

}

function display_button1($target, $image, $alt)
{
  echo "<center><a href=\"$target\"><img src=\"images/$image".".gif\" 
           alt=\"$alt\" border=0 height = 40 width = 40></a></center>";
}
function display_button($target, $image, $alt)
{
  echo "<center><a href=\"$target\"><img src=\"images/$image".".gif\" 
           alt=\"$alt\" border=0 height = 50 width = 135></a></center>";
}

function display_form_button($image, $alt)
{
  echo "<center><input type = image src=\"images/$image".".gif\" 
           alt=\"$alt\" border=0 height = 50 width = 135></center>";
}





function display_registration_form()
{
?>
 <form method='post' action='register_new.php'>
 <table bgcolor='#cccccc'>
   <tr>
     <td>����� ����������� �����:</td>
     <td><input type='text' name='email' size=30 maxlength=100></td></tr>
   <tr>
     <td>�������������� ��� <br />(�� 16 ��������):</td>
     <td valign='top'><input type='text' name='name' size=16 maxlength=16></td></tr>
	   
 <tr>
     <td>������ <br />(�� 16 ��������):</td>
     <td valign='top'><input type='text' name='address' size=16 maxlength=16></td></tr>
 <tr>
     <td>����� <br />(�� 16 ��������):</td>
     <td valign='top'><input type='text' name='city' size=16 maxlength=16></td></tr>
	 <tr>
     <td>������� <br />(�� 16 ��������):</td>
     <td valign='top'><input type='text' name='state' size=16 maxlength=16></td></tr>
	 <tr>
     <td>������<br />(�� 16 ��������):</td>
     <td valign='top'><input type='text' name='zip' size=16 maxlength=16></td></tr>
	 <tr>
     <td>������ <br />(�� 16 ��������):</td>
     <td valign='top'><input type='text' name='country' size=16 maxlength=16></td></tr>
	<tr> 
     <td>������ <br />(����� 6 ��������):</td>
     <td valign='top'><input type='password' name='passwd'
                     size=16 maxlength=16></td></tr>
   <tr>
     <td>������������� ������:</td>
     <td><input type='password' name='passwd2' size=16 maxlength=16></td></tr>
   <tr>
     <td colspan=2 align='center'>
     <input type='submit' value='������������������'></td></tr>
 </table></form>
<?php 

}

function display_password_form_user()
{
  // ������� HTML-����� ��������� ������
?>
   <br />
   <form action='change_passwd.php' method='post'>
   <table width=250 cellpadding=2 cellspacing=0 bgcolor='#cccccc'>
   <tr><td>������ ������:</td>
       <td><input type='password' name='old_passwd' size=16 maxlength=16></td>
   </tr>
   <tr><td>����� ������:</td>
       <td><input type='password' name='new_passwd' size=16 maxlength=16></td>
   </tr>
   <tr><td>������������� ������<br/>������:</td>
       <td><input type='password' name='new_passwd2' size=16 maxlength=16></td>
   </tr>
   <tr><td colspan=2 align='center'><input type='submit' value='�������� ������'>
   </td></tr>
   </table>
   <br />
<?php
};

function display_forgot_form()
{
  // ����� HTML-����� ��� ������������� � �������� ������ �� ����������� �����
?>
   <br />
   <form action='forgot_passwd.php' method='post'>
   <table width=250 cellpadding=2 cellspacing=0 bgcolor='#cccccc'>
   <tr><td>������� ���:</td>
       <td><input type='text' name='username' size=16 maxlength=16></td>
   </tr>
   <tr><td colspan=2 align='center'><input type='submit' value='�������������� ������'>
   </td></tr>
   </table>
   <br />
<?php
};


function display_user_menu()
{
  // ������� ���� ����� ��� ������ ��������
?>
<hr />
<a href="member.php">�����</a> &nbsp;|&nbsp;


<a href="change_passwd_form.php">�������� ������</a>
<br />

<a href="logout_user.php">�����</a> 
<hr />

<?php
}

function display_user_urls($url_array)
{
  // ������� ������� URL-�������

  // ���������� ���������� ����������, ����� ������������ ���������, 
  // ��������� �� �� �� ������ ��������
  global $bm_table;
  $bm_table = true;
?>
  <br />
  <form name='bm_table' action='' method='post'>
  <table align= center><tr>
  <td ><table width=200px height=300 bgcolor="#F5F5F5"><tr><td ></td></tr></table></td>
  <td ><table width=200px height=300 bgcolor="#F5F5F5"><tr><td ></td></tr></table></td>
  <td>
  <table width=400 cellpadding=2 cellspacing=0 border="" bordercolor="#ffffff">
  <?php
  $color = "#F5F5F5";
  echo "<tr bgcolor='$color'><td height=40px><strong>���� ������������ ������</strong></td>";
  
  if (is_array($url_array) && count($url_array)>0)
  {
    foreach ($url_array as $url)
    {
      
      // ����������� ������� htmlspecialchars() ��� ������ ���������������� ������
      echo "<tr bgcolor='$color'><td height=40px><a href=\"$url\">".htmlspecialchars($url)."</a></td>";
      
      echo "</tr>"; 
    }
  }
  else
    echo "<tr><td>��� ����������� ��������</td></tr>";
?>
  </td></tr></tr>
  </table> 
  </table>
  </form>
<?php
}
     
      
    
    

 
    



