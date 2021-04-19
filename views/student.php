<?php
/**
 * This is view for adding new student. Also this view is render when editing students;
 *
 * @var $form \app\core\form\Form
 * @var $this \app\core\View
 * @var $model Student
 */

use app\models\Student;
use app\core\form\Form;

?>
<?php if(empty($model->errors) and empty($model->age)): ?>
<?php $this->title = 'Become a student'; ?>
<h1>This is New student page =)</h1>
<p>Please fill in the form to become a student</p>
<?php else: ?>
    <?php $this->title = 'Edit a student'; ?>
    <h1>This is New student editing page =)</h1>
    <p>Please edit the form for this student</p>
<?php endif; ?>
<?php $form = Form::begin('', 'post') ?>
<?php echo $form->field($model, 'firstname') ?>
<?php echo $form->field($model, 'lastname') ?>
<?php echo $form->field($model, 'age') ?>
<?php echo $form->field($model, 'gender') ?>
<?php echo $form->field($model, 'class') ?>
<?php echo $form->field($model, 'faculty') ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>