@extends('admin.layouts.main-admin')

@section('content')
<div class="white-box">
    <div class="col-mod-12">
        <div class="col-mod-6 col-lg-6">
            <h3 class="box-title text-success m-b-0">Service Category Edit</h3>
            <p class="text-muted m-b-30">Update Service Category</p>
        </div>        
        <div class="col-mod-6 col-lg-6 ">
            <a href="{{ route('service-category-list') }}" class="waves-effect pull-right"><button class="btn btn-xs btn-info "><i class="fa fa-arrow-circle-left"></i> Service Category List</button></a>
        </div>    
    </div>  
    <div class="clear"></div><hr/>
    <div class="panel-body">
        <form action="{{ route('post.update-service-category', ['id' => $category->id]) }}" method="post">
            {{ csrf_field() }}
            <div class="form-body">
                <h3 class="box-title">Category information</h3>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Category Name<span class="text-danger m-1-5">*</span></label>
                            <input type="text" id="category" class="form-control" placeholder="Service category" name="category" value="{{$category->cat_name}}" required=""> 
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success pull-right"> <i class="fa fa-check"></i> UPDATE CATEGORY</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection