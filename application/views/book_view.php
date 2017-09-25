<?php $this->load->view('components/header'); ?>
    <div class="container">
      <div class="row-fluid">
         <div class="span12">
            <h1>Dashboard</h1>
            <p>List Book.</p>
            <div class="row-fluid">
               <div class="span4">
                  <p>
                     <button class="btn btn-success" onclick="javascript: COMMON.Page.book_view.add_book()"><i class="icon-plus icon-white"></i> Add Book</button>
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
                 <h3 class="modal-title">Add Books</h3>
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
                 <button type="button" id="btnSave" onclick="javascript: COMMON.Page.book_view.save()" class="btn btn-primary">Save</button>
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
           </div>

         </div>
      </div>
    </div> <!-- /container -->

    <script type="text/javascript">
    COMMON.Page.book_view = {
      doInit: function() {
         $('#modal').modal('show');
         var save_method; //for save method string
         var table;
      }

      , add_book: function() {
         save_method = 'add';
         $('#form')[0].reset(); // reset form on modals
         $('#modal_form').modal('show'); // show bootstrap modal
      }

      , edit_book: function($id) {
         save_method = 'update';
         $('#form')[0].reset(); // reset form on modals

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
                $('.modal-title').text('Edit Book'); // Set title to Bootstrap modal title
             },
             error: function (jqXHR, textStatus, errorThrown)
             {
                alert('Error get data from ajax');
             }
         });
      }

      , save: function(){
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

      , delete_book: function(id) {
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

    }

    $(document).ready(function () {
    //$(window).load(function() {
      COMMON.Page.book_view.doInit();
    });

    </script>

 <?php $this->load->view('components/footer'); ?>
