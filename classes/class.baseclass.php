<?php

/**
* Базовый класс для всех объектов системы
*/
class BaseClass
{
    /**
     *
     * @var mixed   ассоциативный массив с данными из таблицы
     */
    public $RawData;
    
    private $sql;
    
    public function __construct($sql = null)
    {
        $this->sql = $sql->GetInstance();
    }

}

?>
