<?php

class I18nApplicationBehavior extends CBehavior
{
	/**
	 * @var string the default locale.
	 */
	public $defaultLanguage;
	/**
	 * @var array a list of languages enabled for the application.
	 */
	public $languages = array('en');

	/**
	 * @return array the behavior events.
	 */
	public function events()
	{
        return array(
            'onBeginRequest'=>'setLanguage',
        );
	}

	/**
	 * Initializes the behavior.
	 */
	public function init()
	{
		if (!isset($this->defaultLanguage))
			$this->defaultLanguage = $this->owner->sourceLanguage;
	}

	/**
	 * Sets the application language from a user state if applicable.
	 */
	public function setLanguage()
	{
        Yii::app()->getUrlManager()->parseUrl(Yii::app()->getRequest());
        if(isset($_GET['_language'])) 
        {
            Yii::app()->language = $_GET['_language'];
            Yii::app()->user->setState('_language', $_GET['_language']);
            $cookie = new CHttpCookie('_language', $_GET['_language']);
            $cookie->expire = time() + (3600*24*7); // 7 days
            Yii::app()->request->cookies['_language'] = $cookie; 
        }
        elseif (Yii::app()->user->hasState('_language'))
        {
            Yii::app()->language = Yii::app()->user->getState('_language');
        } else {
            Yii::app()->language = $this->defaultLanguage;
        }
	}

	/**
	 * A list of the languages enabled for the application.
	 * @return array list of languages.
	 */
	public function getLanguages()
	{
		return $this->languages;
	}
    
    public function createI18nReturnUrl($lang)
    {
        if (count($_GET) > 0) {
            $arr = $_GET;
            $arr['_language']= $lang;
        }
        else {
            $arr = array('_language'=>$lang);
        }
        return Yii::app()->controller->createUrl('', $arr);
    }
}
