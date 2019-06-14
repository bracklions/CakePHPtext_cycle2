<?php
// namespace名前空間
// このクラスを↓に配置するという意味
namespace App\Controller;

use App\Controller\AppController;

class HelloController extends AppController {
    public $autoRender = false;
    private $data = [
        ['name' => 'taro', 'mail' => 'taro@yamada', 'tel' => '090-999-999'],
        ['name' => 'hanako', 'mail' => 'hanako@flower', 'tel' => '080-888-888'],
        ['name' => 'sachiko', 'mail' => 'sachico@happy', 'tel' => '070-777-777']
    ];

    public function index() {
        $id = 0;
        // $id = 'no name';
        if (isset($this->request->query['id'])) {
            $id = $this->request->query['id'];
        }
        // $pass = 'no password';
        // if (isset($this->request->query['pass'])) {
        //     $pass = $this->request->query['pass'];
        // }
        // echo "<html><body><h1>Hello!</h1>";
        // echo "<ul><li>your id: ".$id."</li>";
        // echo "<li>password: ".$pass."</li></ul>";
        // echo "</body></html>";
        echo json_encode($this->data[$id]);
    }
}
