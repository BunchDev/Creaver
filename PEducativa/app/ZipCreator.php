<?php

namespace App;
use Chumper\Zipper\Zipper;

class ZipCreator extends Thread 
{
     public function __construct($path,$files) {
        $this->path = $path;
        $this->files = $files;
    	}

    public function run()
    {
    	$zipper  = new Zipper();
		$zipper->make($this->path)->add($this->files);
    }
}
