<?php require_once('../../../private/initialize.php');  ?>


    <?php $id = isset($_GET['id']) ? $_GET['id'] : '1'; //ternary < php 7.0
    //$id = $_GET['id'] ?? '1'; //ternary > php 7.0  ?>
    
    <a href="<?php echo url_for('/staff/subjects/index.php') ?>">&laquo; Back to List</a>
    <br>
    <?php echo "Subject ID:" . h($id);?>


<br>
<a href="show.php?name=<?php echo u('John Doe'); ?>">Link</a><br />
<a href="show.php?company=<?php echo u('Widgets&More'); ?>">Link</a><br />
<a href="show.php?query=<?php echo u('!#*?'); ?>">Link</a><br />