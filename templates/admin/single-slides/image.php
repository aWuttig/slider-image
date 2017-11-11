<?php

/**
 * @var Hugeit_Slider_Slide_Image $slide
 * @var int $id
 * @var array $attachment
 * @var string $src
 * @var string $title
 * @var int $attachment_id
 * @var bool $in_new_tab
 */

?>

<input type="hidden" value="<?php echo $attachment_id; ?>" class="attachment-id"/>
<div class="image-block">
    <div class="centering">
        <img src="<?php echo $src; ?>" alt="" class="slide-thumbnail"/>
    </div>

</div>
<div class="slider-option">
    <ul class="tabs-menu-<?php echo $id; ?> slide_tabs">
        <li class="current"><a href="#tab-1-<?php echo $id; ?>"><?php _e('General', 'hugeit-slider'); ?></a>
        </li>
        <li><a href="#tab-2-<?php echo $id; ?>"><?php _e('SEO', 'hugeit-slider'); ?><span> Pro </span></a></li>
        <li><a href="#tab-3-<?php echo $id; ?>"><?php _e('Crop', 'hugeit-slider'); ?><span> Pro </span></a>
        </li>
    </ul>
    <div class="tab">
        <div id="tab-1-<?php echo $id; ?>" class="tab-content active-tab">
            <table>
                <tr>
                    <td><input type="text" name="title_<?php echo $id; ?>" value="<?php echo $title; ?>"
                               class="title title"
                               placeholder="<?php _e('Title', 'hugeit-slider'); ?>"/></td>
                </tr>

                <tr>
                    <td><textarea name="description_<?php echo $id; ?>" id="description" class="description"
                                  placeholder="<?php _e('Description', 'hugeit-slider'); ?>"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input
                                type="text"
                                name="url_<?php echo $id; ?>"
                                value="<?php echo $url; ?>"
                                class="url"
                                placeholder="<?php _e('URL', 'hugeit-slider'); ?>"
                        />

                        <label>
                            <input
                                    type="checkbox"
                                    id="in_new_tab_<?php echo $id; ?>"
                                    name="in_new_tab_<?php echo $id; ?>"
                                    class="in-new-tab"
                                <?php checked($in_new_tab); ?> />

                            <?php _e('Open in new tab', 'hugeit-slider'); ?><span></span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><a href="#" class="remove-image"><?php _e('Remove Image', 'hugeit-slider'); ?></a>
                    </td>
                </tr>
            </table>
        </div>
        <div id="tab-2-<?php echo $id; ?>" class="tab-content">
            <div class="slide_disabled_tab"></div>
            <table>
                <tr>
                    <td>
                        <input type="text" name="seo_title_<?php echo $id; ?>" value="<?php echo $seo_title; ?>"
                               class="seo_title"
                               placeholder="<?php _e('Image Title Text', 'hugeit-slider'); ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="seo_alt_<?php echo $id; ?>" value="<?php echo $seo_alt; ?>"
                               class="seo_alt"
                               placeholder="<?php _e('Image Alt Text', 'hugeit-slider'); ?>"/>
                    </td>
                </tr>
            </table>
        </div>
        <div id="tab-3-<?php echo $id; ?>" class="tab-content">
            <div class="slide_disabled_tab"></div>
            <select name="crop_<?php echo $id; ?>" class="crop">
                <option value="top" <?php if ($crop == "top") echo "selected"; ?>><?php _e('Top', 'hugeit-slider'); ?></option>
                <option value="center" <?php if ($crop == "center") echo "selected"; ?>><?php _e('Center', 'hugeit-slider'); ?></option>
                <option value="bottom" <?php if ($crop == "bottom") echo "selected"; ?>><?php _e('Bottom', 'hugeit-slider'); ?></option>
            </select>
        </div>
    </div>
</div>
<div class="edit-image">
    <a href="#" class="edit"><img src="<?php echo HUGEIT_SLIDER_ADMIN_IMAGES_URL . "/edit_icon.png" ?>"
                                  title="edit image"></a>
</div>

<script>
    setTab(<?php echo $id; ?>);
</script>