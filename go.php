<?php
//������ �������� ���: https://server.waphost.net/go.php?outsite=virt.omsknet.net
include ('./includ/head.dat');
if($_GET['outsite']==""){$_GET['outsite']='wap-motor.ru';}
echo '
<div class="title">��������....</div>
<div class="menu">
';
echo '�� ����������� �������� ���� <b>km.xclan.ru</b> � ������� �� ������ <b>http://'.$_GET["outsite"].'</b>.
<br />
<br /><b>�� ������������� ������� �� ������� ������?</b>';
echo '<br />---';
echo '<br />&nbsp;<a class="m" href="http://'.$_GET["outsite"].'">��, ������� �� ���������� ������</a>&nbsp;';
echo '<br />���'; 
echo '<br />&nbsp;<a class="m" href="../index.php">�� �������</a>';
echo '</div>';

include ('./includ/foot.dat');
?>