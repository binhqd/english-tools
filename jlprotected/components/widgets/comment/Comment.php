<?php 

class Comment extends CWidget
{
    /**
     * @var array breadcrum
     */
	public $objectId = null;
	public $model = "ZoneComment";
	public $startList = 0;
	public $limit = 3;
	public $viewMore = false;
	public $loadJsTimeAgo = true;
	public $strToken = true;
	
	public $viewItemPath = "widgets.comment.views.comment";
	public $viewFormPath = "widgets.comment.views.form";
	public $currentUser = null;
	public $listComment = null;
	public $countComment = null;
	public $totalPage = null;
	
	public $onPopup = false;
	public $alwayShow = false;
	public function init()
	{
		GNAssetHelper::init(array(
			'image'		=> 'img',
			'css'		=> 'css',
			'script'	=> 'js',
		));
		
		$baseScriptUrl = GNAssetHelper::setBase('widgets.comment.assets');
		GNAssetHelper::cssFile('pagelet-stream');
		GNAssetHelper::cssFile('pagelet-stream-comment-box');
		GNAssetHelper::scriptFile('add.comment', CClientScript::POS_END);
		GNAssetHelper::scriptFile('jquery.autosize-min', CClientScript::POS_END);
		
		
		parent::init();
	}
	
	public function run() {
		$this->currentUser = currentUser();
		
		$this->countComment = 0;
		
		if($this->viewMore){
			if($this->countComment == 0 ) $this->countComment = ZoneComment::model()->countComments($this->objectId);
			
		}
		// Get list comments
		$comments = ZoneComment::model()->getComments($this->objectId,$this->startList,$this->limit);
		
		$show		= count($comments);
		$this->listComment = array();
		if (!empty($comments)) {
			$out = array();		
			foreach ($comments as $comment) {
				$user = $comment->user;				
				if(!empty($user)){
					$this->listComment[] = array(
						'currentUser'		=> currentUser()->id==-1?false:true,
						'commentId'		=> IDHelper::uuidFromBinary($comment->id, true),
						'commentContent'	=> $comment->content,
						'user_id'			=> IDHelper::uuidFromBinary($user->id, true),
						'avatarUrl'		=> GNRouter::createUrl("/upload/user-photos/".IDHelper::uuidFromBinary($comment->user_id, true)."/fill/40-40/" . $user->profile->image),
						'profileUrl'		=> GNRouter::createUrl("/profile/{$user->username}"),
						'username'			=> $user->username,
						'displayname'			=> $user->displayname,
						'commentDate'		=> date("Y-m-d H:i:s", strtotime($comment->date)),
						'isOwner'			=> currentUser()->id == $comment->user_id,
					);
				}
			}
		}
		$this->totalPage = ceil($this->countComment/$this->limit);
		// Init form add comment.
		$this->strToken = md5(uniqid(32));
		
		$this->render('comment',array(
			
			'showComment'=>$show,
			'limit'=>$this->limit,
			'viewMore'=>$this->viewMore,
			
			'loadJsTimeAgo'=> $this->loadJsTimeAgo,
			
		));
		
    }
}
?>
