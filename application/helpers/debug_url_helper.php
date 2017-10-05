<?php

function theme_url($uri) {
    $CI = & get_instance();
    return $CI->config->base_url($uri);
}

function admin_url($path = false) {
    return site_url(config_item('admin_path') . '/' . $path);
}

function agent_url($path = false) {
    return site_url(config_item('agent_path') . '/' . $path);
}
function correction_url($path = false) {
    return site_url(config_item('correction_path') . '/' . $path);
}
function clerk_url($path = false) {
    return site_url(config_item('clerk_path') . '/' . $path);
}
function surety_url($path = false) {
    return site_url(config_item('surety_path') . '/' . $path);
}


function admin_assets_url() {
    $CI = & get_instance();
    return $CI->config->base_url() . 'assets/admin/';
}

function admin_img($uri, $tag = false) {
    return theme_url('assets/admin/images/' . $uri);
}

function admin_css($uri, $tag = false) {
    return theme_url('assets/admin/css/' . $uri);
}

function admin_js($uri, $tag = false) {
    return theme_url('assets/admin/js/' . $uri);
}

function debug($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function getSlider() {

    $ci = get_instance();

    $slider = $ci->db->order_by('order')->get('tbl_slider')->result();
    ?>

    <ul class="bxslider">
    <?php foreach ($slider as $s) { ?>
            <li>
                <div class="col-lg-8 col-md-6 col-sm-6">
                    <div class="slider_note">
                        <h4><?= $s->title; ?></h4>
                        <p><?= $s->description ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <img src="<?php echo base_url() . 'uploads/slider_image/' . $s->image; ?>" />
                </div>
            </li>
    <?php } ?>

    </ul>


<?php } ?>