<?php
include ('./include/header.dat');
include ('./include/menu.dat');
GetMenu("/roads.php");
?>
    <div id="content">
        <div class="blockdata">
            <div class="titlecontainer">                
                <div class="title">Маршрут №3</div>
            </div>
            <div class="data">
                <center><img src="./roads/road_03.jpg" title="Маршрут №3: БКЗ-Мира-Музкомедии-Мира-Вейнбаума-Комунальный мост-Красраб-Московская-Мичуриа-Октябрьский мост-Татышева-БКЗ" alt="Маршрут №3"/></center><br />
                <b>БКЗ-Мира-Музкомедии-Мира-Вейнбаума-Комунальный мост-Красраб-Московская-Мичуриа-Октябрьский мост-Татышева-БКЗ</b><br />
            </div>
        </div>
        <a class="goback" href="<?php echo $_SERVER['HTTP_REFERER']?>" title="Назад">◀ Назад</a>
<?php
include ('./include/footer.dat');
?>