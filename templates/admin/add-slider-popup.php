<?php
/**
 * @var stdClass $sliders
 */
?>
<div id="hugeit_slider_media_popup" class="post-slider" style="display: none">
    <div class="post-slider">
        <div class="post-slider-block">
            <div class="slider-body">
                <div class="select-slider">
                    <h3><?php _e('Select the Slider', 'hugeit-slider'); ?></h3>
                    <div class="select-block">
                        <select class="popup_slider_list">
							<?php if (!empty($sliders)) : ?>
                                <?php foreach ( $sliders as $id => $slider ): ?>
                                    <option value="<?php echo $id; ?>"><?php echo $slider->name; ?></option>
							    <?php endforeach; ?>
                            <?php else : ?>
                                <option value=""><?php _e('You have no created slider', 'hugeit-slider'); ?></option>
							<?php endif; ?>
                        </select>
                        <button <?php disabled(empty($sliders)) ?> id="hugeit_slider_insert_slider_to_post"><?php _e('Insert Slider', 'hugeit-slider'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .popup_slider_list {
        border: 0px;
        outline: none;
        box-shadow: 0px 1px 5px #ccc;
        min-width: 150px;
    }

    #hugeit_slider_insert_slider_to_post {
        border: 0px;
        background: #0073aa;
        color: #fff;
        border-radius: 2px;
        padding: 5px 18px;
        font-size: 15px;
        position: relative;
        top: 3px;
    }
</style>