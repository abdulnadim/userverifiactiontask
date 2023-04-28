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
            <form action="{{route('user.insert')}}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                @csrf 
                {{method_field('post')}}
                
                <div class="card">            
                    <div class="card-body">
                        
                        <div class="form-group has-success">
                            <label for="name" class="control-label mb-1">User Name</label>
                            <input id="name" name="name" value="{{$name}}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                            <input type="hidden" name="id" value="{{$id}}">
                            
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                        
                            @enderror
                        </div>
                        <div class="form-group has-success">
                            <label for="email" class="control-label mb-1">Email</label>
                            <input id="email" name="email" value="{{$email}}" type="Email" class="form-control" aria-required="true" aria-invalid="false">
                            
                            
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
                    <button  type="submit" class="btn btn-lg btn-info btn-block">
                        Submit
                    </button>
                </div>                    
            </form>
       
    </div> 
</div>

@endsection


