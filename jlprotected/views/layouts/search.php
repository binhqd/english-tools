<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>	
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php 
	GNAssetHelper::init(array(
		'image'		=> 'img',
		'css'		=> 'css',
		'script'	=> 'js',
	));
	?>
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	
	<?php 
	GNAssetHelper::setBase('justlook');
	GNAssetHelper::setPriority(100);
 	GNAssetHelper::cssFile('reset');
 	GNAssetHelper::cssFile('fonts/UTMAlterGothicRegular');
	GNAssetHelper::cssFile('common');
	GNAssetHelper::cssFile('common-more');
	GNAssetHelper::cssFile('top-menu');	
   	GNAssetHelper::cssFile('top-menu-more');
	GNAssetHelper::cssFile('your-stat');
	GNAssetHelper::cssFile('jquery.fancybox-1.3.4');
	GNAssetHelper::cssFile('tooltip.ie.fix');
	GNAssetHelper::cssFile('bt-wrapper-tooltip');
	GNAssetHelper::cssFile('validationEngine.jquery');
	GNAssetHelper::cssFile('bt-big-2');
	GNAssetHelper::cssFile('jquery.rating');
	GNAssetHelper::cssFile('pagination-yii');
	GNAssetHelper::cssFile('search-result-pagination-yii');
	GNAssetHelper::cssFile('jlbd.message');
	GNAssetHelper::cssFile('jlbd.dialog');
	GNAssetHelper::cssFile('jlbd.notify');
	GNAssetHelper::cssFile('jl-alert-bootraps');
	GNAssetHelper::cssFile('jquery.gritter');
	GNAssetHelper::cssFile('footer');
	
// 	GNAssetHelper::cssFile('login-page');
	GNAssetHelper::cssFile('db-note');
	GNAssetHelper::cssFile('button-big');
// 	GNAssetHelper::cssFile("fix-top-menu-dashboard");
	
	/* Tooltip - TipTip */
	GNAssetHelper::cssFile('tipTip');
	GNAssetHelper::scriptFile('jquery.tipTip.minified', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jquery.mousewheel', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jquery.em', CClientScript::POS_END);
	/** placeholder **/
    GNAssetHelper::scriptFile('jquery.watermark', CClientScript::POS_END);
	/** Add css file : Disable item menu is null **/
	GNAssetHelper::cssFile('menu-mutil-disable');
    GNAssetHelper::cssFile('top-list-city');	
	GNAssetHelper::scriptFile('jlbd', CClientScript::POS_HEAD);
	GNAssetHelper::scriptFile('jlbd.message', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jlbd.dialog', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jlbd.notify', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jquery.gritter', CClientScript::POS_HEAD);
	GNAssetHelper::scriptFile('jquery.cookies.2.2.0.min', CClientScript::POS_HEAD);
	
	GNAssetHelper::setPriority(99);
	GNAssetHelper::scriptFile('jquery.bt', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jquery.tmpl.min', CClientScript::POS_HEAD);
	GNAssetHelper::scriptFile('jquery.rating', CClientScript::POS_END);
	GNAssetHelper::scriptFile('xii.thumbnailer', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jquery.validationEngine', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jquery.validationEngine-en', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jquery.advancedAjax', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jquery.scrollIntoView', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jl-common-business', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jlbd.nav.bar', CClientScript::POS_END);
	
	GNAssetHelper::scriptFile('jlbd.popup.user', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jquery.fancybox-1.3.4.pack', CClientScript::POS_HEAD);
	?>
	
	<?php GNAssetHelper::setPriority(99);?>
	<?php
	GNAssetHelper::setBase('application.modules.reviews.assets');
	GNAssetHelper::scriptFile('jlbd.rating', CClientScript::POS_END);
	?>
	
	<?php
	GNAssetHelper::setBase('application.modules.businesses.assets');
	GNAssetHelper::scriptFile('jlbd.biz', CClientScript::POS_END);
	?>
	
	<?php
	GNAssetHelper::setBase('application.modules.user.assets');
	GNAssetHelper::scriptFile('jlbd.user', CClientScript::POS_BEGIN);
	?>
	
	<?php
	GNAssetHelper::setBase('widgets.pagination.assets');
	GNAssetHelper::scriptFile('jlbd.linkpaper', CClientScript::POS_END);
	?>
	
	<?php
	GNAssetHelper::setBase('application.modules.feedback.assets');
	GNAssetHelper::cssFile('jlbd.feedback');
	
	GNAssetHelper::scriptFile('jlbd.feedback', CClientScript::POS_END);
	GNAssetHelper::scriptFile('build/html2canvas', CClientScript::POS_END);
	GNAssetHelper::scriptFile('build/jquery.plugin.html2canvas', CClientScript::POS_END);
	GNAssetHelper::scriptFile('external/flashcanvas', CClientScript::POS_END);
	
	
	GNAssetHelper::setBase('application.modules.publicPages.assets');
	
	?>
	<!--[if lte IE 6]>
		<style type="text/css" media="all">@import "<?php echo Yii::app()->baseUrl;?>/justlook/css/ie6.css";</style>
	<![endif]-->
	<!--[if IE 7]>
		<style type="text/css" media="all">@import "<?php echo Yii::app()->baseUrl;?>/justlook/css/ie7.css";</style>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl;?>/justlook/js/json2.js"></script>
	<![endif]-->
	<!--[if IE 8]>
		<style type="text/css" media="all">@import "<?php echo Yii::app()->baseUrl;?>/justlook/css/ie8.css";</style>
	<![endif]-->
	<!--[if IE 9]>
		<style type="text/css" media="all">@import "<?php echo Yii::app()->baseUrl;?>/justlook/css/ie9.css";</style>
	<![endif]-->
</head>
<body>

<div id="Notification"></div>
<?php $this->widget('ext.jnotify.JNotify', array(
	'notificationId' => 'Notification',
	'notificationHSpace' => false,	
	'notificationVSpace' => '20px',
	'notificationWidth' => 'auto',
	'notificationShowAt' => 'topRight',
	'notificationCss' => array(
		'position'=>'fixed',
		'margin-top'=>false, // will be set by init()
		'right'=>false, // will be set by init()
		'width'=>'100%',
		'z-index'=>'9999',
		'top'=>'0px',
	)
	//'notificationShowAt'=>'bottomLeft',
	//'notificationAppendType'=>'prepend',
)); ?>

<?php $this->renderPartial('//common/jlap-rating');?>

	<div id="wd-head-container">
		<?php $this->renderPartial('//common/header')?>
		<div id="wd-nav">
			<div class="wd-center">
				<a href="<?php echo JLRouter::createAbsoluteUrl('/'); ?>" id="jl-logo">Logo</a>
				<div id="wd-head-search-form">
					<form id="frmSearch" action="<?php echo $this->createAbsoluteUrl('/search/business/');?>">
					<fieldset>
						<div class="wd-input wd-keyword">
							<?php 
							if(isset($_GET['keyword']))
								$keyword = $_GET['keyword'];
							else
								$keyword = Yii::app()->session->get('keyword');
							
                            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
								'name'=>'keyword',
								'value'=> $keyword,
								'source'=>$this->createAbsoluteUrl('/search/autocompleteKeyword'),
								// additional javascript options for the autocomplete plugin
								'options'=>array(
										'showAnim'=>'fold',
										'minLength' => '3',
										'autoFocus' => false,
								),
								'htmlOptions'=>array(
									'title' => 'Business name or type',
                                    'class' => 'jq_watermark'
								),
							));
							?>
						</div>
						<div class="wd-input wd-location">
							<?php 
							if(isset($_GET['location']) && $_GET['location'] != "")
							{
								$location = $_GET['location'];
							}					
							else
								$location = Yii::app()->session->get('location');
								
							$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
								'name' => 'location',
								'value' =>  $location,
								'source'=>$this->createAbsoluteUrl('/search/autocompleteLocation'),
								// additional javascript options for the autocomplete plugin
								'options'=>array(
										'showAnim'=>'fold',
										'minLength' => '3',
										'autoFocus' => false,
								),					
								'htmlOptions'=>array(
									'title' => 'Suburb, town, postcode or region',
                                    'class' => 'jq_watermark'
								),
							));
							?>
                            <span class="jlbd-search-dropdown-ico">&nbsp;</span>
							<div class="jlbd-list-dropdown-content">
								<ul class="jlbd-gallery-adrlc">
									<li><a title="Sydney NSW" href="<?php echo $this->createUrl('/search/business',array(
                                        'keyword' => $keyword,
                                        'location' => 'Sydney NSW'
                                    )) ?>">Sydney</a></li>
									<li><a title="Melbourne VIC" href="<?php echo $this->createUrl('/search/business',array(
                                        'keyword' => $keyword,
                                        'location' => 'Melbourne VIC'
                                    )) ?>">Melbourne</a></li>
									<li><a title="Brisbane QLD" href="<?php echo $this->createUrl('/search/business',array(
                                        'keyword' => $keyword,
                                        'location' => 'Brisbane QLD'
                                    )) ?>">Brisbane</a></li>
									<li><a title="Perth WA" href="<?php echo $this->createUrl('/search/business',array(
                                        'keyword' => $keyword,
                                        'location' => 'Perth WA'
                                    )) ?>">Perth</a></li>
									<li><a title="Adelaide SA" href="<?php echo $this->createUrl('/search/business',array(
                                        'keyword' => $keyword,
                                        'location' => 'Adelaide SA'
                                    )) ?>">Adelaide</a></li>
									<li><a title="Canberra ACT" href="<?php echo $this->createUrl('/search/business',array(
                                        'keyword' => $keyword,
                                        'location' => 'Canberra ACT'
                                    )) ?>">Canberra</a></li>
									<li><a title="Hobart TAS" href="<?php echo $this->createUrl('/search/business',array(
                                        'keyword' => $keyword,
                                        'location' => 'Hobart TAS'
                                    )) ?>">Hobart</a></li>
									<li><a title="Darwin NT" href="<?php echo $this->createUrl('/search/business',array(
                                        'keyword' => $keyword,
                                        'location' => 'Darwin NT'
                                    )) ?>">Darwin</a></li>
                                    <li><a title="Wollongong NSW" href="<?php echo $this->createUrl('/search/business',array(
                                        'keyword' => $keyword,
                                        'location' => 'Wollongong NSW'
                                    )) ?>">Wollongong</a></li>
									<li><a title="More" href="<?php echo $this->createUrl('/browse/business',array(
                                        'by' => 'location',
                                    )) ?>">More....</a></li>
								</ul>
							</div>
						</div>
						<div class="wd-submit">
							<input type="submit" value="" />
						</div>
					</fieldset>
					</form>
				</div>
				<?php 
				if (!currentUser()->isGuest) {
						$arrMenu = array(
							array(
								'label'		=>	'user home',
								'url'		=>	JLRouter::createUrl('/dashboard'),
								'itemOptions' => array('class' => 'wd-home'),
								'activePaths'	=> array('/^\/dashboard$/'), 
								'items'		=>	null,
							),
							array(
								'label'		=>	'Reviews',
								'url'		=>	JLRouter::createUrl('/dashboard/review/index'),
								'activePaths'	=> currentUser()->isGuest || (isset($_GET['u']) && (!currentUser()->isGuest && currentUser()->hexID!=$_GET['u'])) ? array() : array('/\/dashboard\/review$/', '/\/dashboard\/review[\/]/'),
							),
							array(
								'label'		=>	'Lists',
								'url'		=>	JLRouter::createUrl('/lists'),
								'activePaths'	=> array(
									'/^\/lists$/',
									'/^\/lists[\/]+/'
								),
								'items'		=>	array(
									array(
										'label'	=> "New Private List",
										'url'	=> JLRouter::createUrl('/lists/manage'),
										'itemOptions' => array('class' => 'first-child'),
									),
									array(
										'label'	=> "Private List",
										'url'	=> JLRouter::createUrl('/lists/private'),
									),
									array(
										'label'	=> "Published lists",
										'url'	=> JLRouter::createUrl('/lists/published'),
									),
									array(
										'label'	=> "Bookmarked lists",
										'url'	=> JLRouter::createUrl('/lists/bookmarked'),
									)	
								),
							),
							array(
								'label'		=>	'Favourites',
								'url'		=>	JLRouter::createUrl('/dashboard/favourites/index'),
								'activePaths'	=> array(
									'/\/dashboard\/favourites\/index/'
								),
							),
							array(
								'label'		=>	'Searches',
								'url'		=>	JLRouter::createUrl('/saved_search/ss'),
								'activePaths'	=> array(
									'/\/saved_search\/overview\/index/',
									'/\/saved_search[\/]+/'
								),
							),
							array(
								'label'		=>	'Friends',
								'url'		=>	JLRouter::createUrl('/dashboard/friends/viewActivities'),
								'activePaths'	=> currentUser()->isGuest || (isset($_GET['u']) && (!currentUser()->isGuest && currentUser()->hexID!=$_GET['u'])) ? array() : array(
									'/^\/dashboard\/friends$/',
									'/^\/dashboard\/friends[\/]+/',
									'/^\/recommendations\/friends[\/]+/',
								),
								'items'		=>	array(
									array(
										'label'	=> "Friend's Activities",
										'url'	=> JLRouter::createUrl('/dashboard/friends/viewActivities'),
										'itemOptions' => array('class' => 'first-child'),
									),
									array(
										'label'	=> "Find People",
										'url'	=> JLRouter::createUrl('/dashboard/friends/find'),
									),
									array(
										'label'	=> "My Friends",
										'url'	=> JLRouter::createUrl('/dashboard/friends/manage'),
									),
									array(
										'label'	=> "Pending Friends",
										'url'	=> JLRouter::createUrl('/dashboard/friends/viewPendings'),
									),
									array(
										'label'	=> "Ignore List",
										'url'	=> JLRouter::createUrl('/dashboard/friends/viewIgnorances'),
									),
									array(
										'label'	=> "Recommendations",
										'url'	=> JLRouter::createUrl('/recommendations/friends/list'),
									),
								),
							),
							array(
								'label'		=>	'Followers',
								'url'		=>	JLRouter::createUrl('/followings/follow/list'),
								'activePaths'	=> array(
										'/^\/followings$/',
										'/^\/followings[\/]+/'
								),
								'items'		=>	array(
									array(
										'label'	=> "People I Follow",
										'url'	=> JLRouter::createUrl('/followings/follow'),
										'itemOptions' => array('class' => 'first-child'),
									),
									array(
										'label'	=> "People Follow Me",
										'url'	=> JLRouter::createUrl('/followings/follows'),
									),
									array(
										'label'	=> "Settings",
										'url'	=> JLRouter::createUrl('/followings/settings'),
									),
								),
							),
							array(
								'label'		=>	'Messages',
								'url'		=>	JLRouter::createUrl('messages?prt=node#inbox'),
								'activePaths'	=> array(
									'/\/messages/'
								),
							),
							array(
								'label'		=>	'Business Centre',
								'url'		=>	JLRouter::createUrl('businessCenter'),
								'activePaths'	=> array(
										'/^\/businessCenter/'
								),
							),
							array(
								'label'		=>	'EasyWeb',
								'url'		=>	JLRouter::createUrl('easyweb'),
								'activePaths'	=> array(
									'/\/easyweb/'
								),
							),
						);
						$this->widget('widgets.multi-menu.JLBDUserMenu', array(
							'htmlOptions' 	=> array("class" => 'wd-dropdownMenu'),
							'id'=>'wd-top-menu',
							'encodeLabel' => false,	
							//'imgHome'	=>	'nav-avatar.jpg',// avatar cá»§a ngÆ°á»i dÃ¹ng truyá»n vÃ o táº¡i Ä‘Ã¢y
							'arrMenu' => $arrMenu,
							'binUserID' => currentUser()->id // hoáº·c cÃ³ thá»ƒ sá»­ dá»¥ng 'user_id'	=> '' 
						));	
				}
				?>
			</div>
		</div>	
	</div>
	<div id="wd-content-container" class="jlbd-search-result-container">
		<div class="wd-center">
			<?php if (isset($_GET['u']) && (currentUser()->isGuest || (currentUser()->id!=IDHelper::uuidToBinary($_GET['u'])))) $this->widget('widgets.user.JLBDUserHeaderline', array('user'=>$_GET['u'])); ?>
			<?php echo $content;?>
		</div>
	</div>
	<?php $this->renderPartial('//common/footer-v1.2')?>
<div class='hidden' style='display:none'>
	<?php
		$this->widget('widgets.review.JLBDReviewForm', array(
			//'strBizID' => $biz['attrs']['uuid'],
			'isShowLink' => false,
			//'intYourRate' => $userRates[$index],
		));
		$this->widget('widgets.comment.JLBDCommentBox', array());
		$this->widget('widgets.comment.JLBDCommentItemsJS', array());
		$this->widget('widgets.compliment.JLBDComplimentBox', array());
	?>
	<?php $this->widget('widgets.business.JLBDBusinessItemViewMode'); ?>
	<?php $this->widget('widgets.review.JLBDReviewsByBusinessPrototype'); ?>
</div>

<?php $this->widget('widgets.favourite.JLBDFavouritePopup', array()); ?>
<?php //$this->widget('widgets.list.JLBDAddToListPrototype', array()); ?>
<?php $this->widget('widgets.list.JLBDAddToListPopup', array()); ?>
<?php $this->widget('widgets.claim-business.JLBDLinkClaim', array()); ?>
	<!-- Start Script -->
		<!--[if lt IE 7]>
			<script src="<?php echo Yii::app()->baseUrl;?>/justlook/js/IE7.js"></script>
		<![endif]-->
	<!-- End Script -->
	<!--[if IE]><script src="<?php echo Yii::app()->baseUrl;?>/justlook/js/excanvas.compiled.js" type="text/javascript" charset="utf-8"></script><![endif]-->

<!-- Feedback: begin -->
<?php $this->renderPartial("//common/feedback");?>
<!-- Feedback: end -->
<!--  LOGIN -->
<?php $this->renderPartial("//common/user/login");?>
<!--  END : LOGIN -->
<script language="javascript" src="<?php echo Yii::app()->params['notificationServer']?>/socket.io/socket.io.js"></script>
<?php $this->beginWidget('widgets.JLScriptPacker', array(
	'id'	=> 'dashboardLayoutScript',
	'type'	=> 'js',
	'position'	=> CClientScript::POS_READY
))?>

/* Tooltip - TipTip */
try { $('#wd-content-container .jlbd-tiptip-top').tipTip({defaultPosition:"top",fadeIn:10,fadeOut:10,delay:10}); } catch (e) {}


// loading for autocomplete
var __response = $.ui.autocomplete.prototype._response;
$.ui.autocomplete.prototype._response = function(content) {
    __response.apply(this, [content]);
    this.element.trigger("autocompletesearchcomplete", [content]);
};

// loading for autocomplete
$( ".wd-keyword,.wd-location" ).bind( "autocompletesearch", function(event, ui) {
  $(this).append('<img class="loading" src="<?php echo $this->createUrl('/justlook/img/loading_small.gif') ?>" />');
});

$( ".wd-keyword,.wd-location" ).bind( "autocompletesearchcomplete", function(event, ui) {
   $(this).find('.loading').remove();
});

// 26/06/2012
// dunghd
// detect for search action
$('#frmSearch submit').click(function(){
    
    if( $('#keyword').val() == '' && $('#keyword').attr('placeholder') == 'Business name or type' )
	{
		$('#keyword').val('');
	}
	
	if( $('#keywolocationrd').val() == '' && $('#keyword').attr('placeholder') == 'Suburb, town, postcode or region')
	{
		$('#location').val('Australia');
	}
});

$('#frmSearch').submit(function(){
	
    if( $('#keyword').val() == '' && $('#keyword').attr('placeholder') == 'Business name or type' )
	{
		$('#keyword').val('');
	}
	
	if( $('#keywolocationrd').val() == '' && $('#keyword').attr('placeholder') == 'Suburb, town, postcode or region')
	{
		$('#location').val('Australia');
	}
	
});
<?php $this->endWidget();?>
</body>
</html>
