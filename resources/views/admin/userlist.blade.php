@extends('admin/layout')
@section('page_title', 'Users')
@section('user_select','active')
@section('container')

    @if(session()->has('msg'))
        <div class="sufee-alert alert with-close alert-dark alert-dismissible fade show">
            <!-- <span class="badge badge-pill badge-dark">Success</span> -->
            {{session('msg')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session()->has('erroe_msg'))
        <div class="sufee-alert alert with-close alert-dark alert-dismissible fade show">
            <!-- <span class="badge badge-pill badge-dark">Success</span> -->
            {{session('erroe_msg')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

<div class="row " style="margin-bottom:40px;">
    <div class="col-md-10">
    <h1>User</h1>
    </div>
    <div class="col-md-2">
        <a class="au-btn au-btn-icon au-btn--blue" href="manage_user">
        <i class="zmdi zmdi-plus"></i>user</a>

    </div>
</div>

<div class="row">

    <div class="table-responsive table--no-card m-b-40">
        <table class="table table-borderless table-striped table-earning">
            <thead>
                <tr>
                    <th>S.no</th>                  
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Mobile</th>                    
                    <th>Is Verified</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php
                $key=1;
                ?>
                
                @foreach($data as $val)
                
                <tr>
                   
                    <td><?=$key++;?></td>
                    <td>{{$val->name}}</td>
                    <td>{{$val->email}}</td>
                    <td> {{$val->mobile}}</td>
                     @if($val->is_userverified==1)
                     
                        <td style="color:green">Verified</td>
                        @else<td style="color:orange"> Pending</td>
                        @endif
                    
                    <!-- <td class="text-right">
                        <a href="{{url('admin/manage_user')}}/{{$val->id}}"> 
                        <button type="button" class="btn btn-primary">Edit</button></a>
                        
                      
                        <a href="{{url('admin/user/delete')}}/{{$val->id}}">
                                <button type="button" class="btn btn-danger">Delete</button>
                            </a>
                    </td> -->
                </tr>
               @endforeach
               
            </tbody>
        </table>
    </div>
</div>
@endsection

