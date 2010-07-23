<?
#
#   SystemLog - ability for logging in text files
#
#   copyright xternalx, 2008 - 2009
#
class SystemLog
{
    var $fileName;
    var $fileHandler;
    
    function SystemLog($filename,$mode)
    {
        $this->filename=$filename;
        $this->fileHandler = @fopen($this->filename,$mode);
        if(!$this->fileHandler)
            {
                unset($this);
                return false;
            }
        else
            return true;
    }
    
    function AddLine($line)
    {
        fputs($this->fileHandler,$line."\r\n");
    }
    
    function Add($line)
    {
        fputs($this->fileHandler,$line);
    }
    
    function Close()
    {
        fclose($this->fileHandler);
        unset($this);
    }
}
?>