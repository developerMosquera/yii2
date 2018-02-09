<?php

namespace frontend\modules\messages\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property int $sender_id
 * @property int $receiver_id
 * @property string $subject
 * @property string $body
 * @property string $is_read
 * @property string $deleted_by
 * @property string $created_at
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sender_id', 'receiver_id', 'created_at'], 'required'],
            [['sender_id', 'receiver_id'], 'integer'],
            [['body', 'is_read', 'deleted_by'], 'string'],
            [['created_at'], 'safe'],
            [['subject'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sender_id' => Yii::t('app', 'Sender ID'),
            'receiver_id' => Yii::t('app', 'Receiver ID'),
            'subject' => Yii::t('app', 'Subject'),
            'body' => Yii::t('app', 'Body'),
            'is_read' => Yii::t('app', 'Is Read'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
