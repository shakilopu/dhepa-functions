<?php
global $dhepa;
$dhepa = get_option('dhepa');
$header_img_logo = $dhepa['header-logo-image']['url'];
$header_text_logo = $dhepa['header-logo-text'];
$fazr_time = $dhepa['fazr'];
$dohar_time = $dhepa['dohar'];
$asar_time = $dhepa['asar'];
$magrib_time = $dhepa['magrib'];
$esha_time = $dhepa['esha'];
$sunrise_time = $dhepa['sunrise'];
$sunset_time = $dhepa['sunset'];

class Dhepa_Prayer_Time extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'dhepa-prayer-time',
            'description' => 'This widget will show Muslim Prayer Times Calender',
        );
        parent::__construct('dhepa-prayer-time', 'Dhepa Muslim Prayer Times Calender', $widget_ops);
    }
    public function form($instance)
    {
        echo "<p>It will show Muslim Prayer Times Calender</p>";
    }
    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        global $header_img_logo;
        global $header_text_logo;
        global $fazr_time;
        global $dohar_time;
        global $asar_time ;
        global $magrib_time;
        global $esha_time;
        global $sunrise_time;
        global $sunset_time;
        echo $args['before_widget'];

?>
        <div id="prayer-time" class="col pt-2 pt-sm-2 pt-md-0 pt-lg-3 pt-xl-3">
            <div class="prayerTimePanel">
                <div class="prayerTimeTitle">
                    <?php if (!empty($header_img_logo)) { ?>
                        <img loading="lazy" class="img-fluid float-left mt-3 ml-4" width="35%" alt="Jugantor Logo" src="<?php echo esc_attr($header_img_logo); ?>" />
                    <?php } elseif (!empty($header_text_logo)) { ?>
                        
                            <h2><?php echo esc_html($header_text_logo); ?></h2>
                       
                    <?php } else { ?>
                       <img loading="lazy" class="img-fluid float-left mt-3 ml-4" width="35%" alt="Jugantor Logo" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo.png" />
                    <?php } ?>

                    
                </div>
                <div class="dateShow">
                    <script type="text/javascript">
                        var currentDate = new Date();
                        document.write(
                            currentDate.toLocaleString("bn-BD", {
                                day: "2-digit",
                            }) +
                            " " +
                            currentDate.toLocaleString("bn-BD", {
                                month: "long",
                            }) +
                            ", " +
                            currentDate.toLocaleString("bn-BD", {
                                year: "numeric",
                            })
                        );
                    </script>
                </div>
                <div id="tablePrayTimes" class="prayerTimeTable">
                    <table cellspacing="1" cellpadding="1" width="100%">
                        <tbody>
                            <tr>
                                <td><span class="prayerName">ফজর</span></td>
                                <?php if (!empty($fazr_time)) { ?>
                                    <td><span class="prayerTime"><?php echo esc_attr($fazr_time); ?></span></td>
                                <?php } else { ?>
                                   <td><span class="prayerTime">৫:০৫</span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td><span class="prayerName">জোহর</span></td>
                                 <?php if (!empty($dohar_time)) { ?>
                                    <td><span class="prayerTime"><?php echo esc_attr($dohar_time); ?></span></td>
                                <?php } else { ?>
                                   <td><span class="prayerTime">১১:৪৮</span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td><span class="prayerName">আসর</span></td>
                                <?php if (!empty($asar_time)) { ?>
                                    <td><span class="prayerTime"><?php echo esc_attr($asar_time); ?></span></td>
                                <?php } else { ?>
                                   <td><span class="prayerTime">৪:০৮</span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td><span class="prayerName">মাগরিব</span></td>
                                <?php if (!empty($magrib_time)) { ?>
                                    <td><span class="prayerTime"><?php echo esc_attr($magrib_time); ?></span></td>
                                <?php } else { ?>
                                   <td><span class="prayerTime">৫:১১</span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td><span class="prayerName">ইশা</span></td>
                                <?php if (!empty($esha_time)) { ?>
                                    <td><span class="prayerTime"><?php echo esc_attr($esha_time); ?></span></td>
                                <?php } else { ?>
                                   <td><span class="prayerTime">৬:২৬</span></td>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="tableSunTimes" class="nonPrayTime">
                    <?php if (!empty($sunrise_time)) { ?>
                        <span class="sunrise">সূর্যাস্ত: <?php echo esc_attr($sunrise_time); ?></span>
                    <?php } else { ?>
                      <span class="sunrise">সূর্যাস্ত: ৫:১১ </span>
                    <?php } ?>
                    
                     <?php if (!empty($sunset_time)) { ?>
                        <span class="sunset">সূর্যোদয় : <?php echo esc_attr($sunset_time); ?> </span>
                    <?php } else { ?>
                       <span class="sunset">সূর্যোদয় : ৬:২১</span>
                    <?php } ?>
                    
                </div>
            </div>
        </div>

<?php
        echo $args['after_widget'];
    }
}

add_action('widgets_init', function () {
    register_widget('Dhepa_Prayer_Time');
});
