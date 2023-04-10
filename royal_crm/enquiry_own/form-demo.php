
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col">
                <div class="box">
       
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label>Minimal</label>
                <select class="form-control select2 w-p100">
                  <option selected="selected">Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label>Multiple</label>
                <select class="form-control select2 w-p100" multiple="multiple" data-placeholder="Select a State">
                  <option>Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>
              <!-- /.form-group -->

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

      </div>
        <!-- /.box-body -->
        
      </div>


			</div>
			<!-- /.col --> 
		</div>
		<!-- /.row -->
			
			<!-- /.col --> 
		
	</section>


  <?php
  if($_POST['action']=="itemChange")
  {	 
    
    $item_id = $_POST['item_id'];	
    $itemchange = $pdo_conn->prepare("SELECT * FROM ratefixing WHERE item_id = $item_id ORDER BY item_id ASC");
    $itemchange->execute();
    $item = $itemchange->fetch();	
    echo $item_rate = $item['rate'];	
  }
  ?>
