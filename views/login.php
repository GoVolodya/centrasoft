<?php
/**
 * This is login form view. If you already registered user you can log in here;
 *
 * @var $form \app\core\form\Form
 * @var $model User
 * @var $this \app\core\View
 */
$this->title = 'Login';

use app\core\form\Form;
use app\models\User;

?>
<h1>This is Login page =)</h1>

<?php $form = Form::begin('',"post") ?>
<?php echo $form->field($model, 'email')->emailField() ?>
<?php echo $form->field($model, 'password')->passwordField() ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end() ?>