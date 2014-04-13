<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 9]><!--> 
<html class="no-js" lang="en" itemscope itemtype="http://schema.org/Product"> <!--<![endif]-->
<head>
	<meta charset="utf-8">

	<!-- Use the .htaccess and remove these lines to avoid edge case issues.
			 More info: h5bp.com/b/378 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Feesic 〜あの子を聴こう〜</title>
	<meta name="description" content="コミュニケーションが複雑化する世の中、気持ちを素直に伝えられない。あの人の気持ちを知りたい。そんなこと思ったことありませんか？Feesicは気持ちを音楽に変えてあなたに届けます。" />
	<meta name="keywords" content="feesic,音楽,気持ち" />
    
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

	<!-- We highly recommend you use SASS and write your custom styles in sass/_custom.scss.
		 However, there is a blank style.css in the css directory should you prefer -->
	<?php echo Asset::css('gumby.css') ?>
	<?php echo Asset::css('style.css') ?>
	<?php echo Asset::js('libs/modernizr-2.6.2.min.js') ?>
</head>

<style>
	.btn,.drawer { margin-bottom:10px; }
	.drawer { text-align: center; }
	h1.lead { border-bottom: 1px dotted #ccc; margin-bottom: 30px; }
	h4.lead { margin-bottom:10px; }
	#icon_map ul li { font-size: 16px; }
	.smallify { font-size: 13px; }
	.modal h2, .modal .btn { margin: 5% 0 20px; }
	.ttip.example { float: left; background: #eee; border: 1px dotted #ccc; padding: 20px; }
</style>

<body>
    
    <?php echo $content ?>
    
    <div class="row" style=" border-top: 1px dotted #CCCCCC; margin-top: 30px;">
        <p>&copy; Term Gomez. Tech Crunch 2014 Osaka Hackathon.<br />
            Powered by <a href="https://developer.gracenote.com/rhythm-api">Gracenote Rhythm API</a>, also uses <a href="https://developers.google.com/youtube/iframe_api_reference?hl=ja">YouTube API</a>. <a href="https://github.com/iwasaki0622/feesic">Code on GitHub.</a> <br />
            Image Presents by paylessimages,Inc.All Right Reserved.
        </p>
    </div>

	<!-- Grab Google CDN's jQuery, fall back to local if offline -->
	<!-- 2.0 for modern browsers, 1.10 for .oldie -->
	<script>
	var oldieCheck = Boolean(document.getElementsByTagName('html')[0].className.match(/\soldie\s/g));
	if(!oldieCheck) {
	document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"><\/script>');
	} else {
	document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"><\/script>');
	}
	</script>
	<script>
	if(!window.jQuery) {
	if(!oldieCheck) {
	  document.write('<script src="/js/libs/jquery-2.0.2.min.js"><\/script>');
	} else {
	  document.write('<script src="/js/libs/jquery-1.10.1.min.js"><\/script>');
	}
	}
	</script>

	<!--
	Include gumby.js followed by UI modules followed by gumby.init.js
	Or concatenate and minify into a single file -->
	<?php echo Asset::js('libs/gumby.js') ?>
	<?php echo Asset::js('libs/ui/gumby.retina.js') ?>
	<?php echo Asset::js('libs/ui/gumby.fixed.js') ?>
	<?php echo Asset::js('libs/ui/gumby.skiplink.js') ?>
	<?php echo Asset::js('libs/ui/gumby.toggleswitch.js') ?>
	<?php echo Asset::js('libs/ui/gumby.checkbox.js') ?>
	<?php echo Asset::js('libs/ui/gumby.radiobtn.js') ?>
	<?php echo Asset::js('libs/ui/gumby.tabs.js') ?>
	<?php echo Asset::js('libs/ui/jquery.validation.js') ?>
	<?php echo Asset::js('libs/gumby.init.js') ?>
    
    <?php echo Asset::js('plugins.js') ?>
    <?php echo Asset::js('main.js') ?>
    <?php echo Asset::js('player.js') ?>
    <?php echo Asset::js('timers.js') ?>
    <?php echo Asset::js('feesic.js') ?>

	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
	   chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
	<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->
    
  </body>
</html>

