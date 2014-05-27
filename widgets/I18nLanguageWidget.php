<?php

class I18nLanguageWidget extends CWidget
{
    /**
     * style 
     * "inline"
     * @var string
     */
    public $style = 'inline';

    /**
     * cssClass 
     * Additional css class for selector
     * @var string
     */
    public $cssClass = '';

    public function init()
    {
        $languages = Yii::app()->getLanguages();
        if (count($languages) > 1) 
        {
            $this->render($this->style, array(
                'languages' => $languages,
                'cssClass'  => $this->cssClass,
            ));
        }
    }
}
