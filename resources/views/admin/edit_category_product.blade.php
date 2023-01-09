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
                            @foreach($edit_category_product as $key => $value)
                            <div class="position-center">
                                <form role="form" method="POST" action = {{URL::to('/update-category-product/'.$value->category_id)}} >
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên danh mục</label>
                                        <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" value="{{$value->category_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả</label>
                                        <textarea style="resize: none;" rows="8" name="category_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{$value->category_desc}}</textarea>
                                    </div>
                                    <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật danh mục</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
        </div>
@endsection