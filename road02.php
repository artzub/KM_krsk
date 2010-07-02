<?php
include ('./include/header.dat');
include ('./include/menu.dat');
GetMenu("/roads.php");
?>
    <div id="content">
        <div class="blockdata">
            <div class="titlecontainer"> 
                <div class="title">Маршрут №2</div>
            </div>
            <div class="data">
                <center><img src="./roads/road_02.jpg" title="Маршрут №2: БКЗ-Татышева-Октябрьский мост-Сибирский пер.-Корнетова-Волгоградская-Мичурина-Щорса-Павлова-Мичурина-Октябрьский мост-Тытышева-БКЗ" alt="Маршрут №2"/></center><br />
                <b>БКЗ-Татышева-Октябрьский мост-Сибирский пер.-Корнетова-Волгоградская-Мичурина-Щорса-Павлова-Мичурина-Октябрьский мост-Тытышева-БКЗ</b><br />
            </div>
        </div>
        <a class="goback" href="<?php echo $_SERVER['HTTP_REFERER']?>" title="Назад">◀ Назад</a>
<?php
include ('./include/footer.dat');
?>