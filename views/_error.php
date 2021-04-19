<?php
/**
 * This View is rendered when something goes wrong inside application. Different errors will show you what is wrong;
 *
 * @var $exception \Exception
 */
?>
<h3><?php echo $exception->getCode() ?> - <?php echo $exception->getMessage() ?></h3>