<?php
// namespace名前空間
// このクラスを↓に配置するという意味
namespace App\Controller;

use App\Controller\AppController;

class PeopleController extends AppController {
    
    public function index() {
        // $id = $this->request->query['id'];
        // $data = $this->People->get($id);
        $data = $this->People->find('all');
        $this->set('data', $data);
    }

    public function add() {
        $entity = $this->People->newEntity();
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
