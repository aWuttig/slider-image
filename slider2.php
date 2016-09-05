<?php
function hugeit_slider_add_style_to_header( $id ) {
	global $wpdb;
	$query     = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . "huge_itslider_images WHERE slider_id = '%d' ORDER BY ordering ASC", $id );
	$images    = $wpdb->get_results( $query );
	$query     = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . "huge_itslider_sliders WHERE id = '%d' ORDER BY id ASC", $id );
	$slider    = $wpdb->get_results( $query );
	$query     = "SELECT * FROM " . $wpdb->prefix . "huge_itslider_params";
	$rowspar   = $wpdb->get_results( $query );
	$paramssld = array();
	foreach ( $rowspar as $rowpar ) {
		$key               = $rowpar->name;
		$value             = $rowpar->value;
		$paramssld[ $key ] = $value;
	}
	$sliderID = isset( $slider[0]->id ) ? $slider[0]->id : '';
	$slidertitle = isset( $slider[0]->name ) ? $slider[0]->name : '';
	if ( isset( $slider[0]->sl_height ) ) {
		$sliderheight = $slider[0]->sl_height;
	} else {
		$sliderheight = '';
	}
	if ( isset( $slider[0]->sl_width ) ) {
		$sliderwidth = $slider[0]->sl_width;
	} else {
		$sliderwidth = '';
	}
	if ( isset( $slider[0]->slider_list_effects_s ) ) {
		$slidereffect = $slider[0]->slider_list_effects_s;
	} else {
		$slidereffect = '';
	}
	if ( isset( $slidepausetime ) ) {
		$slidepausetime = ( $slider[0]->description + $slider[0]->param );
	} else {
		$slidepausetime = '';
	}
	if ( isset( $slider[0]->pause_on_hover ) ) {
		$sliderpauseonhover = $slider[0]->pause_on_hover;
	} else {
		$sliderpauseonhover = '';
	}
	if ( isset( $slider[0]->sl_position ) ) {
		$sliderposition = $slider[0]->sl_position;
	} else {
		$sliderposition = '';
	}
	if ( isset( $slider[0]->param ) ) {
		$slidechangespeed = $slider[0]->param;
	} else {
		$slidechangespeed = '';
	}
	if ( isset( $slider[0]->sl_loading_icon ) ) {
		$sliderloadingicon = $slider[0]->sl_loading_icon;
	} else {
		$sliderloadingicon = '';
	}
	if ( isset( $slider[0]->show_thumb ) ) {
		$sliderthumbslider = $slider[0]->show_thumb;
	} else {
		$sliderthumbslider = '';
	}
	$sliderBorderWidth = $paramssld['slider_slideshow_border_size'];

	if ( $sliderthumbslider == 'thumbnails' ) {
		$thumbHeight = $paramssld['slider_thumb_height'] + $sliderBorderWidth;
	} else {
		$thumbHeight = 0;
	}

	$slideshow_title_position = explode('-', trim($paramssld['slider_title_position']));
	$slideshow_description_position = explode('-', trim($paramssld['slider_description_position']));
?>

	<style>
		/***<add>***/
		#huge_it_loading_image_<?php echo $sliderID; ?> {
			height:<?php echo $sliderheight; ?>px;
			width:<?php  echo $sliderwidth; ?>px;
			display: table-cell;
			text-align: center;
			vertical-align: middle;
		}
		#huge_it_loading_image_<?php echo $sliderID; ?>.display {
			display: table-cell;
		}
		#huge_it_loading_image_<?php echo $sliderID; ?>.nodisplay {
			display: none;
		}
		#huge_it_loading_image_<?php echo $sliderID; ?> img {
			margin: auto 0;
			width: 20% !important;

		}

		.huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> {
			height:<?php echo $sliderheight - 2*$sliderBorderWidth+$thumbHeight; ?>px;
			width:<?php  echo $sliderwidth - 2*$sliderBorderWidth; ?>px;
			max-width: calc(100% - <?php echo 2*$sliderBorderWidth; ?>px);
			position:relative;
			display: block;
			text-align: center;
			/*HEIGHT FROM HEADER.PHP*/
			clear:both;

			<?php
			if ($sliderposition!="left") {
				if($sliderposition=="right") {
					$position='float:right;';
				} else {
					$position='float:none; margin:0px auto;';
				}
			} else {
				$position='float:left;';
			}
			echo $position; ?>
				border-style: solid;
				border-left: 0 !important;
				border-right: 0 !important;
			<?php if($sliderloadingicon == 'off') {echo 'opacity:0';}?>
		}

		.huge_it_slideshow_image_wrap1_<?php echo $sliderID; ?>.display {
			width: 100%;
			height: 100%;
		}

		.huge_it_slideshow_image_wrap1_<?php echo $sliderID; ?>.display {
			display: block;
		}

		.huge_it_slideshow_image_wrap1_<?php echo $sliderID; ?>.nodisplay {
			opacity: 0;
		}

		.huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> * {
			box-sizing: border-box;
			-moz-box-sizing: border-box;
			-webkit-box-sizing: border-box;
		}

		.huge_it_slideshow_image_<?php echo $sliderID; ?> {
		<?php if($paramssld['slider_crop_image'] =="resize"){?> width: 100%;
			height: 100%;
		<?php } else{?> height: auto;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		<?php }?> max-width: 100%;
			max-height: 100%;

		}
		.huge_it_slideshow_image_wrap1_<?php echo $sliderID; ?>{
			height:<?php echo $sliderheight  - 2*$sliderBorderWidth; ?>px;
			width:<?php  echo $sliderwidth - 2*$sliderBorderWidth; ?>px;
			max-width: 100%;
		}
		#huge_it_slideshow_left_<?php echo $sliderID; ?>,
		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			cursor: pointer;
			display:none;
			height: 100%;
			outline: medium none;
			position: absolute;
			z-index: 13;
		<?php if($sliderthumbslider == 'thumbnails'){?>
			top:calc(50% - <?php echo $paramssld['slider_thumb_height']/2+$paramssld['slider_slideshow_border_size']; ?>px);
		<?php }else{?>
			margin-top: 0 !important;
			top: 50%;
			transform: translateY(-50%);
		<?php } ?>
		}

		#huge_it_slideshow_left-ico_<?php echo $sliderID; ?>,
		#huge_it_slideshow_right-ico_<?php echo $sliderID; ?> {
			z-index: 13;
			-moz-box-sizing: content-box;
			box-sizing: content-box;
			cursor: pointer;
			display: table;
			left: -9999px;
			line-height: 0;
			margin-top: -15px;
			position: absolute;
			top: 50%;
			/*z-index: 10135;*/
		}
		#huge_it_slideshow_left-ico_<?php echo $sliderID; ?>:hover,
		#huge_it_slideshow_right-ico_<?php echo $sliderID; ?>:hover {
			cursor: pointer;
		}

		.huge_it_slideshow_image_container_<?php echo $sliderID; ?> {
			display: table;
			position: relative;
			top:0;
			left:0;
			text-align: center;
			vertical-align: middle;
			width:100%;
			overflow:hidden;
			height: 100%;
		}

		.huge_it_slideshow_title_text_<?php echo $sliderID; ?> {
			text-decoration: none;
			position: absolute;
			z-index: 11;
			display: inline-block;
		<?php  if($paramssld['slider_title_has_margin']=='on'){
				$slider_title_width=($paramssld['slider_title_width']-6);
				$slider_title_height=($paramssld['slider_title_height']-6);
				$slider_title_margin="3";
			}else{
				$slider_title_width=($paramssld['slider_title_width']);
				$slider_title_height=($paramssld['slider_title_height']);
				$slider_title_margin="0";
			}  ?> width: <?php echo $slider_title_width; ?>%;
			/*height:
		<?php echo $slider_title_height; ?> %;*/

		<?php
			if($slideshow_title_position[0]=="left"){echo 'left:'.$slider_title_margin.'%;';}
			elseif($slideshow_title_position[0]=="center"){echo 'left:50%;';}
			elseif($slideshow_title_position[0]=="right"){echo 'right:'.$slider_title_margin.'%;';}

			if($slideshow_title_position[1]=="top"){echo 'top:'.$slider_title_margin.'%;';}
			elseif($slideshow_title_position[1]=="middle"){echo 'top:50%;';}
			elseif($slideshow_title_position[1]=="bottom"){echo 'bottom:'.$slider_title_margin.'%;';}
		 ?> padding: 2%;
			text-align: <?php echo $paramssld['slider_title_text_align']; ?>;
			font-weight: bold;
			color: #<?php echo $paramssld['slider_title_color']; ?>;

			background: <?php
				list($r,$g,$b) = array_map('hexdec',str_split($paramssld['slider_title_background_color'],2));
				$titleopacity=$paramssld["slider_title_background_transparency"]/100;
				echo 'rgba('.$r.','.$g.','.$b.','.$titleopacity.')  !important';
		?>;
			border-style: solid;
			font-size: <?php echo $paramssld['slider_title_font_size']; ?>px;
			border-width: <?php echo $paramssld['slider_title_border_size']; ?>px;
			border-color: #<?php echo $paramssld['slider_title_border_color']; ?>;
			border-radius: <?php echo $paramssld['slider_title_border_radius']; ?>px;
		}

		.huge_it_slideshow_description_text_<?php echo $sliderID; ?> {
			text-decoration: none;
			position: absolute;
			z-index: 11;
			border-style:solid;
			display: inline-block;
		<?php  if($paramssld['slider_description_has_margin']=='on'){
				$slider_description_width=($paramssld['slider_description_width']-6);
				$slider_description_height=($paramssld['slider_description_height']-6);
				$slider_description_margin="3";
			}else{
				$slider_description_width=($paramssld['slider_description_width']);
				$slider_descriptione_height=($paramssld['slider_description_height']);
				$slider_description_margin="0";
			}  ?>

			width:<?php echo $slider_description_width; ?>%;
			/*height:<?php echo $slider_description_height; ?>%;*/
		<?php
			if($slideshow_description_position[0]=="left"){echo 'left:'.$slider_description_margin.'%;';}
			elseif($slideshow_description_position[0]=="center"){echo 'left:50%;';}
			elseif($slideshow_description_position[0]=="right"){echo 'right:'.$slider_description_margin.'%;';}

			if($slideshow_description_position[1]=="top"){echo 'top:'.$slider_description_margin.'%;';}
			elseif($slideshow_description_position[1]=="middle"){echo 'top:50%;';}
			elseif($slideshow_description_position[1]=="bottom"){echo 'bottom:'.$slider_description_margin.'%;';}
		 ?>
			padding:3%;
			text-align:<?php echo $paramssld['slider_description_text_align']; ?>;
			color:#<?php echo $paramssld['slider_description_color']; ?>;

			background:<?php
			list($r,$g,$b) = array_map('hexdec',str_split($paramssld['slider_description_background_color'],2));
			$descriptionopacity=$paramssld["slider_description_background_transparency"]/100;
			echo 'rgba('.$r.','.$g.','.$b.','.$descriptionopacity.') !important';
		?>;
			border-style:solid;
			font-size:<?php echo $paramssld['slider_description_font_size']; ?>px;
			border-width:<?php echo $paramssld['slider_description_border_size']; ?>px;
			border-color:#<?php echo $paramssld['slider_description_border_color']; ?>;
			border-radius:<?php echo $paramssld['slider_description_border_radius']; ?>px;
		}

		.huge_it_slideshow_title_text_<?php echo $sliderID; ?>.none, .huge_it_slideshow_description_text_<?php echo $sliderID; ?>.none,
		.huge_it_slideshow_title_text_<?php echo $sliderID; ?>.hidden, .huge_it_slideshow_description_text_<?php echo $sliderID; ?>.hidden	   {display:none;}

		.huge_it_slideshow_title_text_<?php echo $sliderID; ?> h1, .huge_it_slideshow_description_text_<?php echo $sliderID; ?> h1,
		.huge_it_slideshow_title_text_<?php echo $sliderID; ?> h2, .huge_it_slideshow_title_text_<?php echo $sliderID; ?> h2,
		.huge_it_slideshow_title_text_<?php echo $sliderID; ?> h3, .huge_it_slideshow_title_text_<?php echo $sliderID; ?> h3,
		.huge_it_slideshow_title_text_<?php echo $sliderID; ?> h4, .huge_it_slideshow_title_text_<?php echo $sliderID; ?> h4,
		.huge_it_slideshow_title_text_<?php echo $sliderID; ?> p, .huge_it_slideshow_title_text_<?php echo $sliderID; ?> p,
		.huge_it_slideshow_title_text_<?php echo $sliderID; ?> strong,  .huge_it_slideshow_title_text_<?php echo $sliderID; ?> strong,
		.huge_it_slideshow_title_text_<?php echo $sliderID; ?> span, .huge_it_slideshow_title_text_<?php echo $sliderID; ?> span,
		.huge_it_slideshow_title_text_<?php echo $sliderID; ?> ul, .huge_it_slideshow_title_text_<?php echo $sliderID; ?> ul,
		.huge_it_slideshow_title_text_<?php echo $sliderID; ?> li, .huge_it_slideshow_title_text_<?php echo $sliderID; ?> li {
			padding:2px;
			margin:0;
		}

		.huge_it_slide_container_<?php echo $sliderID; ?> {
			display: table-cell;
			margin: 0 auto;
			position: relative;
			vertical-align: middle;
			width:100%;
			height:100%;
			_width: inherit;
			_height: inherit;
		}
		.huge_it_slide_bg_<?php echo $sliderID; ?> {
			margin: 0 auto;
			width:100%;
			height:100%;
			_width: inherit;
			_height: inherit;
		}
		.huge_it_slide_bg_<?php echo $sliderID; ?> li img{
			position: absolute;
		<?php if($paramssld['slider_crop_image'] != 'crop') { ?>
			/*top: -<?php echo $paramssld['slider_slideshow_border_size']; ?>px !important;
                    left: -<?php echo $paramssld['slider_slideshow_border_size']; ?>px !important;*/
			left:0;
		<?php }?>
			height: 100%;
		}
		.huge_it_slide_bg_<?php echo $sliderID; ?> li iframe{
			width: 100%;
			height: 100%;
		}
		.huge_it_slider_<?php echo $sliderID; ?> {
			width:100%;
			height:100%;
			display:table !important;
			padding:0 !important;
			margin:0 !important;

		}
		.huge_it_slideshow_image_item_<?php echo $sliderID; ?> {
			width:100%;
			height:100%;
			_width: inherit;
			_height: inherit;
			display: table-cell;
			filter: Alpha(opacity=100);
			opacity: 1;
			position: absolute !important;
			top:0 !important;
			left:0 !important;
			vertical-align: middle;
			z-index: 1;
			margin:0 !important;
			padding:0 !important;
			overflow: hidden !important;
			border-radius: <?php echo $paramssld['slider_slideshow_border_radius']; ?>px !important;
		}
		.huge_it_slideshow_image_second_item_<?php echo $sliderID; ?> {
			width:100%;
			height:100%;
			_width: inherit;
			_height: inherit;
			display: table-cell;
			filter: Alpha(opacity=0);
			opacity: 0;
			position: absolute !important;
			top:0 !important;
			left:0 !important;
			vertical-align: middle;
			overflow:hidden;
			margin:0 !important;
			visibility:visible !important;
			padding:0 !important;
			border-radius: <?php echo $paramssld['slider_slideshow_border_radius']; ?>px !important;
		}
		.huge_it_slideshow_image_second_item_<?php echo $sliderID; ?> a, .huge_it_slideshow_image_item_<?php echo $sliderID; ?> a {
			display:block;
			width:100%;
			height:100%;
		}

		.huge_it_grid_<?php echo $sliderID; ?> {
			display: none;
			height: 100%;
			overflow: hidden;
			position: absolute;
			width: 100%;
		}
		.huge_it_gridlet_<?php echo $sliderID; ?> {
			opacity: 1;
			filter: Alpha(opacity=100);
			position: absolute;
		}
		.huge_it_slideshow_dots_container_<?php echo $sliderID; ?> {
			display: table;
			position: absolute;
			width:100% !important;
			height:100% !important;
		}
		.huge_it_slideshow_dots_thumbnails_<?php echo $sliderID; ?> {
			margin: 0 auto;
			overflow: hidden;
			position: absolute;
			width:100%;
			height:30px;
		}

		.huge_it_slideshow_dots_<?php echo $sliderID; ?> {
			display: inline-block;
			position: relative;
			cursor: pointer;
			box-shadow: 1px 1px 1px rgba(0,0,0,0.1) inset, 1px 1px 1px rgba(255,255,255,0.1);
			width:10px;
			height: 10px;
			border-radius: 10px;
			background: #00f;
			margin: 10px;
			overflow: hidden;
			z-index: 17;
		}

		.huge_it_slideshow_dots_active_<?php echo $sliderID; ?> {
			opacity: 1;
			filter: Alpha(opacity=100);
		}
		.huge_it_slideshow_dots_deactive_<?php echo $sliderID; ?> {

		}

		.huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> {
			background:#<?php echo $paramssld['slider_slider_background_color']; ?>;
			border-width:<?php echo $paramssld['slider_slideshow_border_size']; ?>px;
			border-color:#<?php echo $paramssld['slider_slideshow_border_color']; ?>;
			border-radius:<?php echo $paramssld['slider_slideshow_border_radius']; ?>px;
		}
		.huge_it_slideshow_image_wrap_<?php echo $sliderID; ?>.nocolor {
			background: transparent;
		}

		.huge_it_slideshow_dots_thumbnails_<?php echo $sliderID; ?> {
		<?php if($sliderthumbslider == "dotstop" && $sliderthumbslider != "thumbnails" && $paramssld['slider_dots_position_new']=='dotsbottom'){?>
			bottom:0;
		<?php }else if($sliderthumbslider == "thumbnails" || $sliderthumbslider=="nonav"){?>
			display:none;
		<?php
		}else if($sliderthumbslider == "dotstop"){ ?>
			top:0; <?php } ?>
		}

		.huge_it_slideshow_dots_<?php echo $sliderID; ?> {
			background:#<?php echo $paramssld['slider_dots_color']; ?>;
		}

		.huge_it_slideshow_dots_active_<?php echo $sliderID; ?> {
			background:#<?php echo $paramssld['slider_active_dot_color']; ?>;
		}

		<?php
		require_once(dirname(__FILE__) . '/slider_front_end.html.php');
		if (isset($GLOBALS['thumbnail_width'])) {
			$width_huge=$GLOBALS['thumbnail_width'];
		}else{
			$width_huge='';
		}
		?>
		/*//////////////////////slider thunbnail styles start///////////////////////////*/

		.bx-viewport {
			height: <?php echo $paramssld['slider_thumb_height']; ?>px !important;
			-webkit-transform: translatez(0);
		}
		.entry-content .huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> a{
			border-bottom: none !important;
		}
		.entry-content .huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> li{
			margin:0 !important;
			padding: 0 !important;
		}
		.entry-content .huge_it_slideshow_image_wrap_<?php echo $sliderID; ?> ul{
			list-style-type:none !important;
			margin: 0 !important;
			padding: 0 !important;
		}
		.bx-wrapper {
			position: relative;
			margin: 0 auto 0 auto;
			padding: 0;
			max-width: <?php echo $width_huge; ?>px !important;
			*zoom: 1;
			-ms-touch-action: pan-y;
			touch-action: pan-y;
		}
		.huge_it_slideshow_thumbs_container_<?php echo $sliderID; ?>{
		<?php if($sliderthumbslider == "dotstop" || $sliderthumbslider == "dotsbottom" || $sliderthumbslider == "nonav"){?>
			display: none;
		<?php }?>
		}
		.huge_it_slideshow_thumbs_<?php echo $sliderID; ?>{

			margin: 0;
		}
		.huge_it_slideshow_thumbs_<?php echo $sliderID; ?> li{
			display: inline-block;

			height: <?php echo $paramssld['slider_thumb_height']; ?>px ;

		}
		.huge_it_slideshow_thumbnails_<?php echo $sliderID; ?> {
			display: inline-block;
			position: relative;
			cursor: pointer;
			background: #<?php echo $paramssld['slider_thumb_back_color']; ?>;
			z-index: 17;
			height: <?php echo $paramssld['slider_thumb_height']; ?>px;
		}
		.sl_thumb_img{
			width: 100% !important;
			height: 100% !important;
			display: block;
			margin: 0 auto;
		}
		.sl_thumb_img2{
			height: 100% !important;
			display: block;
			margin: 0 auto;
		}
		.trans_back{
			width: 100%;
			height: 100%;
			top:0;
			position: absolute;
			background:<?php
				list($ri,$gi,$bi) = array_map('hexdec',str_split($paramssld['slider_thumb_passive_color'],2));
				$titleopacity2=$paramssld["slider_thumb_passive_color_trans"]/100;
				echo 'rgba('.$ri.','.$gi.','.$bi.','.$titleopacity2.')';
		?>;
			transition: 0.3s ease;
		}
		.trans_back:hover{
			background:none !important;
		}
		.play-icon.youtube {background:url(<?php echo plugins_url("images/play.youtube.png", __FILE__)?>) center center no-repeat;
			width: 100%;
			height: 100%;
			top:0;
			position: absolute;}

		.play-icon.vimeo {background:url(<?php echo plugins_url("images/play.vimeo.png", __FILE__)?>) center center no-repeat;
			width: 100%;
			height: 100%;
			top:0;
			position: absolute;
		}
		.bx-wrapper {

			border: 0 solid #fff;
			background: #fff;
		}

		/*////////////slider thunbnail styles end//////////////*/

		<?php

		$arrowfolder=plugins_url('slider-image/Front_images/arrows');
		switch ($paramssld['slider_navigation_type']) {
			case 1:
				?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:0;
			margin-top:-21px;
			height:43px;
			width:29px;
			background:url(<?php echo $arrowfolder;?>/arrows.simple.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:0;
			margin-top:-21px;
			height:43px;
			width:29px;
			background:url(<?php echo $arrowfolder;?>/arrows.simple.png) right top no-repeat;
			background-size: 200%;

		}
		<?php
		break;
	case 2:
		?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:0;
			margin-top:-25px;
			height:50px;
			width:50px;
			background:url(<?php echo $arrowfolder;?>/arrows.circle.shadow.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:0;
			margin-top:-25px;
			height:50px;
			width:50px;
			background:url(<?php echo $arrowfolder;?>/arrows.circle.shadow.png) right top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_left_<?php echo $sliderID; ?>:hover {
			background-position:left -50px;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?>:hover {
			background-position:right -50px;
		}
		<?php
		break;
	case 3:
		?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:0;
			margin-top:-22px;
			height:44px;
			width:44px;
			background:url(<?php echo $arrowfolder;?>/arrows.circle.simple.dark.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:0;
			margin-top:-22px;
			height:44px;
			width:44px;
			background:url(<?php echo $arrowfolder;?>/arrows.circle.simple.dark.png) right top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_left_<?php echo $sliderID; ?>:hover {
			background-position:left -44px;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?>:hover {
			background-position:right -44px;
		}
		<?php
		break;
	case 4:
		?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:0;
			margin-top:-33px;
			height:65px;
			width:59px;
			background:url(<?php echo $arrowfolder;?>/arrows.cube.dark.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:0;
			margin-top:-33px;
			height:65px;
			width:59px;
			background:url(<?php echo $arrowfolder;?>/arrows.cube.dark.png) right top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_left_<?php echo $sliderID; ?>:hover {
			background-position:left -66px;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?>:hover {
			background-position:right -66px;
		}
		<?php
		break;
	case 5:
		?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:0;
			margin-top:-18px;
			height:37px;
			width:40px;
			background:url(<?php echo $arrowfolder;?>/arrows.light.blue.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:0;
			margin-top:-18px;
			height:37px;
			width:40px;
			background:url(<?php echo $arrowfolder;?>/arrows.light.blue.png) right top no-repeat;
			background-size: 200%;
		}

		<?php
		break;
	case 6:
		?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:0;
			margin-top:-25px;
			height:50px;
			width:50px;
			background:url(<?php echo $arrowfolder;?>/arrows.light.cube.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:0;
			margin-top:-25px;
			height:50px;
			width:50px;
			background:url(<?php echo $arrowfolder;?>/arrows.light.cube.png) right top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_left_<?php echo $sliderID; ?>:hover {
			background-position:left -50px;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?>:hover {
			background-position:right -50px;
		}
		<?php
		break;
	case 7:
		?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:0;
			right:0;
			margin-top:-19px;
			height:38px;
			width:38px;
			background:url(<?php echo $arrowfolder;?>/arrows.light.transparent.circle.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:0;
			margin-top:-19px;
			height:38px;
			width:38px;
			background:url(<?php echo $arrowfolder;?>/arrows.light.transparent.circle.png) right top no-repeat;
			background-size: 200%;
		}
		<?php
		break;
	case 8:
		?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:0;
			margin-top:-22px;
			height:45px;
			width:45px;
			background:url(<?php echo $arrowfolder;?>/arrows.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:0;
			margin-top:-22px;
			height:45px;
			width:45px;
			background:url(<?php echo $arrowfolder;?>/arrows.png) right top no-repeat;
			background-size: 200%;
		}
		<?php
		break;
	case 9:
		?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:0;
			margin-top:-22px;
			height:45px;
			width:45px;
			background:url(<?php echo $arrowfolder;?>/arrows.circle.blue.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:0;
			margin-top:-22px;
			height:45px;
			width:45px;
			background:url(<?php echo $arrowfolder;?>/arrows.circle.blue.png) right top no-repeat;
			background-size: 200%;
		}
		<?php
		break;
	case 10:
		?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:0;
			margin-top:-24px;
			height:48px;
			width:48px;
			background:url(<?php echo $arrowfolder;?>/arrows.circle.green.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:0;
			margin-top:-24px;
			height:48px;
			width:48px;
			background:url(<?php echo $arrowfolder;?>/arrows.circle.green.png) right top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_left_<?php echo $sliderID; ?>:hover {
			background-position:left -48px;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?>:hover {
			background-position:right -48px;
		}
		<?php
		break;
	case 11:
		?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:0;
			margin-top:-29px;
			height:58px;
			width:55px;
			background:url(<?php echo $arrowfolder;?>/arrows.blue.retro.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:0;
			margin-top:-29px;
			height:58px;
			width:55px;
			background:url(<?php echo $arrowfolder;?>/arrows.blue.retro.png) right top no-repeat;
			background-size: 200%;
		}
		<?php
		break;
	case 12:
		?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:0;
			margin-top:-37px;
			height:74px;
			width:74px;
			background:url(<?php echo $arrowfolder;?>/arrows.green.retro.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:0;
			margin-top:-37px;
			height:74px;
			width:74px;
			background:url(<?php echo $arrowfolder;?>/arrows.green.retro.png) right top no-repeat;
			background-size: 200%;
		}
		<?php
		break;
	case 13:
		?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:0;
			margin-top:-16px;
			height:33px;
			width:33px;
			background:url(<?php echo $arrowfolder;?>/arrows.red.circle.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:0;
			margin-top:-16px;
			height:33px;
			width:33px;
			background:url(<?php echo $arrowfolder;?>/arrows.red.circle.png) right top no-repeat;
			background-size: 200%;
		}
		<?php
		break;
	case 14:
		?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:0;
			margin-top:-51px;
			height:102px;
			width:52px;
			background:url(<?php echo $arrowfolder;?>/arrows.triangle.white.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:0;
			margin-top:-51px;
			height:102px;
			width:52px;
			background:url(<?php echo $arrowfolder;?>/arrows.triangle.white.png) right top no-repeat;
			background-size: 200%;
		}
		<?php
		break;
	case 15:
		?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:0;
			margin-top:-19px;
			height:39px;
			width:70px;
			background:url(<?php echo $arrowfolder;?>/arrows.ancient.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:0;
			margin-top:-19px;
			height:39px;
			width:70px;
			background:url(<?php echo $arrowfolder;?>/arrows.ancient.png) right top no-repeat;
			background-size: 200%;
		}
		<?php
		break;
	case 16:
		?>
		#huge_it_slideshow_left_<?php echo $sliderID; ?> {
			left:-21px;
			margin-top:-20px;
			height:40px;
			width:37px;
			background:url(<?php echo $arrowfolder;?>/arrows.black.out.png) left  top no-repeat;
			background-size: 200%;
		}

		#huge_it_slideshow_right_<?php echo $sliderID; ?> {
			right:-21px;
			margin-top:-20px;
			height:40px;
			width:37px;
			background:url(<?php echo $arrowfolder;?>/arrows.black.out.png) right top no-repeat;
			background-size: 200%;
		}
		<?php
		break;
}
?>
		<?php
		/***<For Responsive slider>***/
		if((int)$sliderwidth != 0){
			$titleValue = (int)$paramssld['slider_title_font_size']/(int)$sliderwidth;
			$descValue = (int)$paramssld['slider_description_font_size']/(int)$sliderwidth;
			$dotsValue = 10/(int)$sliderwidth;
		}


		for($i=$sliderwidth; $i>148; $i = $i-28) {
		?>

		@media screen and (max-width: <?php echo $i;?>px) {

			.huge_it_slideshow_title_text_<?php echo $sliderID; ?> {

				font-size: <?php echo  $titleValue*$i;?>px !important;

			}
			.huge_it_slideshow_description_text_<?php echo $sliderID; ?> {

				font-size: <?php echo  $descValue*$i;?>px !important;

			}
			.huge_it_slideshow_dots_thumbnails_<?php echo $sliderID; ?> .huge_it_slideshow_dots_<?php echo $sliderID; ?> {

				width:<?php echo $dotsValue*$i; ?>px;
				height:<?php echo $dotsValue*$i; ?>px;
				border-radius:<?php echo $dotsValue*$i; ?>px;
				margin: <?php echo $dotsValue*$i; ?>px;

			}
		<?php

				$arrowfolder=plugins_url('slider-image/Front_images/arrows');
				$arrowValue = $i/$sliderwidth;
				switch ($paramssld['slider_navigation_type']) {
					case 1:
						?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:0;
				margin-top:<?php echo -21*$arrowValue;?>px;
				height:<?php echo 43*$arrowValue;?>43px;
				width:<?php echo 29*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.simple.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:0;
				margin-top:<?php echo -21*$arrowValue;?>px;
				height:<?php echo 43*$arrowValue;?>px;
				width:<?php echo 29*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.simple.png) right top no-repeat;
				background-size: 200%;

			}
		<?php
		break;
	case 2:
		?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:0;
				margin-top:<?php echo -25*$arrowValue;?>px;
				height:<?php echo 50*$arrowValue;?>px;
				width:<?php echo 50*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.circle.shadow.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:0;
				margin-top:<?php echo -25*$arrowValue;?>px;
				height:<?php echo 50*$arrowValue;?>px;
				width:<?php echo 50*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.circle.shadow.png) right top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_left_<?php echo $sliderID; ?>:hover {
				background-position:left <?php echo -50*$arrowValue;?>px;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?>:hover {
				background-position:right <?php echo -50*$arrowValue;?>px;
			}
		<?php
		break;
	case 3:
		?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:0;
				margin-top:<?php echo -22*$arrowValue;?>px;
				height:<?php echo 44*$arrowValue;?>px;
				width:<?php echo 44*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.circle.simple.dark.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:0;
				margin-top:<?php echo -22*$arrowValue;?>px;
				height:<?php echo 44*$arrowValue;?>px;
				width:<?php echo 44*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.circle.simple.dark.png) right top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_left_<?php echo $sliderID; ?>:hover {
				background-position:left <?php echo -44*$arrowValue;?>px;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?>:hover {
				background-position:right <?php echo -44*$arrowValue;?>px;
			}
		<?php
		break;
	case 4:
		?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:0;
				margin-top:<?php echo -33*$arrowValue;?>px;
				height:<?php echo 65*$arrowValue;?>px;
				width:<?php echo 59*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.cube.dark.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:0;
				margin-top:<?php echo -33*$arrowValue;?>px;
				height:<?php echo 65*$arrowValue;?>px;
				width:<?php echo 59*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.cube.dark.png) right top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_left_<?php echo $sliderID; ?>:hover {
				background-position:left <?php echo 66*$arrowValue;?>px;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?>:hover {
				background-position:right <?php echo 66*$arrowValue;?>px;
			}
		<?php
		break;
	case 5:
		?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:0;
				margin-top:<?php echo -18*$arrowValue;?>px;
				height:<?php echo 37*$arrowValue;?>px;
				width:<?php echo 40*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.light.blue.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:0;
				margin-top:<?php echo -18*$arrowValue;?>px;
				height:<?php echo 37*$arrowValue;?>px;
				width:<?php echo 40*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.light.blue.png) right top no-repeat;
				background-size: 200%;
			}

		<?php
		break;
	case 6:
		?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:0;
				margin-top:<?php echo -25*$arrowValue;?>px;
				height:<?php echo 50*$arrowValue;?>px;
				width:<?php echo 50*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.light.cube.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:0;
				margin-top:<?php echo -25*$arrowValue;?>px;
				height:<?php echo 50*$arrowValue;?>px;
				width:<?php echo 50*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.light.cube.png) right top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_left_<?php echo $sliderID; ?>:hover {
				background-position:left <?php echo -50*$arrowValue;?>px;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?>:hover {
				background-position:right <?php echo -50*$arrowValue;?>px;
			}
		<?php
		break;
	case 7:
		?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:0;
				right:0;
				margin-top:<?php echo -19*$arrowValue;?>px;
				height:<?php echo 38*$arrowValue;?>px;
				width:<?php echo 38*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.light.transparent.circle.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:0;
				margin-top:<?php echo -19*$arrowValue;?>px;
				height:<?php echo 38*$arrowValue;?>px;
				width:<?php echo 38*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.light.transparent.circle.png) right top no-repeat;
				background-size: 200%;
			}
		<?php
		break;
	case 8:
		?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:0;
				margin-top:<?php echo -22*$arrowValue;?>px;
				height:<?php echo 45*$arrowValue;?>px;
				width:<?php echo 45*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:0;
				margin-top:<?php echo -22*$arrowValue;?>px;
				height:<?php echo 45*$arrowValue;?>px;
				width:<?php echo 45*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.png) right top no-repeat;
				background-size: 200%;
			}
		<?php
		break;
	case 9:
		?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:0;
				margin-top:-<?php echo 22*$arrowValue;?>px;
				height:<?php echo 45*$arrowValue;?>px;
				width:<?php echo 45*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.circle.blue.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:0;
				margin-top:-<?php echo 22*$arrowValue;?>px;
				height:<?php echo 45*$arrowValue;?>px;
				width:<?php echo 45*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.circle.blue.png) right top no-repeat;
				background-size: 200%;
			}
		<?php
		break;
	case 10:
		?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:0;
				margin-top:-<?php echo 24*$arrowValue;?>px;
				height:<?php echo 48*$arrowValue;?>px;
				width:<?php echo 48*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.circle.green.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:0;
				margin-top:-<?php echo 24*$arrowValue;?>px;
				height:<?php echo 48*$arrowValue;?>px;
				width:<?php echo 48*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.circle.green.png) right top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_left_<?php echo $sliderID; ?>:hover {
				background-position:left -<?php echo 48*$arrowValue;?>px;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?>:hover {
				background-position:right -<?php echo 48*$arrowValue;?>px;
			}
		<?php
		break;
	case 11:
		?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:0;
				margin-top:-<?php echo 29*$arrowValue;?>px;
				height:<?php echo 58*$arrowValue;?>px;
				width:<?php echo 55*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.blue.retro.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:0;
				margin-top:-<?php echo 29*$arrowValue;?>px;
				height:<?php echo 58*$arrowValue;?>px;
				width:<?php echo 55*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.blue.retro.png) right top no-repeat;
				background-size: 200%;
			}
		<?php
		break;
	case 12:
		?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:0;
				margin-top:<?php echo (-37*$arrowValue);?>px;
				height:<?php echo (74*$arrowValue);?>px;
				width:<?php echo (74*$arrowValue);?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.green.retro.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:0;
				margin-top:-<?php echo 37*$arrowValue;?>px;
				height:<?php echo 74*$arrowValue;?>px;
				width:<?php echo 74*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.green.retro.png) right top no-repeat;
				background-size: 200%;
			}
		<?php
		break;
	case 13:
		?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:0;
				margin-top:-<?php echo 16*$arrowValue;?>px;
				height:<?php echo 33*$arrowValue;?>px;
				width:<?php echo 33*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.red.circle.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:0;
				margin-top:-<?php echo 16*$arrowValue;?>px;
				height:<?php echo 33*$arrowValue;?>px;
				width:<?php echo 33*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.red.circle.png) right top no-repeat;
				background-size: 200%;
			}
		<?php
		break;
	case 14:
		?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:0;
				margin-top:-<?php echo 51*$arrowValue;?>px;
				height:<?php echo 102*$arrowValue;?>px;
				width:<?php echo 52*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.triangle.white.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:0;
				margin-top:-<?php echo 51*$arrowValue;?>px;
				height:<?php echo 102*$arrowValue;?>px;
				width:<?php echo 52*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.triangle.white.png) right top no-repeat;
				background-size: 200%;
			}
		<?php
		break;
	case 15:
		?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:0;
				margin-top:-<?php echo 19*$arrowValue;?>px;
				height:<?php echo 39*$arrowValue;?>px;
				width:<?php echo 70*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.ancient.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:0;
				margin-top:-<?php echo 19*$arrowValue;?>px;
				height:<?php echo 39*$arrowValue;?>px;
				width:<?php echo 70*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.ancient.png) right top no-repeat;
				background-size: 200%;
			}
		<?php
		break;
	case 16:
		?>
			#huge_it_slideshow_left_<?php echo $sliderID; ?> {
				left:-<?php echo 21*$arrowValue;?>px;
				margin-top:-<?php echo 20*$arrowValue;?>px;
				height:<?php echo 40*$arrowValue;?>px;
				width:<?php echo 37*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.black.out.png) left  top no-repeat;
				background-size: 200%;
			}

			#huge_it_slideshow_right_<?php echo $sliderID; ?> {
				right:-<?php echo 21*$arrowValue;?>px;
				margin-top:-<?php echo 20*$arrowValue;?>px;
				height:<?php echo 40*$arrowValue;?>px;
				width:<?php echo 37*$arrowValue;?>px;
				background:url(<?php echo $arrowfolder;?>/arrows.black.out.png) right top no-repeat;
				background-size: 200%;
			}
		<?php
		break;
}
?>
		}

		<?php } ?>

		/***</add>***/

	</style>


	<?php

	if ( isset( $GLOBALS['pause_time'] ) ) {
		$time_huge = $GLOBALS['pause_time'];
	} else {
		$time_huge = '';
	}
	if ( isset( $GLOBALS['changespeed'] ) ) {
		$speed_huge = $GLOBALS['changespeed'];
	} else {
		$speed_huge = '';
	}
	if ( ! isset( $paramssld['slider_thumb_count_slides'] ) ) {
		$paramssld['slider_thumb_count_slides'] = '';
	}
	$width_of_thumbs     = $width_huge / $paramssld['slider_thumb_count_slides'];
	$res_width_of_thumbs = intval( $width_of_thumbs );

	$translation_array = array(
		'slideCount'   => $paramssld['slider_thumb_count_slides'],
		'pauseTime'    => $time_huge,
		'width_thumbs' => $res_width_of_thumbs,
		'speed'        => $speed_huge,


	);
	wp_localize_script( 'bxSlider', 'hugeit_slider_obj', $translation_array );

	?>


<?php }
/***</add>***/

function huge_it_slider_activate() {
	global $wpdb;
	$sql_huge_itslider_params = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_itslider_params`(
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `name` varchar(50) 
CHARACTER SET utf8 NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
 `description` text CHARACTER SET utf8 NOT NULL,
  `value` varchar(200) CHARACTER SET utf8 NOT NULL,
  
 PRIMARY KEY (`id`)
 
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89";

	$sql_huge_itslider_images = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_itslider_images` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
 `slider_id` varchar(200) ,
 `description` text,
  `image_url` text,
  `sl_url` varchar(128) DEFAULT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(4) unsigned DEFAULT NULL,
  `published_in_sl_width` tinyint(4) unsigned DEFAULT NULL,

  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)

) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5";

	$sql_huge_itslider_sliders = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_itslider_sliders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `sl_height` int(11) unsigned DEFAULT NULL,
  `sl_width` int(11) unsigned DEFAULT NULL,
  `pause_on_hover` text,
  `slider_list_effects_s` text,
  `description` text,
  `param` text,
  `ordering` int(11) NOT NULL,
  `published` text,
  
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
  
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2";

	$table_name = $wpdb->prefix . "huge_itslider_params";
	$sql_1 = <<<query1
INSERT INTO `$table_name` (`name`, `title`,`description`, `value`) VALUES
( 'slider_crop_image', 'Slider crop image', 'Slider crop image', 'resize'),
( 'slider_title_color', 'Slider title color', 'Slider title color', '000000'),
( 'slider_title_font_size', 'Slider title font size', 'Slider title font size', '13'),
( 'slider_description_color', 'Slider description color', 'Slider description color', 'ffffff'),
( 'slider_description_font_size', 'Slider description font size', 'Slider description font size', '13'),
( 'slider_title_position', 'Slider title position', 'Slider title position', 'right-top'),
( 'slider_description_position', 'Slider description position', 'Slider description position', 'right-bottom'),
( 'slider_title_border_size', 'Slider Title border size', 'Slider Title border size', '0'),
( 'slider_title_border_color', 'Slider title border color', 'Slider title border color', 'ffffff'),
( 'slider_title_border_radius', 'Slider title border radius', 'Slider title border radius', '4'),
( 'slider_description_border_size', 'Slider description border size', 'Slider description border size', '0'),
( 'slider_description_border_color', 'Slider description border color', 'Slider description border color', 'ffffff'),
( 'slider_description_border_radius', 'Slider description border radius', 'Slider description border radius', '0'),
( 'slider_slideshow_border_size', 'Slider border size', 'Slider border size', '0'),
( 'slider_slideshow_border_color', 'Slider border color', 'Slider border color', 'ffffff'),
( 'slider_slideshow_border_radius', 'Slider border radius', 'Slider border radius', '0'),
( 'slider_navigation_type', 'Slider navigation type', 'Slider navigation type', '1'),
( 'slider_navigation_position', 'Slider navigation position', 'Slider navigation position', 'bottom'),
( 'slider_title_background_color', 'Slider title background color', 'Slider title background color', 'ffffff'),
( 'slider_description_background_color', 'Slider description background color', 'Slider description background color', '000000'),
( 'slider_title_transparent', 'Slider title has background', 'Slider title has background', 'on'),
( 'slider_description_transparent', 'Slider description has background', 'Slider description has background', 'on'),
( 'slider_slider_background_color', 'Slider slider background color', 'Slider slider background color', 'ffffff'),
( 'slider_dots_position', 'slider dots position', 'slider dots position', 'top'),
( 'slider_active_dot_color', 'slider active dot color', '', 'ffffff'),
( 'slider_dots_color', 'slider dots color', '', '000000');


query1;

	$table_name = $wpdb->prefix . "huge_itslider_images";
	$sql_2 = "
INSERT INTO 
`" . $table_name . "` (`id`, `slider_id`, `name`, `description`, `image_url`, `sl_url`, `ordering`, `published`) VALUES
(1, '1', '',  '', '" . plugins_url("Front_images/slides/slide1.jpg", __FILE__) . "', 'http://huge-it.com',  1, 1),
(2, '1', 'Simple Usage',  '', '" . plugins_url("Front_images/slides/slide2.jpg", __FILE__) . "', 'http://huge-it.com',  2, 1),
(3, '1', 'Huge-IT Slider',  'The slider allows having unlimited amount of images with their titles and descriptions. The slider uses autogenerated shortcodes making it easier for the users to add it to the custom location.', '" . plugins_url("Front_images/slides/slide3.jpg", __FILE__) . "', 'http://huge-it.com',  3, 1)";


	$table_name = $wpdb->prefix . "huge_itslider_sliders";


	$sql_3 = "
INSERT INTO `$table_name` (`id`, `name`, `sl_height`, `sl_width`, `pause_on_hover`, `slider_list_effects_s`, `description`, `param`, `ordering`, `published`) VALUES
(1, 'My First Slider', '375', '600', 'on', 'random', '4000', '1000', '1', '300')";




	$wpdb->query($sql_huge_itslider_params);
	$wpdb->query($sql_huge_itslider_images);
	$wpdb->query($sql_huge_itslider_sliders);

	if (!$wpdb->get_var("select count(*) from " . $wpdb->prefix . "huge_itslider_params")) {
		$wpdb->query($sql_1);
	}
	if (!$wpdb->get_var("select count(*) from " . $wpdb->prefix . "huge_itslider_images")) {
		$wpdb->query($sql_2);
	}
	if (!$wpdb->get_var("select count(*) from " . $wpdb->prefix . "huge_itslider_sliders")) {
		$wpdb->query($sql_3);
	}

	$product = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "huge_itslider_sliders", ARRAY_A);
	$isUpdate = 0;
	foreach ($product as $prod) {
		if ($prod['Field'] == 'published' && ($prod['Type'] == 'tinyint(4) unsigned')) {
			$isUpdate = 1;
			break;
		}
	}
	if ($isUpdate) {
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."huge_itslider_sliders MODIFY `published` text");
		$wpdb->query("UPDATE ".$wpdb->prefix."huge_itslider_sliders SET published = '300' WHERE id = 1 ");
	}

	$product2 = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "huge_itslider_images", ARRAY_A);
	foreach ($product2 as $prod2) {

		if($product2[6]['Field'] == 'sl_type')
		{
			echo '';
		}
		else
		{
			$query="SELECT * FROM ".$wpdb->prefix."huge_itslider_images order by id ASC";
			$rowim=$wpdb->get_results($query);
			foreach ($rowim as $key=>$rowimages){
				$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_itslider_images SET  ordering = '%s'  WHERE id = %d ", $rowimages->id,$rowimages->id));
			}
		}
	}

	if($product2[6]['Field'] == 'sl_type')
	{
		echo '';
	}
	else
	{
		$wpdb->query("ALTER TABLE  ".$wpdb->prefix."huge_itslider_images ADD  `sl_type` TEXT NOT NULL AFTER  `sl_url`");
		$wpdb->query("UPDATE ".$wpdb->prefix."huge_itslider_images SET sl_type = 'image' ");
		$wpdb->query("ALTER TABLE  ".$wpdb->prefix."huge_itslider_images ADD  `link_target` TEXT NOT NULL AFTER  `sl_type`");
		$wpdb->query("UPDATE ".$wpdb->prefix."huge_itslider_images SET link_target = 'on' ");

		$table_name = $wpdb->prefix . "huge_itslider_params";
		$sql_update2 = <<<query1
INSERT INTO `$table_name` (`name`, `title`,`description`, `value`) VALUES
( 'slider_description_width', 'Slider description width', 'Slider description width', '70'),
( 'slider_description_height', 'Slider description height', 'Slider description height', '50'),
( 'slider_description_background_transparency', 'slider description background transparency', 'slider description background transparency', '70'),
( 'slider_description_text_align', 'description text-align', 'description text-align', 'justify'),
( 'slider_title_width', 'slider title width', 'slider title width', '30'),
( 'slider_title_height', 'slider title height', 'slider title height', '50'),
( 'slider_title_background_transparency', 'slider title background transparency', 'slider title background transparency', '70'),
( 'slider_title_text_align', 'title text-align', 'title text-align', 'right');

query1;
		$wpdb->query($sql_update2);
	}
	$product3 = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "huge_itslider_sliders", ARRAY_A);
	if($product3[8]['Field'] == 'sl_position'){
		echo '';
	} else {
		$wpdb->query("ALTER TABLE  ".$wpdb->prefix."huge_itslider_sliders ADD  `sl_position` TEXT NOT NULL AFTER  `param`");
		$wpdb->query("UPDATE ".$wpdb->prefix."huge_itslider_sliders SET `sl_position` = 'center' ");
		$table_name = $wpdb->prefix . "huge_itslider_params";
		$sql_update3 = <<<query1
INSERT INTO `$table_name` (`name`, `title`,`description`, `value`) VALUES
( 'slider_title_has_margin', 'title has margin', 'title has margin', 'on'),
( 'slider_description_has_margin', 'description has margin', 'description has margin', 'on'),
( 'slider_show_arrows', 'Slider show left right arrows', 'Slider show left right arrows', 'on');

query1;
		$wpdb->query($sql_update3);
	}
	$productSliders = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "huge_itslider_sliders", ARRAY_A);//get table fields
	$isUpdate1 = 0;
	foreach ($productSliders as $PSlider) {
		if ($PSlider['Field'] == 'sl_loading_icon') {
			$isUpdate1 = 1;
			break;
		}
	}
	if ($isUpdate1 == 0) {
		$wpdb->query("ALTER TABLE "  .$wpdb->prefix . "huge_itslider_sliders ADD `sl_loading_icon` text NOT NULL AFTER `published`");
		$wpdb->query("UPDATE " . $wpdb->prefix ."huge_itslider_sliders SET `sl_loading_icon` = 'off' ");
	}

	$product4 = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "huge_itslider_images", ARRAY_A);
	if($product4[8]['Field'] != 'sl_stitle') {
		$wpdb->query("ALTER TABLE  ".$wpdb->prefix."huge_itslider_images ADD  `sl_stitle` TEXT NOT NULL AFTER  `link_target`");
		$wpdb->query("ALTER TABLE  ".$wpdb->prefix."huge_itslider_images ADD  `sl_sdesc` TEXT NOT NULL AFTER  `sl_stitle`");
		$wpdb->query("ALTER TABLE  ".$wpdb->prefix."huge_itslider_images ADD  `sl_postlink` TEXT NOT NULL AFTER  `sl_sdesc`");
	}

	$table_name = $wpdb->prefix . "huge_itslider_params";
	$sql_update4 = <<<query2
INSERT INTO `$table_name` (`name`, `title`,`description`, `value`) VALUES
('loading_icon_type', 'Slider loading icon type', 'Slider loading icon type', '1');
query2;
	$query3="SELECT name FROM ".$table_name;
	$update_p3=$wpdb->get_results($query3);
	if(end($update_p3)->name=='slider_show_arrows'){
		$wpdb->query($sql_update4);
	}

	///////////////
	$table_name = $wpdb->prefix . "huge_itslider_params";
	$sql_update_g6 = <<<query6
INSERT INTO `$table_name` (`name`, `title`,`description`, `value`) VALUES
('slider_thumb_count_slides', 'Slide thumbs count', 'Slide thumbs count', '3'),
('slider_dots_position_new', 'Slide Dots Position', 'Slide Dots Position', 'dotstop'),
('slider_thumb_back_color','Thumbnail Background Color','Thumbnail Background Color','FFFFFF'),
('slider_thumb_passive_color','Passive Thumbnail Color','Passive Thumbnail Color','FFFFFF'),
('slider_thumb_passive_color_trans','Passive Thumbnail Color Transparency','Passive Thumbnail Color Transparency','50'),
('slider_thumb_height', 'Slider Thumb Height', 'Slider Thumb Height', '100');                
query6;


	$query6="SELECT name FROM ".$wpdb->prefix."huge_itslider_params";
	$update_p6=$wpdb->get_results($query6);
	if(end($update_p6)->name=='loading_icon_type'){
		$wpdb->query($sql_update_g6);
	}

///////////////////////////////////////////////////////////////////////
	$imagesAllFieldsInArray3 = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "huge_itslider_sliders", ARRAY_A);
	$fornewUpdate2 = 0;
	foreach ( $imagesAllFieldsInArray3 as $portfoliosField3 ) {
		if ( $portfoliosField3['Field'] == 'show_thumb' ) {
			$fornewUpdate2 = 1;
		}
	}
	if($fornewUpdate2 != 1){
		$wpdb->query("ALTER TABLE `".$wpdb->prefix."huge_itslider_sliders` ADD `show_thumb` VARCHAR(255) NOT NULL DEFAULT 'dotstop' AFTER `sl_loading_icon`");

	}
	$imagesAllFieldsInArray4 = $wpdb->get_results( "DESCRIBE " . $wpdb->prefix . "huge_itslider_sliders", ARRAY_A );
	$fornewUpdate3           = 0;
	foreach ( $imagesAllFieldsInArray4 as $portfoliosField4 ) {
		if ( $portfoliosField4['Field'] == 'video_autoplay' ) {
			$fornewUpdate3 = 1;
		}
	}
	if($fornewUpdate3 != 1){
		$wpdb->query("ALTER TABLE `".$wpdb->prefix."huge_itslider_sliders` ADD `video_autoplay` VARCHAR(255) NOT NULL DEFAULT 'off' AFTER `show_thumb`");

	}
	$imagesAllFieldsInArray5 = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "huge_itslider_sliders", ARRAY_A);
	$fornewUpdate4 = 0;
	foreach ($imagesAllFieldsInArray5 as $portfoliosField5) {
		if ($portfoliosField5['Field'] == 'random_images') {
			$fornewUpdate4=1;
		}
	}
	if($fornewUpdate4 != 1){
		$wpdb->query("ALTER TABLE `".$wpdb->prefix."huge_itslider_sliders` ADD `random_images` VARCHAR(255) NOT NULL DEFAULT 'off' AFTER `video_autoplay`");
	}
	/****<change image table url type>****/

	$table_name =  $wpdb->prefix."huge_itslider_images";

	$sql_huge_itslider_images_change_column_type = "ALTER TABLE `$table_name` MODIFY COLUMN `sl_url` text ";

	$wpdb->query($sql_huge_itslider_images_change_column_type);

	/****</change image table url type>****/
}
register_activation_hook(plugins_url(plugin_basename( __FILE__ ),__FILE__), 'huge_it_slider_activate');
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$plugin_info = get_plugin_data( ABSPATH . 'wp-content/plugins/slider-image/slider.php' );
if($plugin_info['Version'] > '2.9.2'){
	huge_it_slider_activate();
}
