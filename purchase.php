<?php

  // �������� ��� ����� �������
  require ('book_sc_fns.php');
  // ��� �������������� ������� ���������� ��������� �����
  session_start();

  do_html_header("������������� ������");
  
  // ������� �������� ����� ����������
  $name = $_POST['name'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $zip = $_POST['zip'];
  $country = $_POST['country'];

  // ���� ����� ���������
  if($_SESSION['cart']&&$name&&$address&&$city&&$zip&&$country)
  {
    // ����� �� ��������� � ���� ������?
    if( insert_order($_POST)!=false )
    {
      // ������� ������� ��� ����������� ������� � �� �������� ���������
      display_cart($_SESSION['cart'], false, 0);

      display_shipping(calculate_shipping_cost());  

      // �������� ���������� �� ��������� ��������
      display_card_form($name);

      display_button('show_cart.php', 'continue-shopping', '���������� �������');  
    }
    else
    {
      echo '���������� ��������� ������. ����������, ��������� ������� �����.';
      display_button('checkout.php', 'back', '�����');
    }
  }
  else
  {
    echo '�� ��������� �� ��� ����. ����������, ��������� �������.<hr />';
    display_button('checkout.php', 'back', '�����');
  } 
 
  do_html_footer();
?>
