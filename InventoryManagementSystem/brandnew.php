<?php
  $page_title = 'Monthly Disposal Reports';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
 $year = date('Y');
 $sales = monthlyDispose($year);
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Brandnew Items</span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Units </th>
                <th class="text-center" style="width: 15%;"> Type</th>
                <th class="text-center" style="width: 15%;"> Specification</th>
                <th class="text-center" style="width: 15%;"> Serial Number</th>
                <th class="text-center" style="width: 15%;"> Brand</th>
                <th class="text-center" style="width: 15%;"> Color</th>
                <th class="text-center" style="width: 15%;"> Location</th>
                <th class="text-center" style="width: 15%;"> QR Code </th>
                <th class="text-center" style="width: 15%;"> Encoded By </th>
                <th class="text-center" style="width: 15%;"> Date </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($sale['name']); ?></td>
               <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
               <td class="text-center"><?php echo remove_junk($sale['total_saleing_price']); ?></td>
               <td class="text-center"><?php echo $sale['date']; ?></td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
