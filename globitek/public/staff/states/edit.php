<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$states_result = find_state_by_id($_GET['id']);
// No loop, only one result
$state = db_fetch_assoc($states_result);

?>
<?php $page_title = 'Staff: Edit State ' . $state['name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="#add_a_url">Back to States List</a><br />

  <h1>Edit State: <?php echo $state['name']; ?></h1>

  <!-- TODO add form -->

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
