<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class MessagesTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);
        $this->setDisplayField('message');
        $this->belongsTo('People');
    }

    public function validationDefault(Validator $validator) {
        $validator
            ->allowEmpty('id', 'create');       // createの時にidは空白で可能  
        
        $validator
            ->integer('person_id', 'person_idは整数で入力ください。')
            ->notEmpty('person_id', 'person_idは必ず入力ください。');
        
        $validator
            ->scalar('message', 'テキストを入力ください。')                    // テキスト
            ->requirePresence('message', 'create')
            ->notEmpty('message', 'メッセージは必ず記入してください。');

        return $validator;
    }
}