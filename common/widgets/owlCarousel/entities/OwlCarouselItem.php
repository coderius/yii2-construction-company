<?php

namespace common\widgets\owlCarousel\entities;

class OwlCarouselItem{

    protected $image;//src
    protected $header;//[url, text]
    protected $meta = [];//links:[url, text]

    

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of header
     */ 
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set the value of header
     *
     * @return  self
     */ 
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get the value of meta
     */ 
    public function getMeta()
    {
        return $this->meta;
    }

    public function getMetaByKey($key)
    {
        return $this->meta[$key];
    }



    /**
     * Set the value of meta
     *
     * @return  self
     */ 
    public function setMeta(array $meta)
    {
        $this->meta = $meta;

        return $this;
    }

    public function addMeta(Meta $meta)
    {
        $this->meta[] = $meta;

        return $this;
    }

    public function hasImage()
    {
        return (bool) ($this->image instanceof Image);
    }

    public function hasHeader()
    {
        return (bool) ($this->header instanceof Header);
    }

    public function hasMeta()
    {
        // return (bool) ($this->meta instanceof Meta);
        return (bool) !empty($this->meta) && null != $this->meta;
    }

    public function isItemsMeta()
    {
        $is = true;
        foreach($this->meta as $meta){
            if(!$meta instanceof Meta){
                $is = false;
            }
        }
        return $is;
    }

}