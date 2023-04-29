@extends('admin/layout')
@section ('page_title','Manage Product')
@section('product_select','active')
@section('container')


<div class="row " style="margin-bottom:40px;">
    <div class="col-md-10">
    <h1 > Manage User</h1>
    </div>
    <div class="col-md-2">
        <a class="au-btn au-btn-icon au-btn--blue" href="{{url('admin/user')}}">
        <i class="fa fa-left-arrow"></i> Back</a>

    </div>
</div>
<div class="row">
    <div class="col-lg-12">
            {{session('msg')}}
            <form action="javascript:void(0)" method="post" id="form_id">
                @csrf 
                
                
                <div class="card">            
                    <div class="card-body">
                        
                        <div class="form-group has-success">
                            <label for="name" class="control-label mb-1">User Name</label>
                            <input id="name" required name="name" value="{{$name}}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                            <input type="hidden" name="id" value="{{$id}}">
                            
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                        
                            @enderror
                        </div>
                        <div class="form-group has-success">
                            <label for="email" class="control-label mb-1">Email</label>
                            <input id="email" required name="email" value="{{$email}}" type="Email" class="form-control" aria-required="true" aria-invalid="false">
                            
                            
                            @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                        
                            @enderror
                        </div>
                        <div class="form-group has-success">
                            <label for="mobile" class="control-label mb-1">Mobile</label>
                            <input id="mobile" name="mobile"  value="{{$mobile}}" type="text" class="form-control valid" data-val="true" required
                                aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                            
                                @error('address')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                        
                            @enderror
                        </div>
                       
                    
                    </div>
                </div>
                <div>
                    <button  name="submit" id="submit"  class="btn btn-lg btn-info btn-block">
                        submit
                    </button>  
                    
                </div>                    
            </form>
            
       
    </div> 
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
$(document).ready(function(){
    
    $("#submit").click(function(){        
        var siteUrl = "{{url('/admin/adduser')}}";        
        var form = $('#form_id')[0];
        var data = new FormData(form);

        $.ajax({
          url: siteUrl,
          enctype: 'multipart/form-data',
          type: "POST",
          data: data,
          processData: false,
          contentType: false,
          cache: false,
          success: function( response ) {
          
            console.log(response,success);
            
          },
          error: function(error) {
            console.log(error);
            
          }
        });
        
        
        
        
    });
    
});
</script>
@endsection


