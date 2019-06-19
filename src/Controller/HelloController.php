<?php
// namespace名前空間
// このクラスを↓に配置するという意味
namespace App\Controller;

use App\Controller\AppController;

class HelloController extends AppController {
    // public $autoRender = false;
    // private $data = [
    //     ['name' => 'taro', 'mail' => 'taro@yamada', 'tel' => '090-999-999'],
    //     ['name' => 'hanako', 'mail' => 'hanako@flower', 'tel' => '080-888-888'],
    //     ['name' => 'sachiko', 'mail' => 'sachico@happy', 'tel' => '070-777-777']
    // ];

    public function initialize() {
        $this->viewBuilder()->setLayout('hello');
    }

    public function index() {
        // 2-26
        $this->set('header', ['subtitle' => 'from Controller with Love♡']);
        $this->set('footer', ['copyright' => '名無しの権兵衛']);
        
        // $this->viewBuilder()->autoLayout(false);
        // 2-11
        // $this->set('title', 'Hello!');
        // 2-14
        // if ($this->request->isPost()) {
        //     $this->set('data', $this->request->data['Form1']);
        // } else {
        //     $this->set('data', []);
        // }

        // 2-7
        // $values = [
        //     'title' => 'Hello!',
        //     'message' => 'This is message!'
        // ];
        // $this->set($values);
        // 2-6
        // $this->set('title', 'Hello!');
        // $this->set('message', 'This is message!');

        // $id = 0;
        // $id = 'no name';
        // if (isset($this->request->query['id'])) {
        //     $id = $this->request->query['id'];
        // }
        // $pass = 'no password';
        // if (isset($this->request->query['pass'])) {
        //     $pass = $this->request->query['pass'];
        // }
        // echo "<html><body><h1>Hello!</h1>";
        // echo "<ul><li>your id: ".$id."</li>";
        // echo "<li>password: ".$pass."</li></ul>";
        // echo "</body></html>";
        // echo json_encode($this->data[$id]);
    }

    public function form() {
        $this->viewBuilder()->autoLayout(false);
        $name = $this->request->data['name'];
        $mail = $this->request->data['mail'];
        $age = $this->request->data['age'];
        $res = 'こんにちは'.$name.'('.$age.')さん。メールアドレスは、'.$mail.'ですね？';
        $values = [
            'title' => 'Result',
            'message' => $res
        ];
        $this->set($values);
    }
}
