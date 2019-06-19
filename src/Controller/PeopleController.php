<?php
// namespace名前空間
// このクラスを↓に配置するという意味
namespace App\Controller;

use App\Controller\AppController;

class PeopleController extends AppController {
    
    public function index() {
        $data = $this->People->find('list');
        $this->set('data', $data);
    }
}
