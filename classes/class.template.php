<?
include "class.io.php";
class Template
{
        var $handlerNS          = array();
        var $defaultTplEntity   = '%';
        var $templateContent;
        var $replaceItems       = array();

	public function __construct($template)
	{
		$io = new Io($template,"r");

		$this->templateContent = $io->GetContents();
		$io->Close();
	}

    public function AddTrigger($field, $handler)
    {
        $this->handlerNS[$field]['handler'] = $handler;
    }

    public function IsHandlerExistsFor($field)
    {
        if($this->handlerNS[$field]!=null)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function Trigger($val,$key)
    {
        return $this->handlerNS[$key]['handler']($val,$key);
    }

	/*
	$data = array of keys to replace
	*/
	public function FillTemplate($data, $content = null)
	{
            if($content!= null)
            {
                $str = $content;
            }
            else
            {
                $str = $this->templateContent;
            }
            foreach($data as $k => $v)
            {
                if(substr($k,0,1)==$this->defaultTplEntity)
                {
                    $str = str_replace($k, (($this->IsHandlerExistsFor($k))?$this->Trigger($v,$k):$v), $str);
                }
                else
                {
                    $str = str_replace($this->defaultTplEntity.$k, (($this->IsHandlerExistsFor($k))?$this->Trigger($v,$k):$v), $str);
                }
            }
            return $str;
	}


}

?>