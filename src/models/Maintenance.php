<?php

namespace brussens\maintenance\models;

use brussens\maintenance\Module;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FormatConverter;
use yii\web\Application as WebApplication;

/**
 * This is the model class for table "{{%maintenance}}".
 *
 * @property int $id
 * @property string $date
 * @property string $time_start
 * @property string $time_end
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Maintenance extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
            ],
            'blameable' => [
                'class' => 'yii\behaviors\BlameableBehavior',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%maintenance}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'time_start', 'time_end'], 'required'],
            [['date'], 'filter', 'filter' => [$this, 'formatDate'], 'when' => function() { return Yii::$app instanceof WebApplication; }],
            [['date', 'time_start', 'time_end'], 'safe'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('maintenance', 'ID'),
            'date' => Yii::t('maintenance', 'Date'),
            'time_start' => Yii::t('maintenance', 'Time Start'),
            'time_end' => Yii::t('maintenance', 'Time End'),
            'created_at' => Yii::t('maintenance', 'Inserted At'),
            'created_by' => Yii::t('maintenance', 'Inserted By'),
            'updated_at' => Yii::t('maintenance', 'Updated At'),
            'updated_by' => Yii::t('maintenance', 'Updated By'),
        ];
    }

    /**
     * Formats a date value from the format set up in the module to database one.
     * @param $value
     * @return string
     */
    public function formatDate($value)
    {
        $dateFormat = Module::getInstance()->dateFormat;
        // If the date format is prefixed with "php:", remove it
        if (strncmp($dateFormat, 'php:', 4) === 0) {
            $dateFormat = substr($dateFormat, 4);
        }
        // Convert the date to a DateTime object
        $dateTime = \DateTime::createFromFormat($dateFormat, $value);
        // If the date is invalid, return the original value
        if ($dateTime === false) {
            return $value;
        }
        // Otherwise, return the formatted date
        return $dateTime->format('Y-m-d');
    }

    /**
     * Returns the user's creation model.
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Yii::$app->user->identityClass, ['id' => 'created_by']);
    }

    /**
     * Returns the user's update model.
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(Yii::$app->user->identityClass, ['id' => 'updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return MaintenanceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MaintenanceQuery(get_called_class());
    }

}
