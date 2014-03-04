<?php
/**
	Nguoi viet : thinhpq
	viet ngay : 31/3/2012
	* Phan trang bang` ajax
	* Co' the load cac trang truoc do va luu vao JSON
	* Neu user click vao` cac trang thi se dc luu lai toan bo du lieu tai JSON nay
**/
class ShowPage extends CLinkPager{
	public $updateHtml = array();
	public $type = "";
	public $json = "";
	public $url = "";
	public $itemTotal = 5;
	public $total;
	public $onSend = "";
	public $onSuccess = "";	
	public function init() {
		parent::init();
		$headScript	=	"";
		if($this->type=="json"){
			$headScript = 'var '.$this->json.' = {};';
			Yii::app()->getClientScript()->registerScript('registerGlobalVariables', $headScript, CClientScript::POS_END);
		}

		
		$cs=Yii::app()->getClientScript();
		$assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . '/assets', false, -1, true);
		$cs->registerScriptFile($assets . '/showpage.js');
		
	}
	protected function createPageButton($label,$page,$class,$hidden,$selected){
		if($hidden || $selected){
			$class.=' '.($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
		}

		if($this->updateHtml!=""){
			return '<li class="'.$class.'">'
				.CHtml::ajaxLink(
					$label,
					$this->url.'&page='.($page+1),
					array(
						"beforeSend"=>'js:function(data){'
							.$this->onSend
							.'if('.$this->json.'['.($page+1).']!=null){'
								.'$("#'.$this->updateHtml['data'].'").assignHtml({'
										.'page : "'.($page+1).'", '
										.'data : '.$this->json.','
										.'status : 1,'
								.'});'							
								.'return false;'
							.'}'
						.'}',
						"success"=>'js:function(html){'
							.'var data = $.parseJSON(html);'
							.$this->json. '['.($page+1).'] = data;'
							.'$("#'.$this->updateHtml['data'].'").assignHtml({'
									.'page : "'.($page+1).'", '
									.'data : '.$this->json.','
									.'status : 0,'
							.'});'
							.'$("#'.$this->updateHtml['pager'].'").showpage({'
									.'page : "'.($page+1).'", '
									.'itemTotal : "'.($this->itemTotal).'", '
									.'total : "'.($this->total).'", '
									.'data : '.$this->json.','
									.'id : "'.$this->updateHtml['data'].'",'
									.'url : "'.$this->url.'"'
							.'});'
							.$this->onSuccess
						."}"
					)
				)
			.'</li>';
		}else{
			return '<li class="'.$class.'">'.CHtml::ajaxLink($label,$this->createPageUrl($page)).'</li>';	
		}
		
	}
}
