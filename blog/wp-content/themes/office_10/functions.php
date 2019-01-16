<?php
if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Post Sidebar',
'before_widget' => '<div class="widgetblock">',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
?>
<?php
if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Page Sidebar',
'before_widget' => '<div class="widgetblock">',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
?>
<?php
load_theme_textdomain('revoffice');

class RevolutionOffice {

	function addOptions () {

		if (isset($_POST['revoffice_reset'])) { RevolutionOffice::initOptions(true); }

		if (isset($_POST['revoffice_save'])) {

			$aOptions = RevolutionOffice::initOptions(false);
			$aOptions['featured-cat'] = $_POST['featured-cat'];
			$aOptions['column1-id'] = $_POST['column1-id'];		
			$aOptions['column2-id'] = $_POST['column2-id'];
			$aOptions['column3-id'] = $_POST['column3-id'];
			$aOptions['homebox-id'] = $_POST['homebox-id'];
			$aOptions['footer-text'] = stripslashes($_POST['footer-text']);
			update_option('revoffice_theme', $aOptions);

		}
		
		add_theme_page("Revolution Office Theme Options", "Revolution Office опции", 'edit_themes', basename(__FILE__), array('RevolutionOffice', 'displayOptions'));
	}
	
	function initOptions ($bReset) {
		$aOptions = get_option('revoffice_theme');
		if (!is_array($aOptions) || $bReset) {
			$aOptions['featured-cat'] = '3';
			$aOptions['column1-id'] = '1';
			$aOptions['column2-id'] = '1';
			$aOptions['column3-id'] = '1';
			$aOptions['homebox-id'] = '3';
			$aOptions['footer-text'] = 'Copyright 2008 какой-то сайт.com - All Rights Reserved';
			update_option('revoffice_theme', $aOptions);
		}
		return $aOptions;
	}

	function displayOptions () {
		$aOptions = RevolutionOffice::initOptions(false);
?>

<div class="wrap">
	<h2>Revolution Office Theme - Настройка</h2>	
    <div style="margin-left:0px;">
    <form action="#" method="post" enctype="multipart/form-data" name="massive_form" id="massive_form">
		<fieldset name="general_options" class="options">
		
        <h3 style="margin-bottom:0px;">Настройка карусели на главной странице</h3>        
        <p style="margin-top:0px;">Используйте это поле, чтобы задать ID номер рубрики, записи которой будут выводиться в карусели. </p>
		
        ID номер рубрики: (Вы можете легко найти ID номера рубрик, используя специальный плагин: "<a href="http://wordpress.org/extend/plugins/reveal-ids-for-wp-admin-25/" title="Reveal ID's" target="_blank">Reveal ID's</a>" )<br />
		<div style="margin:0;padding:0;">
        <input name="featured-cat" id="featured-cat" value="<?php echo($aOptions['featured-cat']); ?>" size="2" ></input>   
        </div><br /> 

        <h3 style="margin-bottom:0px;">3 блока записей под каруселью на Главной:</h3>
        <p style="margin-top:0px;">Используйте эти поля, чтобы настроить  вывод трех наиболее актуальных ЗАПИСЕЙ блога, которые вы хотели бы вывести на Главной под каруселью. Это будут статичные записи, но вы в любой момент моете заменить их из этой панели.</p>
 
        Колонка #1 - впишите ID номер записи:<br />
		<div style="margin:0;padding:0;">
        <input name="column1-id" id="column1-id" value="<?php echo($aOptions['column1-id']); ?>" size="2" ></input>   
        </div><br /> 
        
        Колонка #2 - впишите ID номер записи:<br />
        <div style="margin:0;padding:0;">
        <input name="column2-id" id="column2-id" value="<?php echo($aOptions['column2-id']); ?>" size="2" ></input> 
        </div><br />
        
        Колонка #3 - впишите ID номер записи:<br />
		<div style="margin:0;padding:0;">
        <input name="column3-id" id="column3-id" value="<?php echo($aOptions['column3-id']); ?>" size="2" ></input>  
        </div><br />
        
        <h3 style="margin-bottom:0px;">Блок Избранное на Главной:</h3>
        <p style="margin-top:0px;">Используйте это поле, чтобы выбрать рубрику, записи из которой будут выводиться в нижней части страниц в блоке Избранное.</p>
 
         ID номер рубрики:<br />
		<div style="margin:0;padding:0;">
        <input name="homebox-id" id="homebox-id" value="<?php echo($aOptions['homebox-id']); ?>" size="2" ></input>   
        </div><br /> 
        
        <h3 style="margin-bottom:0px;">Текст и Copyright вашей площадки в подвале:</h3>
        <p style="margin-top:0px;">Здесь пропишите текст для подвала, например, "2008, Мой блог. Все права защищены".</p>
        
        Текст:<br />
        <div style="margin:0;padding:0;">
        <input name="footer-text" id="footer-text" size="75" value="<?php echo($aOptions['footer-text']); ?>"></input> 
        </div><br />
                                
		</fieldset>
		<p class="submit"><input type="submit" name="revoffice_reset" value="Reset" /></p>
		<p class="submit"><input type="submit" name="revoffice_save" value="Save" /></p>
	</form>      
</div>
<?php
	}
}

// Register functions
add_action('admin_menu', array('RevolutionOffice', 'addOptions'));

?>