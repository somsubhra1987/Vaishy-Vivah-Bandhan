<?php
namespace app\lib;
use Yii;
use yii\helpers\Html;

class CustomHtml extends Html
{
	public static function enumDropDownList($model, $attribute, $htmlOptions=array())
    {
      return Html::activeDropDownList( $model, $attribute, self::enumItem($model,  $attribute), $htmlOptions);
    }
 
    public static function enumItem($model,$attribute) {
	    
        $attr=$attribute;
        preg_match('/\((.*)\)/',$model->tableSchema->columns[$attr]->dbType,$matches);
        foreach(explode("','", $matches[1]) as $value) {
                $value=str_replace("'",null,$value);
                $values[$value]=Yii::t('enumItem',$value);
        }
        return $values;
    }

	public function getAddButton($btnLink=false, $btnText = 'Add New')
	{
		if(!$btnLink) $btnLink = Yii::app()->baseUrl ."/". $this->module->getName() . "/" . $this->id . "/create";
		
		return <<<EOF
<div class="button"><a href="$btnLink">$btnText</a></div>	
EOF;
	}
	
	public function getListViewTemplate($btnText = 'Add New', $btnLink=false)
	{
		if($btnText) $button = self::getAddButton($btnLink, $btnText);
		else $button;
		
		return <<<EOF
{summary}
$button
{items}
{pager}
EOF;
	}
	
	public function getDashboardItem($title, $relativeUrl, $image)
	{
		
		$imageUrl = Yii::$app->getUrlManager()->getBaseUrl() . "/themes/backend/default/images/dashboard/" . $image;
		if($relativeUrl == '#') $url = 'javascript:;';
		else $url = Yii::$app->urlManager->createUrl($relativeUrl);	
		
		return <<<EOF
<div class="col-md-3">
	<a class="thumbnail" href="$url">
		<img src="$imageUrl" alt="$title">
		<div class="caption text-center"><strong>$title</strong></div>
	</a>
</div>
EOF;
	}
	
	public function getChildListViewTemplate($btnText = 'Add New', $btnLink=false, $textSectionID)
	{
		if($btnText) $button = self::getAddButton($btnLink, $btnText);
		else $button;
		
		$msg = "";
		if(Yii::app()->user->hasFlash('child_list' . $textSectionID))
		{
			$msg = Yii::app()->user->getFlash('child_list' . $textSectionID);
			$msg =<<<EOF
<div class="flash-success" style="float:left; width: 80%;">
$msg
</div>
EOF;
		}
		
		return <<<EOF

$msg
$button
{items}
EOF;
	}
	
	public function getAddNewButton($url=false, $title=false)
	{
		if(!$title) $title = 'Add New';
		
		$btn =  Html::a('<span class="glyphicon glyphicon-plus"></span> '. $title, $url ? $url : ['create'], ['class' => 'btn btn-success']);
		
		$html = <<<EOF
		<div style="clear: both;">
        	<div class="pull-right" style="margin-bottom:10px;">$btn</div>
    	</div>
EOF;

		return $html;
	}
	
	public function getUpdateButton($id)
	{
		$btn =  Html::a('Update', ['update', 'id' => $id], ['class' => 'btn btn-primary']);
		
		$html = <<<EOF
        <div class="pull-left" style="margin-right: 10px;">$btn</div>
EOF;

		return $html;
	}
	
	public function getDeleteButton($id)
	{
		$btn =  Html::a('Delete', ['delete', 'id' => $id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
		
		$html = <<<EOF
        <div class="pull-left" style="margin-right: 10px;">$btn</div>
EOF;

		return $btn;
	}
	
	public function getEditActionIcon()
	{
		$html = ['class' => 'yii\grid\ActionColumn', 'template' => '{update}', 'contentOptions'=>['class'=>'text-center']];

		return $html;
	}
	
	public function getDeleteActionIcon($visible=true)
	{
		$html = ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}', 'contentOptions'=>['class'=>'text-center'], 'visible'=>$visible];

		return $html;
	}
	
	public function getFlash()
	{
		$msg = "";
		$type = "";
		if(Yii::$app->getSession()->hasFlash('error'))
		{
			$msg = Yii::$app->getSession()->getFlash('error');
			$type = "warning";
		}
		elseif(Yii::$app->getSession()->hasFlash('success'))
		{
			$msg = Yii::$app->getSession()->getFlash('success');
			$type = "success";
		}
		
		if(strlen($msg))
		{
			$msg =<<<EOF
<div class="flash-msg">
	<div class="alert alert-$type">$msg</div>
</div>
EOF;
		}
		
		return $msg;
	}
	
	public function getFlashMsg()
	{
		$msg = "";
		$type = "";
		if(Yii::$app->getSession()->hasFlash('error'))
		{
			$msg = Yii::$app->getSession()->getFlash('error');
			$type = "text-red";
		}
		elseif(Yii::$app->getSession()->hasFlash('success'))
		{
			$msg = Yii::$app->getSession()->getFlash('success');
			$type = "text-green";
		}
		
		if(strlen($msg))
		{
			$msg =<<<EOF
	<span class="contact-msg $type">$msg</div>
EOF;
		}
		
		return $msg;
	}
	
	public function getViewLinkCol($attr)
	{
		global $viewLinkColAttr;
		
		$viewLinkColAttr = $attr;	
			
		$col = ['attribute'=>$attr,
            'format' => 'raw',
       		'value'=>function ($data, $id) {
	       		global $viewLinkColAttr;

            		return Html::a($data[$viewLinkColAttr], ['view', 'id'=>$id]);
        		},
        	];
        	
        return $col;
	}
	
	public function getNameCol()
	{
		$col = ['attribute'=>$attr,
       		'value'=>function ($model, $key) {
	       			global $activeColAttr;
	       		
	                return $model->$activeColAttr == '1' ? 'Yes' : 'No';
	          	},
	         'filter'=>[1 => 'Yes', 0 => 'No'],
        	];
        	
        return $col;
	}
	
	public function getStatusCol($attr='status', $visible=1)
	{
		global $activeColAttr;
		
		$activeColAttr = $attr;	
			
		$col = ['attribute'=>$attr,
       		'value'=>function ($model, $key) {
	       			global $activeColAttr;
	       		
	                return $model->$activeColAttr == '1' ? 'Yes' : 'No';
	          	},
	         'filter'=>[1 => 'Yes', 0 => 'No'],
	         'visible'=>$visible,
        	];
        	
        return $col;
	}
	
}
