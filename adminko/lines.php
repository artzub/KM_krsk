<?
    @session_start();
    
    if(!ses('enabled'))
    {
        die('e_session_not_allowed');
    }

    LoadClass('template');
    
    // вывести пункт лент новостей. так покороче будет, да попиздаче ;)
    function printNewsLines($id, $title)
    {
        echo '<li><a href="'.serv('PHP_SELF').'?module=lines&line='.$id.'&do=list">'.$title.'</a></li>';
    }
    
    // вывести содержимое определенной ленты новостей
    function printNewsLineItem($id, $lid, $title)
    {
        echo '<li><a href="'.serv('PHP_SELF').'?module=lines&line='.$lid.'&do=edit&id='.$id.'" title="Нажмите для редактирования">'.$title.'</a></li>';
    }
    
    // если не выбрана лента новостей, выводим список лент новстей
    // переменная $req определяется в файле cpl.php, и содержит в себе
    // отфильтрованные от всякого говна данные 
    if(!isset($req['line']))
    {
        // $sql определен в файле cpl.php
        $sql->Query("SELECT * FROM `k_news_lines` ORDER BY `l_id` ASC");
        echo "<ul>";
        while($r = $sql->Assoc())
        {
            printNewsLines($r['l_id'], $r['l_title']);
        }
        echo "</ul>";
    }
    else // иначе смотрим, что нас просят сделать в выбранной ленте
    {
        switch($req['do'])
        {
            case 'list':    // выводим список новостей в выбранной ленте новостей
            {
                echo '<div style="background-color: #c9c9c9"><a href="'.serv('PHP_SELF').'?module=lines&line='.get('line').'&do=make">Добавить</a></div>';
                $sql->Query("SELECT * FROM `k_news` WHERE `n_nline_id`=? ORDER BY `n_pos` ASC", $req['line']);

                echo "<ul>";
                while($r = $sql->Assoc())
                {
                    printNewsLineItem($r['n_id'], $r['n_nline_id'], $r['n_title']);
                }
                echo "</ul>";;
                break;
            }
            case 'edit';    // открываем редактор выбранной новости
            {
                $sql->Query("SELECT * FROM `k_news` WHERE `n_id`=? LIMIT 1", $req['id']);
                $r = $sql->Assoc();
                ?>  
                    <script type="text/javascript">
                        news = {
                            id: <?=get('id')?>,
                            line: <?=get('line')?>
                        }
                    </script>
                    <div>
                    [<a href="javascript:history.go(-1)">Назад</a>] <b>Редактирование</b>
                    <form name="newsedit" id="newsedit" action="linesactions.php" method="POST" onsubmit="return false">
                    <input type="hidden" name="hash" id="hash" value="<?=md5($r['n_title'])?>">
                    <input type="hidden" name="do" id="do" value="save">
                    <input type="hidden" name="id" id="id" value="<?=$req['id']?>">
                    <input type="text" name="pos" id="pos" value="<?=$r['n_pos']?>" title="Позиция записи в списке" style="width: 10%"/><input type="text" name="title" id="title" value="<?=$r['n_title']?>" style="width: 40%" title="Заголовок записи" /><br />
                    <textarea name="content" id="content"  style="width: 50%; height: 60%"><?=$r['n_content']?></textarea><br />
                    <button onclick="saveNews()">Сохранить</button> <button onclick="history.go(-1)">Отменить</button><button onclick="rmNews(<?=get('id')?>)">Удалить</button><span id="actionstat" style="display: none"><img id="loading" src="../img/loading.gif"><span id="actionstatmsg">Сохранение</span></span>
                    </form>
                    </div>
                <?
                break;
            }
            // 2 71 51 51 || 31 31
            case 'make';    // открываем редактор выбранной новости
            {
                ?>
                    <script type="text/javascript">
                        news = {
                            line: <?=get('line')?>
                        }
                    </script><div>
                    [<a href="javascript:history.go(-1)">Назад</a>] <b>Создание новости</b>
                    <form name="newsedit" id="newsedit" action="linesactions.php" method="POST" onsubmit="return saveNews()">
                    <input type="hidden" name="do" id="do" value="make">
                    <input type="hidden" name="nline" id="nline" value="<?=get('line')?>">
                    <input type="text" name="title" id="title" value="" style="width: 50%"/><br />
                    <textarea name="content" id="content"  style="width: 50%; height: 60%"></textarea><br />
                    <input type="submit" value="Сохранить" /><button onclick="history.go(-1)">Отменить</button><span id="actionstat" style="display: none"><img id="loading" src="../img/loading.gif"><span id="actionstatmsg">Сохранение</span></span>
                    </form>
                    </div>
                <?
                break;
            }
        }
    }
?>
