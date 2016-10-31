<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $this->renderPartial('//layouts/public_meta'); ?>
</head>
<body>
    <?php $this->renderPartial('//layouts/public_head'); ?>

	<?php $this->renderPartial('//layouts/public_menu'); ?>

    <!--主体内容开始-->
    <div id="content">
        <?php
        $sucFlash = Yii::app()->wuser->getFlash('success');
        $errFlash = Yii::app()->wuser->getFlash('error');
        if (!empty($sucFlash) || !empty($errFlash)) {
            $htmlD = '<div id="flashes">';
            if ( !empty($sucFlash) ) {
                $htmlD .= '<div class="alert alert-success pull-right">';
                $htmlD .= $sucFlash;
                $htmlD .= '</div>';
            }
            if ( !empty($errFlash) ) {
                $htmlD .= '<div class="alert alert-danger pull-right">';
                $htmlD .= $errFlash;
                $htmlD .= '</div>';
            }
            $htmlD .= '</div>';
            echo $htmlD;
        }

        ?>
        <script>
            $(function () {
                setTimeout(function () {
                    $("#flashes").slideUp("slow");
                },3000)
            })
        </script>
	<?php echo $content;?>
	</div>
	<!--主体内容结束-->

    <?php $this->renderPartial('//layouts/public_footer'); ?>


</body>
</html>