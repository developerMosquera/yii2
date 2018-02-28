<?php
namespace frontend\components;
use yii\base\BootstrapInterface;

class LanguageSelector implements BootstrapInterface {

    public $supportedLanguages = ['en', 'es'];

    public function bootstrap($app) {

        $preferredLanguage = isset($app->request->cookies['language']) ? (string) $app->request->cookies['language'] : null;
        if (empty($preferredLanguage)) {
            $preferredLanguage = $app->request->getPreferredLanguage($this->supportedLanguages);
        }
        $app->language = $preferredLanguage;
    }

}
?>