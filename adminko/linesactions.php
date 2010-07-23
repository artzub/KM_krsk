<?
    @session_start();
    error_reporting(E_WARNING & E_ERROR);
    header('Content-Type: text/html; charset=utf-8');
    include '../conf.php';
    
    if(@!ses('enabled'))
    {
        die('e_session_not_allowed');
    }
    
    $sql = new MySQL();
    $sql->connect($cfg['db_host'],$cfg['db_user'],$cfg['db_password'],$cfg['db_db']);

    if($sql->isError) 
    {
        RaiseError('e_db_is_not_connected');
        exit;
    }
    $sql->SetEncoding("utf8");
    
    switch(post('do'))
    {
        default: echo 'e_unknown_action'; break;
        case "save":
        {
            $sql->Query("UPDATE `k_news`
                        SET `n_pos`=?, `n_title`=?, `n_content`=?, `n_manager_id`=?
                        WHERE MD5(`n_title`)=? AND `n_id`=?", array( post('pos'), post('title'), post('content'), ses('m_id'), post('hash'), post('id')));
            if(!$sql->isError)
            {
                echo 'ok';
            }
            else
            {
                echo 'e_epic_fail';
            }
            break;
        }
        
        case "make":
        {
            $d = array();
            $d['n_pos']         = $sql->Execute("SELECT MAX(`n_pos`)+1 AS `last_pos` FROM `k_news`")->Assoc('last_pos');
            $d['n_title']       = post('title');
            $d['n_content']     = post('content');
            $d['n_manager_id']  = ses('m_id');
            $d['n_nline_id']    = post('nline');
            $d['n_timestamp']   = time();
            $sql->Insert('k_news',$d);
            unset($d);
            if(!$sql->isError)
            {
                echo 'ok';
            }
            else
            {
                echo 'e_epic_fail';
            }
            
            break;
        }

        case "rm":
        {
            $sql->Query("DELETE FROM `k_news` WHERE n_id=? LIMIT 1", post('n_id'));
            if(!$sql->isError)
            {
                echo 'ok';
            }
            else
            {
                echo 'e_epic_fail';
            }
            break;
        }
    }
    
?>
