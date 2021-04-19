<?php
/**
 * This is profile page view. You can enter this page after you login. You can manage students from here;
 *
 * @var $this \app\core\View
 * @var $params \app\controllers\AuthController
 */
$this->title = 'Profile';
?>
<h1>This is Profile (admin) page =)</h1>
<?php if(!empty($params)): ?>
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
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
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
            <td><a href='edit?id=$param[id]' class='btn btn-warning'>Edit</a></td>
            <td><a href='delete?id=$param[id]' class='btn btn-danger'>Delete</a></td>
        </tr>";
    } ?>
    </tbody>
</table>
<?php endif; ?>