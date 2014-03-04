<?php
	class Like extends GNWidget {
		public	$assetPath		= 'widgets.like.assets';
		public	$assetUrl;
		public	$objectId		= null;
		public	$ratingTemplate	= 'greennet.modules.ratings.views.rating-template';
		public	$type			= 'like';
		public	$text			= true;
		
		public	$classLike		= null;
		public	$classUnlike	= null;
		
		public	$actionLike		= null;
		public	$actionUnlike	= null;

		
		private	$_modelObject	= null;
		private	$_modelStatistic= null;
		
		public	$nodeId = 0;
		
		public	$self = false;
		/**
		 *
		 * method set and get modelStatistic
		 */
		
		public function setModelStatistic ($modelStatistic) {
			$this->model			= $modelStatistic;
			$this->_modelStatistic	= $this->model;
		}
		public function getModelStatistic () {
			return $this->_modelStatistic;
		}
		
		/**
		 *
		 * method set and get modelObject
		 */
		
		public function setModelObject ($modelObject) {
			$this->model		= $modelObject;
			$this->_modelObject	= $this->model;
		}
		public function getModelObject () {
			return $this->_modelObject;
		}
		
		public function init() {
			GNAssetHelper::init(array(
				'image'		=> 'img',
				'css'		=> 'css',
				'script'	=> 'js',
			));
			$this->assetUrl = GNAssetHelper::setBase($this->assetPath);
			
			GNAssetHelper::scriptFile('jquery.tmpl.min', CClientScript::POS_END);
			GNAssetHelper::scriptFile('like', CClientScript::POS_END);
		}
		
		public function run() {
			
			$modelObject	= $this->modelObject;
			$modelStatistic	= $this->modelStatistic;
			$arr			= array(
				'object_id'		=> $this->objectId,
				'type'			=> $this->type,
			);
			$statistic = $modelStatistic::model()->getLikeStatistic(IDHelper::uuidToBinary($this->objectId));
			// dump($statistic);
			if(!empty($statistic)){
				$this->self = $modelObject::model()->selfInLike($statistic->id);
				$peopleLiked	= ZoneLike::model()->peopleLiked($statistic->id);
				
				if ($this->self) {
					$result			= array(
						'classRating'	=> '',
						'action'		=> $this->actionUnlike,
						'value'			=> $modelObject::VALUE_RATING_UNLIKE,
						'peopleLiked'=>$peopleLiked,
						'count'		=> $statistic->count,
					);
				} else {
					$result			= array(
						'classRating'	=> '',
						'action'		=> $this->actionLike,
						'value'			=> $modelObject::VALUE_RATING_LIKE,
						'peopleLiked'=>$peopleLiked,
						'count'		=> $statistic->count,
					);
				}
			}else{
				$result			= array(
					'classRating'	=> '',
					'action'		=> $this->actionLike,
					'value'			=> $modelObject::VALUE_RATING_LIKE,
					'peopleLiked'=>array(),
					'count'		=> 0,
				);
			}
			
			
			$result	= array_merge($arr, $result);
			$strToken = md5(uniqid(32));
			
			$this->render('like', compact('result','strToken'));
		}
		
		public function outString($countLike=null,$peopleLiked = null)
		{
			$strHtml = "";
			if(!empty($peopleLiked)){
				foreach($peopleLiked as $key=>$value){
					$strHtml .= "<span class='wd-tooltip-html'>".$value->user->displayname."</span>";
				}
			}
			
			if ($countLike != 0) {
				if (!$this->self) {
					return ' <a href="javascript:void(0)" title="'.$strHtml.'" class="wd-tooltip-hover-html"> '.$countLike.' '.Yii::t('Like', 'person|people', ($countLike)).' </a> like this.';
				} else {
					$countLike	-= 1;
					if ($countLike>0) {
						return ' You and <a href="javascript:void(0)" title="'.$strHtml.'" class="wd-tooltip-hover-html">'.$countLike.' '.Yii::t('Like', 'person|people', ($countLike)).' </a> like this.';					
					} else {
						return ' You like this';
					}
				}
			} else {
				return 'Like';
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	