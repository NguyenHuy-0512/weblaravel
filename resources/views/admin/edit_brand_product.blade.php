@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật thương hiệu sản phẩm
                            <?php
                                $message = session()->get('Message');
                                if($message){
                                    echo '<script>alert("'.$message.'");</script>';
                                    session()->put('Message',null);
                                }
                            ?>
                        </header>
                        <div class="panel-body">
                            @foreach($edit_brand_product as $key => $value)
                            <div class="position-center">
                                <form role="form" method="POST" action = {{URL::to('/update-brand-product/'.$value->brand_id)}} >
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên thương hiệu</label>
                                        <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu" value="{{$value->brand_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả</label>
                                        <textarea style="resize: none;" rows="8" name="brand_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả thương hiệu">{{$value->brand_desc}}</textarea>
                                    </div>
                                    <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhật thương hiệu</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
        </div>
@endsection