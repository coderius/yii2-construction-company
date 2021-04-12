<?php

namespace common\widgets\owlCarousel\entities;

use Yii;

class OwlCarousel{

    protected $title;
    protected $items = [];

    
    /**
     * Get the value of items
     */ 
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set the value of items
     *
     * @return  self
     */ 
    public function setItems(array $items)
    {
        $this->items = $items;

        return $this;
    }

    public function addItem(OwlCarouselItem $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    //------------
    //Has methods
    //------------
    public function hasTitle()
    {
        return (bool) null != $this->getTitle();
    }

    public function hasItems()
    {
        return (bool) (is_array($this->getItems()) &&  null != $this->getItems());
    }

    public function hasImage(OwlCarouselItem $item)
    {
        return $item->hasImage();
    }
}