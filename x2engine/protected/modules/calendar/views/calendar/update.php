<?php
/***********************************************************************************
 * X2CRM is a customer relationship management program developed by
 * X2Engine, Inc. Copyright (C) 2011-2016 X2Engine Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY X2ENGINE, X2ENGINE DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact X2Engine, Inc. P.O. Box 66752, Scotts Valley,
 * California 95067, USA. on our website at www.x2crm.com, or at our
 * email address: contact@x2engine.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * X2Engine" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by X2Engine".
 **********************************************************************************/
?>

<?php

$modTitle = Modules::displayName();
$menuItems = array(
    array('label'=>Yii::t('calendar','{module}', array('{module}'=>$modTitle)), 'url'=>array('index')),
    array(
        'label'=>Yii::t('calendar', 'My {module} Permissions', array(
            '{module}' => $modTitle,
        )),
        'url'=>array('myCalendarPermissions')
    ),
    array('label'=>Yii::t('calendar', 'List'),'url'=>array('list')),
    array('label'=>Yii::t('calendar','Create'), 'url'=>array('create')),
    array('label'=>Yii::t('calendar','View'), 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>Yii::t('calendar','Update')),
    array(
        'label'=>Yii::t('calendar','Delete'),
        'url'=>'#',
        'linkOptions'=>array(
            'submit'=>array('delete','id'=>$model->id),
            'confirm'=>'Are you sure you want to delete this item?'
        ),
    ),
);
if (Yii::app()->settings->googleIntegration) {
    $menuItems[] = array(
        'label'=>Yii::t('calendar','Sync My {actions} To Google Calendar', array(
            '{actions}' => Modules::displayName(true, "Actions"),
        )),
        'url'=>array('syncActionsToGoogleCalendar')
    );
}

$this->actionMenu=$this->formatMenu($menuItems);
?>
<div class="calendar page-title">
<h2>
    <?php echo Yii::t('calendar','Create {module}', array(
        '{module}' => $modTitle,
    )); ?>
</h2>
</div>
<?php

$users = User::getUserIds();
unset($users['']);
unset($users[Yii::app()->user->id]);
	
echo $this->renderPartial('_form', 
	 array(
		'model'=>$model,
                 'googleIntegration'=>$googleIntegration,
                 'client' => $client,
                 'googleCalendarList' => $googleCalendarList,
		 'users'=>$users,
		 'modelName'=>'calendar',
		 'isQuickCreate'=>true, // let us create the CActiveForm in this file
	)
);
?>
