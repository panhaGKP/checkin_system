<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customers Model
 *
 * @property \App\Model\Table\CheckinsTable&\Cake\ORM\Association\HasMany $Checkins
 * @property \App\Model\Table\MembershipsTable&\Cake\ORM\Association\HasMany $Memberships
 *
 * @method \App\Model\Entity\Customer newEmptyEntity()
 * @method \App\Model\Entity\Customer newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Customer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Customer findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Customer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('customers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Checkins', [
            'foreignKey' => 'customer_id',
        ]);
        $this->hasMany('Memberships', [
            'foreignKey' => 'customer_id',
        ]);
        // new behavior
        $this->addBehavior('Muffin/Trash.Trash',[]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 45)
            ->allowEmptyString('name');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 1)
            ->requirePresence('gender', 'create')
            ->notEmptyString('gender');

        $validator
            ->date('date_of_birth')
            ->allowEmptyDate('date_of_birth');

        $validator
            ->scalar('phone_number')
            ->maxLength('phone_number', 45)
            ->allowEmptyString('phone_number');

        $validator
            ->scalar('profile_picture')
//            ->maxLength('profile_picture', 45)
            ->allowEmptyFile('profile_picture');


        $validator
            ->allowEmptyFile('profile_picture')
            ->add('image',[
                'mimeType'=>[
                    'rule'=>['mimeType',['image/jpg', 'image/png','image/jpeg']],
                    'message'=>'Please upload only jpg and png.'
                ],
                'fileSize'=>[
                    'rule'=>['fileSize', '<=', '5MB'],
                    'message'=>'Image file size must be less than 5MB.',
                ],
                ]);
        return $validator;
    }
}
