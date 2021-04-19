<?php
/**
 * This view is main page. You can see there a list of all students if they are exists;
 *
 * @var $this \app\core\View
 * @var $params \app\controllers\SiteController
 */
$this->title = 'University';
?>
<h1>Welcome to our university =)</h1>
<?php if(!empty($params)): ?>
<h3>List of our students:</h3>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Age</th>
        <th scope="col">Gender</th>
        <th scope="col">Class</th>
        <th scope="col">Faculty</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($params as $param){
       echo "
       <tr>
            <th>$param[id]</th>
            <td>$param[firstname]</td>
            <td>$param[lastname]</td>
            <td>$param[age]</td>
            <td>$param[gender]</td>
            <td>$param[class]</td>
            <td>$param[faculty]</td>
        </tr>";
    } ?>
    </tbody>
</table>
<?php endif; ?>
