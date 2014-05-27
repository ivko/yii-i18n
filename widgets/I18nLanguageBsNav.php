<?php

Yii::import('bootstrap.widgets.BsNav');

class I18nLanguageBsNav extends BsNav
{
	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$languages = Yii::app()->getLanguages();
		$activeLocale = Yii::app()->language;

		$items = array(array('label'=>'Language'));

		foreach ($languages as $lang => $label)
		{
			if ($lang === $activeLocale)
				$activeLanguage = $label;

			$items[] = array(
				'label' => $label,
				'url' => Yii::app()->createI18nReturnUrl($lang),
				'active' => $lang === $activeLocale,
			);
		}

		$label = isset($activeLanguage) ? $activeLanguage : 'Unknown';
		$this->items = array_merge(array(array('label'=> $label, 'items'=>$items)), $this->items);

		parent::init();
	}
}
