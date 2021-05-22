<?php

namespace frontend\services\search;

interface ISearchService
{
    public function providerSuggesters($query);
    public function providerSearch($queryString);
    public function makeMetaTags($queryString);
}