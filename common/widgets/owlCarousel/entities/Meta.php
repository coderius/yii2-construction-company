<?php

namespace common\widgets\owlCarousel\entities;

class Meta{
    protected $url;
    protected $text;

    public function __construct(string $url, string $text)
    {
        $this->url = $url;
        $this->text = $text;
    }

    public function isMeta()
    {
        return (bool) ($this instanceof self);
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
}