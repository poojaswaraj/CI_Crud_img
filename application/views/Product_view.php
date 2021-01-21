<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD TEST Ecommerce</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>


  <div class="container">
    <h1>CRUD TEST Ecommerce
      </h1>
</center>

    <br />
    <button class="btn btn-success" onclick="add_book()"><i class="glyphicon glyphicon-plus"></i> Add Product</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
					<th>ID</th>
					<th>Product Name</th>
          <th>Price</th>
					

          <th style="width:125px;">Action
          </p></th>
        </tr>
      </thead>
      <tbody> 
				<?php foreach($Products as $Product){?>
				     <tr> 
				         <td><?php echo $Product->id;?></td>
				         <td><?php echo $Product->product_name;?></td>
                 <td><?php echo $Product->price;?></td>
								
								<td>
									<button class="btn btn-warning" onclick="edit_book(<?php echo $Product->id;?>)"><i class="glyphicon glyphicon-pencil" data-toggle="tooltip"></i></button>
									<button class="btn btn-danger" onclick="delete_book(<?php echo $Product->id;?>)"><i class="glyphicon glyphicon-remove" data-toggle="tooltip"></i></button>


								</td>
				      </tr>
				     <?php }?>



      </tbody>

    </table>

  </div>

 

  <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;


    function add_book()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      // 
      $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Product'); 
 
    }

    function edit_book(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('Product/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="product_id"]').val(data.id);
            $('[name="Product_name"]').val(data.product_name);
            $('[name="Product_Price"]').val(data.price);
            

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Product'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }



    function save()
    {

      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('Product/Product_add')?>";
      }
      else
      {
        url = "<?php echo site_url('Product/Product_update')?>";
      }

$('#form').submit(function(e) 
    {
      e.preventDefault();
      // alert(url);
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
          data: new FormData(this),
            dataType: "JSON",
            processData:false, 
         contentType:false,
         cache:false,
         async:false,
            success: function(data)
            {
              
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
              
                alert('Error adding / update data');
            }
          });
        });
    }

    function delete_book(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('Product/Product_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
    }

  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Product Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal" method="post" enctype="multipart/form-data" class="form-horizontal" >
             <!-- <form action="<?php echo site_url('book/book_add');?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="form"> -->
          <input type="hidden" value="" name="product_id"/>
          <input type="hidden"  name="sub_cat_id" value="<?php echo $this->uri->segment(3);?>"/>
          
          <div class="form-body">
          
            <div class="form-group">
              <label class="control-label col-md-3">Product Name</label>
              <div class="col-md-9">
                <input name="Product_name" placeholder="Product Name" class="form-control" type="text">
              </div>
            </div>

              <div class="form-group">
              <label class="control-label col-md-3">Product Price</label>
              <div class="col-md-9">
                <input name="Product_Price" placeholder="Product Price" class="form-control" type="text">
              </div>
            </div>
         
           
				

          </div>
           <!-- <button type="button" class="btn btn-primary" style="width:100%;">Save</button> -->
          
          
          <div class="modal-footer">
       <input type ="submit" name="submit" value="Salvar"  id="btnSave " 
        onclick="save()" class="btn btn-primary" />
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </form></div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



  
  <!-- End Bootstrap modal -->

  </body>
</html>