<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PeopleTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('people');
        // $this->setDisplayField('name');
        $this->setDisplayField('mail');
        $this->setPrimaryKey('id');
    }

    public function findMe(Query $query, array $options) {
        $me = $options['me'];
        return $query->where(['name like' => '%'.$me.'%'])
            ->orWhere(['mail like' => '%'.$me.'%'])
            ->order(['age' => 'asc']);
    }

    public function findByAge(Query $query, array $options) {
        return $query->order(['age' => 'asc'])
            ->order(['name' => 'asc']);
    }

    public function validationDefault(Validator $validator) {
        $validator
            ->integer('id', 'idは整数で入力ください。')// 整数
            ->allowEmpty('id', 'create');       // createの時にidは空白で可能  
        
        $validator
            ->scalar('name', 'テキストを入力ください。')                    // テキスト
            ->requirePresence('name', 'create') // createの時にnameが必ず必要
            ->notEmpty('name', '名前は必ず記入してください。');                 // nameは空白不可
        
        $validator
            ->scalar('mail', 'テキストを入力ください。')                    // テキスト
            ->allowEmpty('mail')                // 空白可能
            ->email('mail', false, 'メールアドレスを記入してください。');

        $validator
            ->integer('age', '整数を入力ください。')                    // 整数
            ->requirePresence('age', 'create')  // createの時にageが必ず必要
            ->notEmpty('age', '必ず値を入力ください。')                   // ageは空白不可
            ->greaterThan('age', -1, 'ゼロ以上の値を記入ください。');

        return $validator;
    }
}