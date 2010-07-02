<?php
include ('./include/header.dat');
include ('./include/menu.dat');
GetMenu("/roads.php");
?>
    <div id="content">
        <div class="blockdata">
            <div class="titlecontainer">        
                <div class="title">Маршрут №5</div>
            </div>
            <div class="data">
                <center><img src="./roads/road_05.jpg" title="Маршрут №5: БКЗ-Татышева-Октябрьский мост-Авиаторов-9 мая-Комсомольски-Краснодарска-Партизана Железника-Октябырьски-Татышева-БКЗ" alt="Маршрут №5"/></center><br />
                <b>БКЗ-Татышева-Октябрьский мост-Авиаторов-9 мая-Комсомольски-Краснодарска-Партизана Железника-Октябырьски-Татышева-БКЗ</b><br />
            </div>
        </div>
        <a class="goback" href="<?php echo $_SERVER['HTTP_REFERER']?>" title="Назад">◀ Назад</a>
<?php
include ('./include/footer.dat');
?>