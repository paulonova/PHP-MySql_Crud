<?php   
require_once('../../../private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
  }

  $id = $_GET['id'];
  $page = find_page_by_id($id);

  if(is_post_request()){
      delete_page($id);
      $_SESSION['message'] = 'The page was deleted successfully.';
      redirect_to(url_for('/staff/subjects/show.php?id=' . h(u($page['subject_id']))));

  }

?>

<?php $page_title = 'Delete Pagee'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id=' 
                                    . h(u($page['subject_id']))); ?>">&laquo; Back to Subject Page</a>

  <div class="subject delete">
    <h1>Delete Page</h1>
    <p class = "alert">&#9760; You realy want to delete this page?</p>
    <p class="item"><?php echo h($page['menu_name']); ?></p>

    <form action="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($page['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Page" />
      </div>
    </form>
  </div>

</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>