<?php if (count($reviewDrafts)) : ?>
<script id="reviewdraftTemplate" type="text/x-jquery-tmpl">
	<div class="jlbd-review-draft-${draft.id}">
		<div class="wd-obj-review">
			<a href="<?php echo JLRouter::createUrl('/business'); ?>/${business.attrs.alias}" class="wd-thumb-unfinished-reviews"><img alt="Thumbnail" src="${business.avatar}"></a>
			<div class="jlbd-right-content">
				<h4 class="wd-title"><a href="<?php echo JLRouter::createUrl('/business'); ?>/${business.attrs.alias}" class="jl-biz-name">${business.attrs.name}</a></h4>
				<p>${business.attrs.address}, ${business.attrs.location}</p>
				{{if business.attrs.landline}}<p>Phone: ${business.attrs.landline} </p>{{/if}}
			</div>
		</div>
		<div class="wd-form-review">
		<form class="wd-review-form" method="POST" ref="${draft.id}" action="<?php echo Yii::app()->createUrl('/review/write'); ?>" actionSave="<?php echo Yii::app()->createUrl('/review/saveDraft'); ?>">
			<input type="hidden" class='input-biz-id' name="JLReview[business_id]" value="${business.attrs.uuid}" />
			<input type="hidden" class='input-draft-id' name="JLReview[draft_id]" value="${draft.id}" />
			<div class="wd-rating wd-rating-blue">
				<p class="wd-give-your-rate">Give your rate</p>
				<div class="review-form-rating-placeholder" ref="${draft.id}" rel="${draft.rate}"></div>
			</div>
			<?php $avatar = $currentUser->avatar; ?>
			<a href="<?php echo JLRouter::createUrl('/dashboard'); ?>" class="wd-thumb-unfinished-reviews"><img alt="Thumbnail" src="<?php echo $avatar['isExist'] ? JLRouter::createUrl("/upload/user-photos/".$currentUser->hexID."/fill/40-40/{$avatar['filename']}") : JLRouter::createUrl("/justlook/img/front/img-no-avatar.png");?>"></a>
			<textarea name="JLReview[content]" class="wd-text-review-unfinished" style="display: block; resize: none; overflow-y: hidden; ">${draft.content}</textarea>
			<div class="wd-error"></div>
			<div class="wd-bt-review-unfinished">
				<div class="wd-bt-big-2 wd-bt-big-discard">
					<input type="button" ref="${draft.id}" value="Discard">
				</div>
				<div class="wd-bt-big-2">
					<input type="submit" value="Complete">
				</div>
			</div>
		</form>
		</div>
	</div>
</script>
<div class="wd-section-landing-page wd-list-news wd-friends-activities" id="review-drafts-block">
	<h2 class="wd-title-landing-page">
		Unfinished reviews
	</h2>
	<div class="wd-unfinished-reviews">
		<div id="review-drafts-container"></div>
		<?php if (count($reviewDrafts) > 1) : ?>
		<p class="wd-link-view-all jlbd-see-more-draft"><a href="#">See more</a></p>
		<?php endif; ?>
	</div>
</div>
<script type="text/javascript">
	var review_drafts = <?php echo @CJSON::encode($reviewDrafts)?>;
	$( "#reviewdraftTemplate" ).tmpl( review_drafts[0] ).appendTo( "#review-drafts-container" );
	
	function checkDraft() {
		if ($('#review-drafts-container').children(':visible').length == 0)
			$('#review-drafts-block').hide();
	}
	
	function initRatingFormDraft() {
		$('#review-drafts-container .review-form-rating-placeholder').each(function(index, element){
			if ($(this).attr('initialized') == 'true') return; $(this).attr('initialized', 'true'); // set status is initialized
			var draft_id = $(element).attr('ref');
			var rate = $(element).attr('rel');
			var rating = new jlbd.rating.Libs.JLRating(draft_id, {
				maxRating : 5,
				starCount : 5,
				name : 'JLReview[rate]'
			});
			rating.setValue(rate+'');
			$(element).append(rating.container);
		});
	}
	initRatingFormDraft();
	
	$('.jlbd-see-more-draft').click(function(){
		var _this = this;
		$( "#reviewdraftTemplate" )
			.tmpl( review_drafts[review_drafts.length - 1] )
			.appendTo( "#review-drafts-container" )
			.hide()
			.fadeIn();
		initRatingFormDraft();
		$.ajax({
			dataType: 'JSON',
			type: 'GET',
			url: '<?php echo JLRouter::createUrl('/review/loadRecentDraft'); ?>/limit/1/offset/' + review_drafts.length,
			beforeSend: function() {
				$(_this).fadeOut();
			},
			success: function(response){
				if (!response.error && response.drafts.length) {
					review_drafts[review_drafts.length] = response.drafts;
					$(_this).fadeIn();
				}
			}
		});
		return false;
	});
	
	// Discard draft
	$('#review-drafts-container .wd-bt-big-discard input').on('click', function(){
		var draftID = $(this).attr('ref');
		jlbd.dialog.confirm('Discard draft', 'Are you sure discard this draft?', function(answer){
			if (answer == true) {
				$.ajax({
					dataType: 'JSON',
					type: 'GET',
					url: jlbd.discardDraftReviewURL + '/strDraftID/' + draftID,
					beforeSend: function() {
						// controller.form.find('img.wd-img-loading').css('display', 'inline');
					},
					complete: function() {
						// controller.form.find('img.wd-img-loading').css('display', 'none');
					},
					error: function(jqXHR, textStatus, errorThrown) {
						jlbd.dialog.notify({
							message : 'Sorry, An error occurred.<br/>Justlook will check for this error, or you can try again.',
							autoHide : true,
							timeOut : 7,
							type: 'error'
						});
					},
					success: function(response) {
						if (response.error) {
						} else {
							jlbd.dialog.notify({
								message : response.msg,
								autoHide : true,
								timeOut : 5,
								type: 'success'
							});
							if ($('.jlbd-see-more-draft').css('display') != 'none') $('.jlbd-see-more-draft').trigger('click');
							$('#review-drafts-container .jlbd-review-draft-'+draftID).fadeOut(function(){checkDraft();});
						}
					}
				});
			}
		});
		return false;
	});
	
	// Submit draft
	$('#review-drafts-container form').on('submit', function(){
		var form = $(this);
		// Validate client
		form.find('.wd-error').html('');
		form.find('.wd-error').fadeOut();
		var htmlError = '';
		if ($.trim(form.find('textarea').val()).length == 0)
			htmlError += '<div class="wd-db-note wd-db-your-note">Content cannot be blank.</div>';
		else if ($.trim(form.find('textarea').val()).length < 10)
			htmlError += '<div class="wd-db-note wd-db-your-note">Content is too short (minimum is 10 characters).</div>';
		if (form.find('.review-form-rating-placeholder input:checked').length == 0)
			htmlError += '<div class="wd-db-note wd-db-your-note">Member needs to rate for this business before writing a review</div>';
		if (htmlError != '') {
			form.find('.wd-error').html(htmlError);
			form.find('.wd-error').fadeIn();
			return false;
		}
		
		var btnSend = form.find('input:submit');
		var intRate = form.find('input[name=JLReview[rate]]:checked').val();
		$(btnSend).attr('disabled', 'disabled');
		$.ajax({
			dataType: 'JSON',
			type: form.attr('method'),
			data: form.serialize(),
			url: form.attr('action'),
			beforeSend: function() {
				// form.find('img.wd-img-loading').css('display', 'inline');
			},
			complete: function() {
				// form.find('img.wd-img-loading').css('display', 'none');
				$(btnSend).removeAttr('disabled');
			},
			error: function(jqXHR, textStatus, errorThrown) {
				jlbd.dialog.notify({
					message : 'Sorry, An error occurred.<br/>Justlook will check for this error, or you can try again.',
					autoHide : true,
					timeOut : 7,
					type: 'error'
				});
			},
			success: function(response){
				if (response.error==1) {
					var arrErrors = response.msg.split(' | ');
					var htmlError = '';
					$.each(arrErrors, function(indexInArray, valueOfElement) {
						htmlError += '<div class="wd-db-note wd-db-your-note">' + valueOfElement + '</div>';
					});
					form.find('.wd-error').html(htmlError);
					form.find('.wd-error').fadeIn();
				} else {
					jlbd.dialog.notify({
						message : response.msg,
						autoHide : true,
						timeOut : 5,
						type: 'success'
					});
					var ref = form.attr('ref');
					if ($('.jlbd-see-more-draft').css('display') != 'none') $('.jlbd-see-more-draft').trigger('click');
					$('#review-drafts-container .jlbd-review-draft-'+ref).fadeOut(function(){checkDraft();});
				}
			}
		});
		
		return false;
	});
</script>
<?php endif; ?>