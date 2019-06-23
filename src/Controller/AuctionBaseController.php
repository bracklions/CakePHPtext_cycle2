<?php
// namespace名前空間
// このクラスを↓に配置するという意味
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;

class HelloController extends AppController {
    public function initialize() {
        parent::initialize();
        // 各種コンポーネントのロード
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'logout',
            ],
            'authError' => 'ログインしてください。',
        ]);
    }

    // ログイン処理
    public function login() {
        // POST時の処理
        if ($this->request->isPost()) {
            $user = $this->Auth->identify();
            // Authのidentifyをユーザーに設定
            if (!empty($user)) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('ユーザー名かパスワードが間違っています');
        }
    }

    // ログアウト処理
    public function logout() {
        // セッションを破棄
        $this->request->session()->destroy();
        return $this->redirect($this->Auth->logout());
    }

    // 認証を使わないページの設定
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        // $this->Auth->allow(['login', 'index', 'add']);
        $this->Auth->allow([]);
    }

    // 認証時のロールのチェック
    public function isAuthorized($user = null) {
        //管理者はtrue
        if($user['role'] === 'admin') {
            return true;
        }
        // 一般ユーザーはAuctionControllerのみture,他はfalse
        if ($user['role'] === 'user') {
            if ($this->name == 'Auction') {
                return false;
            } else {
                return false;
            }
        }
        // 他は全てfalse
        return false;
    }

}