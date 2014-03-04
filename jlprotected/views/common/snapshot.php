<?php 
GNAssetHelper::init(array(
	'image'		=> 'img',
	'css'		=> 'css',
	'script'	=> 'js',
));
GNAssetHelper::setBase('justlook');
GNAssetHelper::cssFile('list-thumbnail');

GNAssetHelper::scriptFile('jlbd.snapshot');
?>
<script id="template-snapshot-user" type="text/x-jquery-tmpl">
	<div class="jlbd-pi-content">
		<a href="${homeURL}/profile/?u=${user_id}" class="jl-thumb">
			<img alt="Thumbnail" src="${homeURL}/upload/user-photos/${user_id}/fill/85-85/{{if (avatar.primary != null)}}${avatar.primary.filename}{{/if}}" />
			{{if (isFriend == false && 1 == 2)}}
			<span class="jl-ico-add-fr" title="add friend">add-fr</span>
			{{/if}}
		</a>
		<h4 class="wd-title"><a href="${homeURL}/profile/?u=${user_id}">${username}</a></h4>
		<p class="jlbd-location">${location}</p>
		{{if user.isCurrent}}
		<div class='wd-list-thumb'>
			<div class="mutual-fr">
				<h4 class="sub-title"><a href="#">${mutuals} Mutual {{if mutuals != 1}}friends{{else}}friend{{/if}}</a></h4>
				<ul class="mutual-frl">
					{{each(i, item) friends}}
					<li><a href="${homeURL}/profile/?u=${item.user_id}" title="${item.username}" class="mini-thumb"><img alt="Thumbnail" src="${homeURL}/upload/user-photos/${user_id}/fill/35-35/{{if (item.avatar.primary != null)}}${item.avatar.primary.filename}{{/if}}" /></a></li>
					{{/each}}
				</ul>
			</div>
		</div>
		{{else}}
		<div class='wd-list-thumb'>
			<div class="mutual-fr">
				<h4 class="sub-title"><a href="#">${cntFriends} {{if cntFriends != 1}}friends{{else}}friend{{/if}}</a></h4>
				<ul class="mutual-frl">
					{{each(i, item) friends}}
					<li><a href="${homeURL}/profile/?u=${item.user_id}" title="${item.username}" class="mini-thumb"><img alt="Thumbnail" src="${homeURL}/upload/user-photos/${user_id}/fill/35-35/{{if (item.avatar.primary != null)}}${item.avatar.primary.filename}{{/if}}" /></a></li>
					{{/each}}
				</ul>
			</div>
		</div>
		{{/if}}
	</div>
	<div class="jlbd-pi-action">
		<p class="wd-link-action">
			<a class="wd-send-mail wd-hover-tooltip" href="${homeURL}/messages?prt=node#w/0/0/${user_id}" title="Send mail">Send message</a>
			<a class="wd-make-recommendation wd-hover-tooltip" href="#" title="Make a recommendation" user_id="${user_id}" username="${username}">Make a recommendation</a>
		</p>
	</div>
</script>

<script id="template-snapshot-biz" type="text/x-jquery-tmpl">
	<div class="jlbd-pi-content">
		<a href="${homeURL}/business/${alias}" class="jl-thumb">
			<img alt="Thumbnail" src="${homeURL}/upload/business/${biz_id}/fill/85-85/{{if (avatar != null)}}${avatar}{{/if}}" />
		</a>
		<h4 class="wd-title"><a href="${homeURL}/business/${alias}">${name}</a></h4>
		<div class="wd-rating wd-rating-yellow">
			<div class="wd-rating-static">
				<p class="star-lv-${avg_ratings * 2}"></p>
			</div>
		</div>
		<p class="jlbd-location">${address}<br/>${location}</p>
		<p class="jlbd-location">Landline: ${landline}</p>
	</div>

	<div class="jlbd-pi-action">
		<p class="wd-link-action">
			<a href="${homeURL}/dashboard/favourites/remove/business_id/${uuid}" ref="${uuid}" class="wd-favourite wd-hover-tooltip{{if addedFavourite}} wd-favourite-remove{{else}} wd-favourite-add{{/if}}" bt-xtitle="Add to Favourite" onclick="return false;">Favourite</a>
			<a href="#" ref="${uuid}" class="wd-add-list jl_add_to_list wd-hover-tooltip">Add to List</a>
			<a href="${homeURL}/messages?prt=node#w/0/0/${uuid}/B" class="wd-send-mail wd-hover-tooltip">Send message</a>
			<a href="${homeURL}/share/business?uid=${uuid}" class="wd-share-friend wd-hover-tooltip">Share friend</a>
		</p>
	</div>
</script>