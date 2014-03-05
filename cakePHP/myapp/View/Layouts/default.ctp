<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription; ?>
			<?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('cake.generic');
		echo $scripts_for_layout; ?>
    </head>
    <body>
        <div id="container">
            <div id="header"> 
                    <?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?>
                </div>
            </div>
            <div id="content">
                <?php echo $this->Session->flash(); ?>

                <?php echo $content_for_layout; ?>
            </div>
            <div id="footer">
				//footer
            </div>
        </div>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>