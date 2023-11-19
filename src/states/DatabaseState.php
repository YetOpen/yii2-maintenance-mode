<?php
/**
 * @link https://github.com/brussens/yii2-maintenance-mode
 * @copyright Copyright (c) since 2015 Dmitry Brusensky
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace brussens\maintenance\states;

use brussens\maintenance\models\Maintenance;
use brussens\maintenance\Module;
use brussens\maintenance\StateInterface;
use Yii;
use yii\base\BaseObject;
use yii\base\NotSupportedException;

/**
 * Class SimpleState
 * @package brussens\maintenance\states
 */
class DatabaseState extends BaseObject implements StateInterface
{
    /**
     * The default maintenance window duration.
     * Defaults to 1 hour.
     * @var int
     */
    public $defaultWindowDuration = 3600; // in seconds

    /**
     * @inheritdoc
     */
    public function enable()
    {
        $model = Yii::createObject([
            'class' => Maintenance::class,
            'date' => date('Y-m-d'),
            'time_start' => date('H:i:s'),
            'time_end' => date('H:i:s', time() + $this->defaultWindowDuration),
        ]);
        $model->save();
    }

    /**
     * @inheritdoc
     */
    public function disable()
    {
        $model = Maintenance::find()->active()->one();
        $model->time_end = date('H:i:s');
        $model->save();
    }

    /**
     * @inheritdoc
     */
    public function isEnabled()
    {
        return Maintenance::find()->active()->exists();
    }
}