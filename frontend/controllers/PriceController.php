<?php

namespace frontend\controllers;

use frontend\services\price\PriceService;

class PriceController extends BaseController
{
    private $priceService;

    public function __construct(
        $id,
        $module,
        PriceService $priceService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->priceService = $priceService;
    }
    
    public function actionIndex()
    {
        $price = $this->priceService->categoriesAndItems();
    
        $heading = "Прайс " . date('Y');
        $crumbName  = "Прайс";
        $heading2 = "Стоимость работ по ремону квартир";
        $heading3 = "Цены на ремонт квартир в Харькове";

        $this->priceService->makeMetaTags([
            'metaTitle' => $heading3 . " / " . $heading,
            'description' => "Ремонт квартир Харьков - цены, наш прайс на ремонт и отделочные работы, актуальный на " . date('Y'),
        ]);

        return $this->render('index', compact('price', 'heading', 'crumbName', 'heading2', 'heading3'));
    }

}
