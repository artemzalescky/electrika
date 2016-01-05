<?php

namespace ph\phAdmin\application\controllers;

use application\models\SpecialOfferModel;
use ph\controller\BaseController;
use ph\sessions\flash\FlashMessageStorage as messages;

class SpecialOfferController extends BaseController {

    public function index() {
        $specialOfferProducts = SpecialOfferModel::getInstance()->getProducts();

        $this->setViewVariable('specialOfferProducts', $specialOfferProducts);
        $this->render();
    }

    public function create($catalogId, $productId) {
        if (!$this->isPostRequest()) exit;

        $specialOffer = [
            'catalogId' => $catalogId,
            'productId' => $productId
        ];

        if (SpecialOfferModel::getInstance()->create($specialOffer) !== true) {
            http_response_code(406);
            header('406 Not Acceptable');
            exit( 'Product is in Special Offers');
        }
    }

    public function delete($catalogId, $productId) {
        $specialOfferProduct = SpecialOfferModel::getInstance()->getProductById($catalogId, $productId);

        $this->setViewVariable('specialOfferProduct', $specialOfferProduct);
        $this->render();
    }

    public function destroy($catalogId, $productId) {
        if (!$this->isPostRequest()) exit;

        try {
            SpecialOfferModel::getInstance()->delete($catalogId, $productId);
            messages::add('SpecialOffer_Deleted', 1, 'success');
            $this->systemRedirect('/specialOffer');
        } catch (\Exception $e) {
            messages::add('UnknownError', 1, 'error');
            $this->systemRedirect('/specialOffer');
        }
    }
}
