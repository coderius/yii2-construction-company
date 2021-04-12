<?php

namespace common\widgets\owlCarousel\entities;

class Header{
    protected $url;
    protected $text;

    public function __construct(string $url, string $text)
    {
        $this->url = $url;
        $this->text = $text;
    }

    /**
     * Get the value of url
     */ 
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    //Have constructor
    //-----------------
    // public function hasUrl()
    // {
    //     return (bool) null != $this->getUrl();
    // }

    // public function hasText()
    // {
    //     return (bool) null != $this->getText();
    // }
}