<?php
$c4et = rand(1111,9999);
include ('./includ/head.dat');

echo '<form id="pay" method="post" action="https://merchant.webmoney.ru/lmi/payment.asp">';
echo '<div class="title">���������� ������</div>';
echo '<div class="menu">';
echo '����� (WMR):<br />';
echo '<input type="text" name="LMI_PAYMENT_AMOUNT" title="������� �����, ������� �� ������ ������������ �� �������� ������� �����."value="100.0"/>';
echo '<br /><br />';
echo '��������� ��� ������:<br />';
echo '<input type="text" name="LMI_PAYMENT_DESC" title="������� ���� ��� � ������ ������, ��� ���� ��� �� �� ����� ��� ������� ������� �� �������� �������������." value="���: , �����: , ����������: , IP: '.$REMOTE_ADDR.'"/>';
echo '<br /><br />';
echo '<input type="hidden" name="LMI_SUCCESS_URL" value="http://wap-motor.ru/success.php"/>';
echo '<input type="hidden" name="LMI_FAIL_URL" value="http://wap-motor.ru/fail.php"/>';
echo '<input type="hidden" name="LMI_SUCCESS_METHOD" value="GET"/>';
echo '<input type="hidden" name="LMI_FAIL_METHOD" value="GET"/>';
echo '<input type="hidden" name="LMI_PAYMENT_NO" value="'.$c4et.'"/>';
echo '<input type="hidden" name="LMI_PAYEE_PURSE" value="R339115137350"/>';
echo '<input type="submit" value=" ���������� "/>';
echo '<br /><br /></div></form>';

include ('./includ/foot.dat');
?>