@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật danh mục sản phẩm
                            <?php
                                $message = session()->get('Message');
                                if($message){
                                    echo '<script>alert("'.$message.'");</script>';
                                    session()->put('Message',null);
                                }
                            ?>
                        </header>
                        <div class="panel-body">
                            @foreach($edit_product as $key => $value)
                            <div class="position-center">
                                <form role="form" method="POST" action = "{{URL::to('/update-product/'.$value->product_id)}}" enctype="multipart/form-data" >
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text" name="product_name" value='{{$value->product_name}}' class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ảnh</label>
                                        <input type="file" name="product_img" class="form-control" id="exampleInputEmail1">
                                        <img src="{{URL::to('public/upload/product/'.$value->product_image)}}" style="height: 100px; width: 100px;">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá</label>
                                        <input type="number" name="product_price" value='{{$value->product_price}}' class="form-control" id="exampleInputEmail1" placeholder="Giá">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả</label>
                                        <textarea style="resize: none;" rows="8" name="product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả">{{$value->product_desc}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nội dung</label>
                                        <textarea style="resize: none;" rows="8" name="product_content" class="form-control" id="exampleInputPassword1" placeholder="Nội dung">{{$value->product_content}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                                            <select class="form-control m-bot15" name ="product_cate">
                                                @foreach($cate_product as $key => $cate) 
                                                    @if($cate->category_id == $value->category_id)    
                                                        <option selected value ='{{$cate->category_id}}'>{{$cate->category_name}}</option>
                                                    @else
                                                        <option value ='{{$cate->category_id}}'>{{$cate->category_name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Thương hiệu</label>
                                        <select class="form-control m-bot15" name ="product_brand">
                                            @foreach($brand_product as $key => $brand)
                                                <!-- <option value = '{{$brand->brand_id}}'>{{$brand->brand_name}}</option> -->
                                                @if($brand->brand_id == $value->brand_id)    
                                                    <option selected value ='{{$brand->brand_id}}'>{{$brand->brand_name}}</option>
                                                @else
                                                    <option value ='{{$brand->brand_id}}'>{{$brand->brand_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" name="update_product" class="btn btn-info">Cập nhật danh mục</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
        </div>
@endsection