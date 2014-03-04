<div id="wd-header">
	<div class="wd-top-header">
		<div class="wd-center">
			<h1 class="wd-header-logo">
				<a class="wd-logo-4" href="<?php echo GNRouter::createUrl('/landingpage');?>"><img src="<?php echo baseUrl();?>/img/front/youlook-logo.png" alt="YouLook" /></a>
			</h1>
			<?php if(!currentUser()->isGuest){?>
			<div class="wd-setting-header">
				<a href="javascript:void(0)" class="wd-settingicon-top wd_toggle_bt">Setting</a>
				
				<div class="wd-setting-content wd_toggle">
					<ul class="bbor-solid-1">
						<li><a href="#" class=""><span
								class="wd-icon-16 wd-icon-create-toppic"></span><span
								class="wd-label">Create topic</span> </a>
						</li>
						<li><a href="#" class=""><span
								class="wd-icon-16 wd-icon-addphotovideo"></span><span
								class="wd-label">Add photos/videos</span> </a>
						</li>
						<li><a href="#" class=""><span
								class="wd-icon-16 wd-icon-manage-resources"></span><span
								class="wd-label">Manage resources</span> </a>
						</li>
					</ul>
					<ul class="bbor-solid-1">
						<li><a href="<?php echo ZoneRouter::createUrl('/profile/edit')?>" class=""><span
								class="wd-icon-16 wd-icon-account-setting"></span><span
								class="wd-label">Account settings</span> </a>
						</li>
						<li><a href="#" class=""><span
								class="wd-icon-16 wd-icon-privacy-setting"></span><span
								class="wd-label">Privacy settings</span> </a>
						</li>
						<li><a href="#" class=""><span class="wd-icon-16 wd-icon-help"></span><span
								class="wd-label">Help</span> </a>
						</li>
					</ul>
					<ul>
						<li>
							<a href="<?php echo ZoneRouter::createUrl('/users/changePassword');?>" ><span
								class="wd-icon-16 wd-icon-change-pass"></span><span
								class="wd-label">Change password</span> </a>
						</li>
						<li>
							<a href="<?php echo ZoneRouter::createUrl('/logout')?>" class=""><span
								class="wd-icon-16 wd-icon-logout"></span><span
								class="wd-label">Logout</span> </a>
						</li>
					</ul>
				</div>
				
			</div>
			
			<a class="wd-username-cont" href="<?php echo ZoneRouter::createUrl('/profile')?>">
				<span class="wd-username ume"><?php echo currentUser()->displayname?></span>
				<img  size="26-26" src='<?php echo (!currentUser()->isGuest) ? ZoneRouter::CDNUrl("/upload/user-photos/".currentUser()->hexID."/fill/26-26/" . currentUser()->profile->image ) : GNRouter::createUrl('/site/placehold',array('t'=>'26x26-282828-969696')) ;?>' class="wd-userimage me" alt="<?php echo currentUser()->displayname?>" width="26px" height="26px"/>
			</a>
			<div class="wd-jewelcontainer">
				<?php $this->widget('widgets.notification.ZoneTopNotification');?>
			</div>
			<?php
			}else{
			?>
			<div class="wd-setting-header wd-setting-header-act-bt">
				<a href="#wd-signup-popup" class="wd-join-yltn-bt wd-open-popup">Join YouLook</a>
				<a href="#wd-signin-popup" class="wd-login-yltn-bt wd-open-popup">Sign In</a>
			</div>
			<?php
			}
			?>
			<fieldset id="wd-header-search">
				<div class="wd-input">
					<form name="searchNode" method="GET" action="<?php echo GNRouter::createUrl("/search");?>">
					<input type="text" placeholder="Search..." class="wd-text-search" name="keyword" id="input-header-search"/>
					<?php
					Yii::import('ext.jqautocomplete.jqAutocomplete');
						
					$json_options = array(
						'script'=> GNRouter::createUrl('/zone/pages/search?'),
						'varName'=>'term',
						'showMoreResults'=>true,
						'valueSep' => null,
						'maxresults'=>16,
						'callback' =>'js:function(obj){ 
							window.location.href = "'.GNRouter::createUrl("/zone/pages/detail/?id=").'"+obj.id ;
						}'
					);

					jqAutocomplete::addAutocomplete('#input-header-search',$json_options);
					?>
					<input type="submit" value="" class="wd-search-bt" />
					</form>
				</div>
			</fieldset>
			<div class="clear"></div>
		</div>
		
	</div>
	
	<div class="wd-md-header">
		<div class="wd-center menu-category">
			<?php $this->widget('widgets.common.MenuCategory');?>
			
		</div>
	</div>
</div>
