<?php

namespace brussens\maintenance;

use yii\base\BootstrapInterface;
use yii\jui\DatePicker;

class Module extends \yii\base\Module implements BootstrapInterface
{
    /**
     * The date format to use for displaying dates via jui date picker.
     * @see DatePicker::$dateFormat
     * @var string
     */
    public $dateFormat = 'php:d/m/Y';

    /**
     * The user display attribute to use for displaying the current user.
     * Defaults to 'username'.
     * @var string
     */
    public $userDisplayAttribute = 'username';


    /**
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {
            $app->getUrlManager()->addRules([
                ['class' => 'yii\web\UrlRule', 'pattern' => $this->id, 'route' => $this->id . '/default/index'],
                ['class' => 'yii\web\UrlRule', 'pattern' => $this->id . '/<action:[\w\-]+>', 'route' => $this->id . '/default/<action>'],
            ], false);
        }
    }
}