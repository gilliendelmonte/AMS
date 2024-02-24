<?php
  $page_title = 'Add Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
?>
<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('product-title','product-categorie','product-quantity','location', 'saleing-price' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['product-title']));
     $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
     $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
     $p_location   = remove_junk($db->escape($_POST['location']));
     $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }
     $date    = make_date();
     $query  = "INSERT INTO products (";
     $query .=" name,quantity,buy_price,sale_price,categorie_id,media_id,date";
     $query .=") VALUES (";
     $query .=" '{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', '{$date}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Product added ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Product</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="Product Title">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="product-locate">
                      <option value="">Select Location</option>
                      <option value="office">ICTC Office</option>
                      <option value="Lab">Lab 401-Pc1</option>
                      <option value="Lab">Lab 401-Pc2</option>
                      <option value="Lab">Lab 402-Pc32</option>
                      <option value="Lab">Lab 403</option>
                      <option value="Lab">Lab 404</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                  
              
              <select class="form-control" name="product-units">
               <option value="">Select Unit</option>
               <option value="cpu">PC</option>
               <option value="memory">Network</option>
               <option value="HDDt">Peripherals</option>
               <option value="mouse">Mouse</option>
             
               </select>


</form>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                  
              
              <select class="form-control" name="product-units">
               <option value="">Select Status</option>
               <option value="new">Brandnew</option>
               <option value="deployed">Deployed</option>
               <option value="broken">Broken</option>
               <option value="urepair">Under Repair</option>
               </select>


</form>
                  </div>
                </div>
              </div>
                  <div class="form-group">
                  <div class="row">
                  <div class="col-md-6">
              <label for="cpu" class="control-label">Enter Details</label>
              <input type="name" class="form-control" name="type" placeholder="Enter Type of Unit">
              <input type="name" class="form-control" name="serial" placeholder="Enter Serial number">
              <input type="name" class="form-control" name="specs" placeholder="Enter Specification">
              <input type="name" class="form-control" name="brand" placeholder="Enter Brand">
              <input type="name" class="form-control" name="color" placeholder="Enter Color">
              <input type="name" class="form-control" name="tore" placeholder="Enter Store location">
              <label for="cpu" class="control-label">Enter Purchase Date</label>
              <input type="date" class="form-control" name="purdate">
              <label for="cpu" class="control-label">Enter Warranty Date</label>
              <input type="date" class="form-control" name="warranty">


                  </div>
                  </div>
                  </div>
                 
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="product-categorie">
                      <option value="">Select Product Category</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="product-photo">
                      <option value="">Select Product Photo</option>
                    <?php  foreach ($all_photo as $photo): ?>
                      <option value="<?php echo (int)$photo['id'] ?>">
                        <?php echo $photo['file_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
      </div>
              <button type="submit" name="add_product" class="btn btn-danger">Add product</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
