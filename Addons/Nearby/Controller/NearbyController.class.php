<?php

namespace Addons\Nearby\Controller;
use Home\Controller\AddonsController;

class NearbyController extends AddonsController{
        public function index(){
                $word=I('get.keyword');
                empty($word)? $word='美食':$word;
                $ak=getAddonConfig('Nearby');
                $this->assign('ak',$ak['ak']);
                $this->assign('query',$word);
                $this->display();
        }
}
