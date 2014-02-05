<?php

namespace LoteriaApi;

class Config
{
    private $apiPath;
    private $directory;
    private $filename;
    private $ext;

    public function setApiPath($apiPath)
    {
        $this->apiPath = $apiPath;
        return $this;
    }
    
    public function setDirectory($directory)
    {
        $this->directory = $directory;
        return $this;
    }
    
    public function setFileName($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    public function setExt($ext)
    {
        $this->ext = $ext;
        return $this;
    }

    public function getData()
    {
        $file = $this->apiPath .
            $this->directory . DS .
            $this->filename . '.' .
            $this->ext;

        if (!is_file($file)) {
            throw new \Exception('File does not exist');
        }

        return parse_ini_file($file, true);
    }
}
