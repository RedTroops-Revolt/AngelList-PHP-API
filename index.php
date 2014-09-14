<?php
require('angelList/Startup.php');
require('angelList/User.php');

$Startup = new Startup();
$User = new User();

//$startups = $Startup->batch(array(
//    19178, // Friendorse
//    29937, // Wooboard
//    67577  // Coachy
//	));
$startups = $Startup->startups('red', '5');

if (isset($_GET['vd'])) {
 vd($startups);
}
?>
<?php include('header.php'); ?>

<div class="container">
 <div class="row">

  <?php foreach ($startups as $startup) { ?>
   <div class="col-lg-4">
    <div class="panel panel-default">
     <div class="panel-heading"  align="center"><img src="<?php echo $startup['logo_url']; ?>"></div>
     <div class="panel-body" align="center">
      <h2><?php echo $startup['name']; ?></h2>
      <p><?php echo textLimit($startup['product_desc']); ?></p>
     </div>
     <div class="panel-footer">
      <a href="<?php echo $startup['angellist_url']; ?>" target="_blank">Link</a>
     </div>
    </div>
   </div>
  <?php } ?>

 </div>
</div>

<?php include('footer.php'); ?>

