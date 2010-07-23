<?
class Io
{
    public    $FileName;            #    opened file name
    public     $FileSize = null;    #    opened file size
    private    $h;            		#    file handler
    /**
     * @param     $filename     string     Path to file
     * @param     $mode         string     File access mode (see fopen() modes)
     * @return    				mixed      If file exists and open, return
     */
    public function __construct($filename,$mode,$port = null)
    {
        $this->FileName = $filename;

        if($port == null)
        {
            if(file_exists($filename))
            {
                $this->h = $this->Open($filename, $mode, $port);
                if($this->h)
                {
                    $this->FileSize = $this->GetSize();
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            $this->h = $this->Open($filename, $mode, $port);
        }
    }

    /**
     * @method    void    Destructor
     */
    public function __destruct()
    {
        $this->Close();
    }

    /**
     * @method    bool    Open passed file
     */
    public function Open($filename, $mode, $port)
    {
        if($port == null)
        {
            return @fopen($filename, $mode);
        }
        else
        {
            return fsockopen($filename, $port);
        }
    }

    /**
     * @method    bool    Close currently opened file
     */
    public function Close()
    {
        return @fclose($this->h);
    }

    /**
     * @method    bool    Close passed file handle
     */
    public function CloseFile($handle)
    {
        return @fclose($handle);
    }

    /**
     * @method    bool    Flush currently opened file
     */
    public function Flush()
    {
        return @fflush($this->h);
    }

    /**
     * @method    bool    If File is created and open, return TRUE, else FALSE
     */
    public function IsCreated()
    {
        if(!$this->h)
        	return false;
        else
        	return true;
    }

    /**
     * @method    string    Return file content
     */
    public function GetContents()
    {
        return @fread($this->h, $this->FileSize);
    }

    /**
     * @method    int        Return currently opened file size
     */
    public function GetSize()
    {
        if(!$this->FileSize)
        {
            $this->FileSize = @filesize($this->FileName);
            return $this->FileSize;
        }
        else
        {
            return $this->FileSize;
        }
    }

    /**
     * @method    int        Return external file size
     */
    public function GetFileSize($file)
    {
        return @filesize($file);
    }

    /**
     * @method            int		Writes line to file and return number of lines written
     * @param    $line    string	Text to be written
     */
    public function WriteLine($line)
    {
        return @fwrite($this->h,$line."\r\n");
    }

    /**
     * @method            int		Writes text to file and return bytes written
     * @param    $data    string	Text to be written
     * */
    public function Write($data)
    {
        return @fwrite($this->h,$data);
    }

    /**
     * @method    string    Read line and return it
     */
    public function ReadLine()
    {
        return @fgets($this->h);
    }

    /**
     * @method    			string		Read text from file with length $length
     * @param    $length    int    		Block length
     */
    public function Read($length)
    {
        return @fread($this->h,$length);
    }

    /**
     * @method              int        Seek file (see fseek() help)
     * @param	$offset		int        Seek offset
     * @param	$mode		int        Seek mode (see fseek() help)
     */
    public function Seek($offset, $mode = 'cur')
    {
        $r='';
        switch(strtolower($mode))
        {
            case 'fromcurrent': $r = @fseek($this->h,$offset,SEEK_CUR); break;
            case 'fromeof': $r = @fseek($this->h,$offset,SEEK_END); break;
            case 'cur': $r = @fseek($this->h,$offset,SEEK_SET); break;
        }
        return $r;
    }

    /**
     * @method    string Returns error messages if exists
     */
    public function GetErrorMessage()
    {
        return error_get_last();
    }

    /**
     * @method    mixed    Delete currently opened file
     */       
    public function Delete()
    {
        if($this->Close())
            return @unlink($this->FileName);    	#    Current file closed and removed?
        else
            return -1;                            	#    Current file not closed and not deleted
    }

    /**
     * @method    bool                		Delete external file
     * @param     string     $filename		Path to file
     */
    public function DeleteFile($filename)
    {
        return @unlink($filename);
    }

    /**
     * @method    bool                    Copy current file to $destination
     * @param    string    $destination    File destination
     */
    public function CopyTo($destination)
    {
        return @copy($this->FileName, $destination);
    }

    /**
     * @method  bool                    Copy external file
     * @param	string	$source         Source file
     * @param   string	$destination    Destination file
     */
    public function CopyFileTo($source, $destination)
    {
        return @copy($source, $destination);
    }

    /**
     * @method   int                       Move currently opened file
     * @param    string    $destination    Destination file
     */
    public function MoveTo($destination)
    {
        if($this->CopyTo($destination))
        {
            if($this->Delete())
            {
                return 0;        #    File moved
            }
            return 1;            #    File copied but source not deleted
        }
        return 2;                #    Source file not copied and not deleted
    }

    /**
     * @method  bool                    Move external file
     * @param	string	$source         Source file
     * @param	string	$destination	Destination file
     */
    public function MoveFileTo($source, $destination)
    {
        if($this->CopyFileTo($source, $destination))
        {
            if($this->DeleteFile($source))
            {
                return 0;        #    File deleted
            }
            return 1;            #    File copied but source not deleted
        }
        return 2;                #    Source file not copied and not deleted
    }

    /**
     * @method    void    Wipe currently opened file =)
     */
    public function Wipe()
    {
        $this->Seek(0,'cur');
        for($i=0;$i<=$this->FileSize;$i++)
        {
            $c = chr(rand(0,256));
            $this->Write($c);
        }
    }
}
?>