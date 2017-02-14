<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$territories_result = find_territory_by_id($_GET['id']);
// No loop, only one result
$territory = db_fetch_assoc($territories_result);

?>
<?php $page_title = 'Staff: Edit Territory ' . $territory['name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="#add_a_url">Back to State Details</a><br />

  <h1>Edit Territory: <?php echo $territory['name']; ?></h1>

  <!-- TODO add form -->

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
