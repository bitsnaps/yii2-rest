<?php

namespace app\models;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 *
 */
class Post extends \yii\db\ActiveRecord
{

  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
      return '{{%post}}';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
      return [
          [['title', 'body'], 'required'],
          [['body'], 'string'],
          [['title'], 'string', 'max' => 512],
      ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
      return [
          'id' => 'ID',
          'title' => 'Title',
          'body' => 'Body',
      ];
  }

}
