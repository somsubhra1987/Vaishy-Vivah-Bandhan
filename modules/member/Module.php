<?php

namespace app\modules\member;

/**
 * member module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\member\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->layout = "@app/web/themes/frontend/vivahBandhan/templates/Login/Page";
        // custom initialization code goes here
    }
}
