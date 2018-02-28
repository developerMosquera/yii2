<?php

namespace frontend\modules\roles;

/**
 * Roles module definition class
 */
class Roles extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\roles\controllers';
    public $defaultRoute = 'roles';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
