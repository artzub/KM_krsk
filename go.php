<?php
//Ссылка выглядит как: https://server.waphost.net/go.php?outsite=virt.omsknet.net
include ('./includ/head.dat');
if($_GET['outsite']==""){$_GET['outsite']='wap-motor.ru';}
echo '
<div class="title">Редирект....</div>
<div class="menu">
';
echo 'Вы собираетесь покинуть сайт <b>km.xclan.ru</b> и перейти по адресу <b>http://'.$_GET["outsite"].'</b>.
<br />
<br /><b>Вы подтверждаете переход по внешней ссылке?</b>';
echo '<br />---';
echo '<br />&nbsp;<a class="m" href="http://'.$_GET["outsite"].'">Да, перейти по указанному адресу</a>&nbsp;';
echo '<br />или'; 
echo '<br />&nbsp;<a class="m" href="../index.php">На главную</a>';
echo '</div>';

include ('./includ/foot.dat');
?>