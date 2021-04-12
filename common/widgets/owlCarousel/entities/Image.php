<?php

namespace common\widgets\owlCarousel\entities;

class Image{
    protected $src;

    public function __construct(string $src)
    {
        $this->src = $src;
    }

    /**
     * Get the value of src
     */ 
    public function getSrc()
    {
        return $this->src;
    }

    public function hasSrc()
    {
        return (bool) null != $this->getSrc();
    }

    public function __toString()
    {
        return $this->getSrc();
    }


}