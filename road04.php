<?php
include ('./include/header.dat');
include ('./include/menu.dat');
GetMenu("/roads.php");
?>
    <div id="content">
        <div class="blockdata">
            <div class="titlecontainer">        
                <div class="title">Маршрут №4</div>
            </div>
            <div class="data">
                <center><img src="./roads/road_04.jpg" title="Маршрут №4: БКЗ - о.Татышева - Октябрьский мост - Сибирский переулок - Крас.Рабочий - Предмостная площадь - Коммунальный мост - Вейнбаума - Проспект Мира - БКЗ" alt="Маршрут №4"/></center><br />
                <b>БКЗ - о.Татышева - Октябрьский мост - Сибирский переулок - Крас.Рабочий - Предмостная площадь - Коммунальный мост - Вейнбаума - Проспект Мира - БКЗ</b><br />
                p.s.-Данный маршрут является практически копией маршрута №3, только в обратном направлении. И без заезда на Муз.Комедию (что бы не мешать движению левым поворотом с Вейнбаума на Мира)<br />
            </div>
        </div>
        <a class="goback" href="<?php echo $_SERVER['HTTP_REFERER']?>" title="Назад">◀ Назад</a>
<?php
include ('./include/footer.dat');
?>