<div class='language-selector-inline <?php echo $cssClass; ?>'>
    <?php $i = 0;
    foreach($languages as $lang => $title): ?>
        <?php print $i > 0 ? '/' : '';
            $i++;
        ?>
        <?php if($lang == Yii::app()->language): ?>
            <span class='language-selector-active'><?php echo $title; ?></span>
        <?php else: ?>
            <span class='language-selector-notactive'>
                <?php echo CHtml::link( $title, Yii::app()->createI18nReturnUrl($lang), array('class'=>'')); ?>
            </span>
        <?php endif ?>
    <?php endforeach ?>
</div>
