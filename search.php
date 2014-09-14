<?php
require('angelList/Startup.php');

$page = isset($_GET['page']) ? ((int) $_GET['page']) : 1;

$Startup = new Startup();

if (isset($_GET['search'])) {
 $query = isset($_GET['query']) ? ($_GET['query']) : null;
 $type = isset($_GET['type']) ? ($_GET['type']) : 'Startup';

 $startups = $Startup->startups($query, $type, $page);
} else {
 $startups = $Startup->raising($page)['startups'];
}

$pagination_markup = "";
if ($raising['total'] > 3) {
 require('libs/Pagination.class');

 $pagination = (new Pagination());
 $pagination->setCurrent($page);
 $pagination->setTotal($raising['total']);
 $pagination_markup = $pagination->parse();
}

if (isset($_GET['vd'])) {
 vd($raising);
}
?>

<?php include('header.php'); ?>

<div class="container">

 <div class="row">
  <div class="col-lg-12" align="center">
   <form action="search.php" method="get" class="form">
    <input name="query" class="form-control">
    <select name="type" class="form-control">
     <option value="Startup">Startup</option>
     <option value="MarketTag">MarketTag</option>
     <option value="LocationTag">LocationTag</option>
     <option value="User">User</option>
    </select>
    <input type="submit" class="btn btn-default" name="search">
   </form>
  </div>
 </div>


 <div class="row">

  <?php if (isset($_GET['search'])) { ?>
   <?php foreach ($startups as $raise) { ?>
    <div class="col-lg-4">
     <div class="panel panel-default">
      <div class="panel-heading"  align="center"><img src="<?php echo $raise['logo_url']; ?>"></div>
      <div class="panel-body" align="center">
       <h2><?php echo $raise['name']; ?></h2>
       <p><?php echo textLimit($raise['product_desc']); ?></p>
       <hr />
       <b>Fundraising:</b>
       <table class="table table-bordered">
        <tr>
         <td>Round Opened At</td>
         <td><?php echo $raise['fundraising']['round_opened_at']; ?></td>
        </tr>
        <tr>
         <td>Raising Amount</td>
         <td>$<?php echo number_format($raise['fundraising']['raising_amount']); ?></td>
        </tr>
        <tr>
         <td>Pre Money Valuation</td>
         <td>$<?php echo number_format($raise['fundraising']['pre_money_valuation']); ?></td>
        </tr>
        <tr>
         <td>Discount</td>
         <td>$<?php echo number_format($raise['fundraising']['discount']); ?></td>
        </tr>
        <tr>
         <td>Equity Basis</td>
         <td><?php echo $raise['fundraising']['equity_basis']; ?></td>
        </tr>
        <tr>
         <td>Raised Amount</td>
         <td>$<?php echo number_format($raise['fundraising']['raised_amount']); ?></td>
        </tr>
        <tr>
         <td>Updated At</td>
         <td><?php echo $raise['fundraising']['updated_at']; ?></td>
        </tr>
       </table>
      </div>
      <div class="panel-footer">
       <a href="<?php echo $raise['angellist_url']; ?>" target="_blank">Link</a>
      </div>
     </div>
    </div>
   <?php } ?>

  <?php } ?>
 </div>


 <br />
 <hr />

 <div class="row">
  <div class="col-lg-12" align="center">
   <?php echo $pagination_markup; ?>
  </div>
 </div>


</div>


<?php include('footer.php'); ?>
