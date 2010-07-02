<?php
include ('./includ/head.dat');

echo '<div class="title">ОШИБКА</div>';
echo '<div class="menu">';
echo '
<br /><b>ВНИМАНИЕ, ОШИБКА!</b>
<br />
<br /><b>Вы отказались от платежа</b>
<br />
<br /><b>или</b>
<br />
<br /><b>произошел системный сбой!!!</b>
<br />
<br /><b>Попробуйте повторить платеж!!!</b>
<br />
<br /><b><a class="m" href="./webmoney.php">попробовать ещё раз</a></b>
</div>
';
include ('./includ/foot.dat');
?>