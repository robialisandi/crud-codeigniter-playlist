<?php
$user_id=$this->session->userdata('user_name');

if(!(string)$user_id){

  redirect('user/login_view');
}

 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter 2.0.2 Documentation - BootstrapDocs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>/assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Organo</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="./about">About</a></li>
              <li><a href="./contact">Contact</a></li>
            </ul>

            <ul class="nav pull-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user_id; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url('user/user_logout');?>">Keluar</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row-fluid">
         <div class="span12">
            <h1>Dashboard</h1>
            <p>List Book.</p>
            <div class="row-fluid">
               <div class="span4">
                  <p>
                     <button class="btn btn-success" onclick="add_book()"><i class="icon-plus icon-white"></i> Add Book</button>
                  </p>
               </div>
            </div>

            <div class="row-fluid">
               <div class="span12">
                  <table class="table table-striped table-bordered table-condensed">
                     <thead>
                        <tr>
                          <th>Book ID</th>
                          <th>Book ISBN</th>
                          <th>Book Title</th>
                          <th>Book Author</th>
                          <th>Book Category</th>
                          <th style="width:125px;">Action</p></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach($books as $book){?>
             				     <tr>
                                 <td><?php echo $book->book_id;?></td>
             				        <td><?php echo $book->book_isbn;?></td>
                                 <td><?php echo $book->book_title;?></td>
                                 <td><?php echo $book->book_author;?></td>
             						  <td><?php echo $book->book_category;?></td>
             						  <td>
                                    <button class="btn btn-mini btn-primary" data-toggle="modal" onclick="edit_book(<?php echo $book->book_id;?>)"><i class="icon-edit icon-white"></i> Edit</button>
             							  <button class="btn btn-mini btn-danger" data-toggle="modal" onclick="delete_book(<?php echo $book->book_id;?>)"><i class="icon-trash icon-white"></i> Delete</button>
             						  </td>
             				     </tr>
             				<?php }?>
                     </tbody>
                  </table>
                  <?php echo $links; ?>
               </div>
            </div>

            <!-- modal -->
            <div class="modal fade" id="modal_form">
              <div class="modal-header">
                 <h3>Add Books</h3>
              </div>
              <div class="modal-body">
                 <form action="#" id="form" class="form-horizontal">
                    <fieldset>
                       <input type="hidden" value="" name="book_id"/>
                       <div class="form-body">
                          <div class="control-group">
                             <label class="control-label col-md-3">Book ISBN :</label>
                             <div class="controls col-md-9">
                                <input name="book_isbn" placeholder="Book ISBN" class="form-control input-small" type="text">
                             </div>
                          </div>
                          <div class="control-group">
                             <label class="control-label col-md-3">Book Title :</label>
                             <div class="controls col-md-9">
                                <input name="book_title" placeholder="Book_title" class="form-control span3" type="text">
                             </div>
                          </div>
                          <div class="control-group">
                             <label class="control-label col-md-3">Book Author :</label>
                             <div class="controls col-md-9">
                                <input name="book_author" placeholder="Book Author" class="form-control span3" type="text">
                             </div>
                          </div>
                          <div class="control-group">
                             <label class="control-label col-md-3">Book Category :</label>
                             <div class="controls col-md-9">
                                <input name="book_category" placeholder="Book Category" class="form-control span3" type="text">
                             </div>
                          </div>
                       </div>
                    </fieldset>
                 </form>
              </div>
              <div class="modal-footer">
                 <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
           </div>

         </div>
      </div>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-transition.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-alert.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-modal.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-dropdown.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-tab.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-popover.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-button.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-collapse.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-carousel.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-typeahead.js"></script>

    <script type="text/javascript">
    $(window).load(function() {
      $('#modal').modal('show');
    });

    var save_method; //for save method string
    var table;

    function add_book()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    }

    function edit_book(id)
    {
      save_method = 'update';
      //$('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('index.php/book/ajax_edit/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
             $('[name="book_id"]').val(data.book_id);
             $('[name="book_isbn"]').val(data.book_isbn);
             $('[name="book_title"]').val(data.book_title);
             $('[name="book_author"]').val(data.book_author);
             $('[name="book_category"]').val(data.book_category);

             $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
             //$('.modal-title').text('Edit Book'); // Set title to Bootstrap modal title
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
          url = "<?php echo site_url('index.php/book/book_add')?>";
      }
      else
      {
          url = "<?php echo site_url('index.php/book/book_update')?>";
      }

      // ajax adding data to database
      $.ajax({
          url : url,
          type: "POST",
          data: $('#form').serialize(),
          dataType: "JSON",
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
    }

    function delete_book(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
          // ajax delete data from database
          $.ajax({
             url : "<?php echo site_url('index.php/book/book_delete')?>/"+id,
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


  </body>
</html>
