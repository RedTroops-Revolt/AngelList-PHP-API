<?php
require('angelList/User.php');

if (isset($_GET['search'])) {
 $page = isset($_GET['page']) ? ((int) $_GET['page']) : 1;
 $slug = isset($_GET['slug']) ? ($_GET['slug']) : null;

 $User = new User();
 $user = $User->search(array('slug' => $slug, 'include_details' => 'investor'));

//vd($user['investor_details']['investments']);
}


if (isset($_GET['vd'])) {
 vd($user);
}
?>

<?php include('header.php'); ?>

<div class="container">

 <div class="row">
  <div class="col-lg-12" align="center">
   <form action="users.php" method="get">
    <input name="slug" class="form-control">
    <input type="submit" class="btn btn-default" name="search">
   </form>
  </div>
 </div>

 <?php if (isset($_GET['search']) && isset($user)) { ?>
  <div class="row">

   <div class="col-lg-2"><img src="<?php echo $user['image']; ?>"></div>

   <div class="col-lg-9">

    <h2>
     <a href="<?php echo $user['angellist_url']; ?>" target="_blank"><?php echo $user['name']; ?></a> 
     <span class="pull-right mute">Followers: <?php echo $user['follower_count']; ?></span>
    </h2>
    <h5><?php echo $user['bio']; ?></h5>

    <hr/>

    <ul class="nav nav-tabs" role="tablist">
     <li class="active"><a href="#about" role="tab" data-toggle="tab">About</a></li>
     <li><a href="#roles" role="tab" data-toggle="tab">Roles</a></li>
     <li><a href="#skills" role="tab" data-toggle="tab">Skills</a></li>
     <?php if ($user['investor']) { ?>
      <li><a href="#investor_details" role="tab" data-toggle="tab">Investor Details</a></li>
      <li><a href="#investments" role="tab" data-toggle="tab">Investments</a></li>
      <li><a href="#investments_market" role="tab" data-toggle="tab">Investments Market</a></li>
     <?php } ?>
    </ul>

    <div class="tab-content">
     <div class="tab-pane active" id="about">
      <br />
      <?php if (sizeof($user['locations']) > 0) { ?>
       <h3>Location(s):</h3>
       <ul>
	<?php foreach ($user['locations'] as $location) { ?>
         <li>
          <a href="<?php echo $location['angellist_url']; ?>" target="_blank">
	   <?php echo $location['display_name']; ?>
          </a>
         </li>
	<?php } ?>
       </ul>
      <?php } ?>

      <hr />

      <h3>What did I built:</h3>
      <p><?php echo $user['what_ive_built']; ?></p>

      <hr />
      <h3>What do I do:</h3>
      <p><?php echo $user['what_i_do']; ?></p>


     </div>

     <div class="tab-pane" id="skills">
      <br />
      <?php if (sizeof($user['skills']) > 0) { ?>
       <table class="table table-bordered">
	<?php foreach ($user['skills'] as $skill) { ?>
         <tr>
          <td>
   	<a href="<?php echo $skill['angellist_url']; ?>" target="_blank">
	    <?php echo $skill['display_name']; ?>
   	</a>
          </td>
         </tr>
	<?php } ?>
       </table>
      <?php } ?>
     </div>



     <div class="tab-pane" id="roles">
      <br />
      <table class="table table-bordered">
       <?php foreach ($user['roles'] as $role) { ?>
        <tr>
         <td>
  	<a href="<?php echo $role['angellist_url']; ?>" target="_blank">
	   <?php echo $role['display_name']; ?>
  	</a>
         </td>
        </tr>
       <?php } ?>
      </table>
     </div>

     <?php if ($user['investor']) { ?>
      <div class="tab-pane" id="investor_details">
       <br />
       <ul>
        <li>Startups Per Year: <?php echo $user['investor_details']['startups_per_year']; ?></li>
        <li>Average Amount: <?php echo $user['investor_details']['average_amount']; ?></li>
        <li>Accreditation: <?php echo $user['investor_details']['accreditation']; ?></li>
       </ul>
      </div>

      <div class="tab-pane" id="investments">
       <br />
       <?php if (sizeof($user['investor_details']['investments']) > 0) { ?>
        <table class="table table-bordered">
         <tr>
          <th>Company Name:</th>
          <th>Quality:</th>
         </tr>
	 <?php foreach ($user['investor_details']['investments'] as $investment) { ?>
          <tr>
           <td>
    	<a href="<?php echo $investment['angellist_url']; ?>" target="_blank">
	     <?php echo $investment['name']; ?>
    	</a>
           </td>
           <td><?php echo $investment['quality']; ?></td>
          </tr>
	 <?php } ?>
        </table>
       <?php } ?>
      </div>

      <div class="tab-pane" id="investments_market">
       <br />
       <?php if (sizeof($user['investor_details']['markets']) > 0) { ?>
        <table class="table table-bordered">
	 <?php foreach ($user['investor_details']['markets'] as $market) { ?>
          <tr>
           <td>
    	<a href="<?php echo $market['angellist_url']; ?>" target="_blank">
	     <?php echo $market['display_name']; ?>
    	</a>
           </td>
          </tr>
	 <?php } ?>
        </table>
       <?php } ?>
      </div>
     <?php } ?>
    </div>



   </div>
  </div>
 <?php } ?>

</div>


<?php include('footer.php'); ?>
