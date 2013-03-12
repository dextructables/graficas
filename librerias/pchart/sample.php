<?php
/* pChart library inclusions */
include("class/pData.class.php");
include("/class/pDraw.class.php");
include("/class/pImage.class.php");

class Imagen extends pImage
{
    public function __construct($w, $h)
    {
        parent::__construct($w, $h);
        var_dump(IMAGE_MAP_STORAGE_SESSION);
    }
}

$g = new Imagen(100,200);
