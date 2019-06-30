<?php
// namespace名前空間
// このクラスを↓に配置するという意味
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

class MessagesController extends AppController {
    
    public function index() {
        if ($this->request->is('post')) {
            // 送信されたフォームdata['Messages']の内容を$dataに取り出す
            $data = $this->request->data['Messages'];
            // フォームの値を元にMessageエンティティを作成する
            $entity = $this->Messages->newEntity($data);
            // 投稿日時をcreated_atに設定する
            $entity->created_at = new Time(date('Y-m-d H:i:s'));
            // エンティティを保存する
            $this->Messages->save($entity);
        } else {
            $entity = $this->Messages->newEntity();
        }
        $data = $this->Messages->find('all')
            ->contain(['People'])
            ->order(['created_at' => 'desc']);
        $this->set('data', $data);
        $this->set('entity', $entity);
    }

}
