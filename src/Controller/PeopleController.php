<?php
// namespace名前空間
// このクラスを↓に配置するという意味
namespace App\Controller;

use App\Controller\AppController;

class PeopleController extends AppController {

    public $paginate = [
        'finder' => 'byAge',
        'limit' => 5,
        // 'sort' => 'id',
        // 'direction' => 'asc',
        'contain' => ['Messages'],
    ];

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Paginator');
    }
    
    public function index() {
        // 5-18
        $data = $this->paginate($this->People);
        // $id = $this->request->query['id'];
        // $data = $this->People->get($id);
        // if ($this->request->is('post')) {
            // フォームの入力内容がdata['People']['find']に入る
            // $find = $this->request->data['People']['find'];
            // nameの値が$findのものを探す
            // $condition = ['conditions' => ['name' => $find]];
            // $condition = ['conditions' => ['name like' => $find]];
            // $condition = ['conditions' => [
            //                 'or' =>[
            //                     'name like' => $find,
            //                     'mail like' => $find
            //                 ]],
            //               'order' => ['People.age' => 'desc']
            // ];
            // $condition = ['limit' => 2, 'page' => $find];
            // $data = $this->People->find('all', $condition);
            // findBy + Name
            // $data = $this->People->findByNameOrMail($find, $find);
            // $data = $this->People->find()->where(['name like' => $find]);
            // $arr = explode(',', $find);
            // $data = $this->People->find()
            //     ->order(['People.age' => 'asc'])
            //     ->order(['People.name' => 'asc'])
            //     ->limit(3)->page($find);
        //     $data = $this->People->find('me', ['me' => $find])
        //         ->contain(['Messages']);
        // } else {
            // $data = $this->People->find('all',
            //     ['order' => ['People.age' => 'asc']]);
            // $data = $this->People->find()
            //     ->order(['People.age' => 'asc'])
            //     ->order(['People.name' => 'asc']);
        //     $data = $this->People->find('byAge')
        //         ->contain(['Messages']);
        // }
        $this->set('data', $data);
    }

    public function add() {
        $msg = 'please type your personal data...';
        $entity = $this->People->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data['People'];
            $entity = $this->People->newEntity($data);
            if ($this->People->save($entity)) {
                return $this->redirect(['action' => 'index']);
            }
            $msg = 'Error was occured...';
        }
        $this->set('msg', $msg);
        $this->set('entity', $entity);
    }

    public function create() {
        if ($this->request->is('post')) {
            // add.ctpのフォームの値を取り出す
            $data = $this->request->data['People'];
            // 新しいエンティティのインスタンスの作成
            $entity = $this->People->newEntity($data);
            // 引数$entityがデータベーステーブルに保存される
            $this->People->save($entity);
        }
        // create()を実行したらindexを表示
        return $this->redirect(['action' => 'index']);
    }

    public function edit() {
        // クエリのidを取得する
        $id = $this->request->query['id'];
        // idのエンティティを取り出す
        $entity = $this->People->get($id);
        // setでエンティティを渡す
        $this->set('entity', $entity);
    }

    public function update() {
        if ($this->request->is('post')) {
            // edit.ctpのフォームの値を取り出す
            $data = $this->request->data['People'];
            // idのエンティティを取り出す
            $entity = $this->People->get($data['id']);
            // フォームに入力した値($data)でエンティティ($entity)を更新する
            $this->People->patchEntity($entity, $data);
            // 更新(patch)された引数$entityがデータベーステーブルに保存される
            $this->People->save($entity);
        }
        // update()を実行したらindexを表示
        return $this->redirect(['action' => 'index']);
    }

    public function delete() {
        // クエリのidを取得する
        $id = $this->request->query['id'];
        // idのエンティティを取り出す
        $entity = $this->People->get($id);
        // setでエンティティを渡す
        $this->set('entity', $entity);
    }

    public function destroy() {
        if ($this->request->is('post')) {
            // delete.ctpのフォームの値を取り出す
            $data = $this->request->data['People'];
            // idのエンティティを取り出す
            $entity = $this->People->get($data['id']);
            // 選んだエンティティを削除する
            $this->People->delete($entity);
        }
        // delete()を実行したらindexを表示
        return $this->redirect(['action' => 'index']);
    }
}
