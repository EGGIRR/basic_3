<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $description
 * @property string $type
 * @property string $date
 * @property int $cost
 * @property boolean $is_completed
 * @property int $user_id
 *
 * @property User $user
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'description', 'type', 'date', 'cost', 'user_id'], 'required'],
            [['date'], 'safe'],
            [['cost', 'user_id'], 'integer'],
            [['is_completed'], 'boolean'],
            [['name', 'surname', 'patronymic', 'description', 'type'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'description' => 'Description',
            'type' => 'Type',
            'date' => 'Date',
            'cost' => 'Cost',
            'user_id' => 'User ID',
            'is_completed' => 'Is Completed',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
