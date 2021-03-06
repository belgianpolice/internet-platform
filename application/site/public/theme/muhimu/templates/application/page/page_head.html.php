<?
/**
 * Belgian Police Web Platform - Theme
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<head>
    <base href="<?= url(); ?>" />
    <title><?= title() ?></title>

    <meta content="text/html; charset=utf-8" http-equiv="content-type"  />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name=”mobile-web-app-capable” content=”yes” />

    <link rel="dns-prefetch" href="//openpolice.imgix.net">

    <link rel="shortcut icon" type="image/ico" href="assets://application/images/favicon.ico" />
    <link rel="shortcut icon" type="image/png" href="assets://application/images/touch-icon.png" />
    <link rel="apple-touch-icon" type="image/png" href="assets://application/images/touch-icon.png" />

    <ktml:title>
    <ktml:meta>
    <ktml:link>
    <ktml:style>
    <ktml:script>

    <style src="assets://application/css/default.css" />
    <style src="assets://application/css/ie.css" condition="if IE 8" />
    <style src="assets://application/css/ie7.css" condition="if lte IE 7" />

    <script src="assets://application/js/apollo.min.js" />
    <script src="assets://application/js/toggler.js" />
    <script src="assets://application/components/html5shiv/dist/html5shiv-printshiv.min.js" condition="if lte IE 8" />

    <script src="assets://application/js/modernizr.js" />
    <script src="assets://application/js/fonts.js" />
    <noscript><link href="assets://application/css/fonts.css" rel="stylesheet"></noscript>

    <?php if($site && $analytics = object('application')->getCfg('analytics')) : ?>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', '<?= $analytics ?>', 'auto');
        ga('send', 'pageview');
    </script>
    <?php endif; ?>
</head>
