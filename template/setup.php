<div class="wrap">
    <h2>Cookie Alert Template</h2>
    <form method="post" action="options.php"> 
        <?php @settings_fields('cookie_alert_template-group'); ?>
        <?php @do_settings_fields('cookie_alert_template-group'); ?>

        <?php do_settings_sections('cookie_alert_template'); ?>

        <?php @submit_button(); ?>
    </form>
</div>