<script type="text/javascript">
$(document).ready(function(){
    $(".sub_button").click(function(){
        $.post('<?php echo osc_base_url(true); ?>', {email:$("#alert_email").val(), userid:$("#alert_userId").val(), alert:$("#alert").val(), page:"ajax", action:"alerts"},
            function(data){
                if(data==1) { alert('<?php echo osc_esc_js(__('You have sucessfully subscribed to the alert', 'katrina')); ?>'); }
                else if(data==-1) { alert('<?php echo osc_esc_js(__('Invalid email address', 'katrina')); ?>'); }
                else { alert('<?php echo osc_esc_js(__('There was a problem with the alert', 'katrina')); ?>');
                };
        });
        return false;
    });

    var sQuery = '<?php echo osc_esc_js(AlertForm::default_email_text()); ?>';

    if($('input[name=alert_email]').val() == sQuery) {
        $('input[name=alert_email]').css('color', 'gray');
    }
    $('input[name=alert_email]').click(function(){
        if($('input[name=alert_email]').val() == sQuery) {
            $('input[name=alert_email]').val('');
            $('input[name=alert_email]').css('color', '');
        }
    });
    $('input[name=alert_email]').blur(function(){
        if($('input[name=alert_email]').val() == '') {
            $('input[name=alert_email]').val(sQuery);
            $('input[name=alert_email]').css('color', 'gray');
        }
    });
    $('input[name=alert_email]').keypress(function(){
        $('input[name=alert_email]').css('background','');
    })
});
</script>
<div class="alert_form">
    <h3>
        <?php _e('Subscribe to this search', 'katrina'); ?>
    </h3>
    <form action="<?php echo osc_base_url(true); ?>" method="post" name="sub_alert" id="sub_alert">
        <fieldset>
            <?php AlertForm::page_hidden(); ?>
            <?php AlertForm::alert_hidden(); ?>
            <?php AlertForm::user_id_hidden(); ?>
            <?php if(osc_is_web_user_logged_in()) { ?>
                <?php AlertForm::email_hidden(); ?>
            <?php } else { ?>
                <?php AlertForm::email_text(); ?>
            <?php }; ?>
            <button type="submit" class="sub_button" ><?php _e('Subscribe now', 'katrina'); ?>!</button>
        </fieldset>
    </form>
</div>
