<?php

namespace frontend\modules\users;

/**
 * users module definition class
 */
class Users extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\users\controllers';
    public $defaultRoute = 'users';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
