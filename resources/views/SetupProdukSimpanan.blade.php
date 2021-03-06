@extends('master')

@section('sidebar')
  
@endsection

@section('content')
<h2 align="center">Input Produk SImpanan</h2>  
<div class="form-group">
     <form name="add_name" id="add_name">  


        <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
        </div>


        <div class="alert alert-success print-success-msg" style="display:none">
        <ul></ul>
        </div>


        <div class="table-responsive">  
            <table class="table table-bordered" id="dynamic_field"> 
                <tr id="row1">
                    <h1>simpanan- 1</h1>
                </tr> 
                <tr>  
                    <td><input type="text" name="name[]" placeholder="Nama Simpanan" class="form-control name_list" /> </td> 
                    
                </tr>  
                <tr>
                    <td><input type="text" name="kodesimpanan[]" placeholder="Kode Simpanan" class="form-control name_list" /></td>
                    <td><button type="button" name="add" id="add" class="btn btn-success">Tambah Produk</button></td>  
                </tr>
            </table>  
            <input type="button" name="submit" id="submit" class="btn btn-info" value="Simpan & Lanjutkan" />  
        </div>


     </form>  
</div> 
</div>


<script type="text/javascript">
$(document).ready(function(){      
  var postURL = "<?php echo url('addmore'); ?>";
  var i=1;  


  $('#add').click(function(){  
       i++;  
       $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><h1>simpanan-'+i+'</h1></td></tr>');  
       $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Nama Simpanan" class="form-control name_list" /></td></tr>');  
       $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="kodesimpanan[]" placeholder="Kode Simpanan" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
  });  


  $(document).on('click', '.btn_remove', function(){  
       var button_id = $(this).attr("id");   
       $('#row'+button_id+'').remove();  
  });  


  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });


  $('#submit').click(function(){            
       $.ajax({  
            url:postURL,  
            method:"POST",  
            data:$('#add_name').serialize(),
            type:'json',
            success:function(data)  
            {
                if(data.error){
                    printErrorMsg(data.error);
                }else{
                    i=1;
                    $('.dynamic-added').remove();
                    $('#add_name')[0].reset();
                    $(".print-success-msg").find("ul").html('');
                    $(".print-success-msg").css('display','block');
                    $(".print-error-msg").css('display','none');
                    $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                }
            }  
       });  
  });  


  function printErrorMsg (msg) {
     $(".print-error-msg").find("ul").html('');
     $(".print-error-msg").css('display','block');
     $(".print-success-msg").css('display','none');
     $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
     });
  }
});  
</script>
@endsection