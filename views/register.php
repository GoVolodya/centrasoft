<?php
/**
 * This is view for register page. You can register new user here;
 *
 * @var $form \app\core\form\Form
 * @var $this \app\core\View
 * @var $model User
 */

use app\core\form\Form;
use app\models\User;

$this->title = 'Register';
?>
<h1>This is Registration page =)</h1>

<?php $form = Form::begin('',"post") ?>
<div class="row">
    <div class="col">
        <?php echo $form->field($model, 'firstname') ?>
    </div>
    <div class="col">
        <?php echo $form->field($model, 'lastname') ?>
    </div>
</div>
<?php echo $form->field($model, 'email')->emailField() ?>
<?php echo $form->field($model, 'password')->passwordField() ?>
<?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end() ?>