<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 15.02.16
 * Time: 5:34
 */

namespace app\components\Makedir;

class Makedir
{
    protected $template;

    protected $webroot;

    protected $path;

    protected $file;

    protected $ext;

    public function __construct($file,$webroot,$defauldir='uploads',$template='Y m d')
    {
       // ... инициализация происходит перед тем, как будет применена конфигурация.
        $this->SetTemplate($template);

        $this->webroot=$webroot;
        $this->path='/'.$defauldir;
        $this->Createdir();
        $this->SetFile($file);
    }

    protected function SetTemplate($template)
    {
        $this->template=explode(' ',$template);

    }

    protected function SetFile($file)
    {
        $array=explode('.',$file);
        $this->file=$array[0];
        if(isset($array[1]))
        {
            $this->ext=$array[1];
        }
        else
        {
            $this->ext='jpg';
        }

        if (file_exists($this->webroot.$this->path.$this->file.'.'.$this->ext))
        {
            $this->file=round(microtime(true)*1000);
        }
    }

    protected function Createdir()
    {

        if (!file_exists($this->webroot.$this->path))
        {
            mkdir($this->webroot.$this->path);
        }

        $this->path.='/';

        foreach($this->template as $val)
        {
            $this->path.=date($val);

            if (!file_exists($this->webroot.$this->path))
            {
                mkdir($this->webroot.$this->path);
            }

            $this->path.='/';
        }

    }

    public function GetResult()
    {
        return ['path'=>$this->path,'file'=>$this->file.'.'.$this->ext];
    }

}