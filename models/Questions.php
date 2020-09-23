<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property string $question
 * @property string $image
 * @property int $section_id
 * @property string $opt1
 * @property string $opt2
 * @property string $opt3
 * @property string $opt4
 * @property string $ans
 * @property string $created_at
 * @property string $updated_at
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question', 'section_id', 'opt1', 'opt2', 'opt3', 'opt4', 'ans'], 'required'],
            [['question'], 'string'],
            [['section_id'], 'integer'],
            [['created_at', 'updated_at', 'image'], 'safe'],
            [['image'], 'file', 'extensions' => 'png,jpg,gif', 'skipOnEmpty' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '',
            'question' => 'Question',
            'image' => 'Image',
            'section_id' => '',
            'opt1' => 'Option 1',
            'opt2' => 'Option 2',
            'opt3' => 'Option 3',
            'opt4' => 'Option 4',
            'ans' => 'Answer',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
