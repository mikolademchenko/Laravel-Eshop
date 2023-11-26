@if ($product->exists)
    <form class="form-horizontal" method="POST" action="{{ route('products.update', $product->id) }}"
          enctype="multipart/form-data">
        @method('put')
        @csrf
        @else
            <form class="form-horizontal" method="POST" action="{{ route('products.store') }}"
                  enctype="multipart/form-data">
                @csrf
                @endif
                <div class="row">
                    <div class="form-group col-6">
                        <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                        <input id="inputTitle" type="text" name="title" placeholder="Enter title"
                               value="{{ $product->title ?? '' }}"
                               class="form-control">
                    </div>
                    <div class="input-group col-6">
                        <div class="image">
                            <label for="inputTitle" class="col-form-label">Image <span
                                        class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="photo">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="summary" name="summary">{{$product->summary ?? ''}}</textarea>
                </div>

                <div class="form-group">
                    <label for="description" class="col-form-label">Description</label>
                    <textarea class="form-control" id="description"
                              name="description">{{ $product->description ??''}}</textarea>

                </div>


                <div class="form-group">
                    <label for="is_featured">Is Featured</label><br>
                    <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="cat_id">Category <span class="text-danger">*</span></label>
                        <select class="form-control js-example-basic-multiple" id="category" name="category[]"
                                multiple="multiple">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
                        <input id="price" type="number" name="price" placeholder="Enter price"
                               value="{{ $product->price ?? '' }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col-6">
                        <label for="size">Size</label>
                        <select class="form-control js-example-basic-multiple" id="size" name="size[]"
                                multiple="multiple">
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="color" class="col-form-label">Color</label>
                        <input id="color" type="text" name="color[]" placeholder="Enter color"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="condition_id">Condition</label>
                    <select name="condition_id" class="form-control">
                        <option value="">--Select condition--</option>
                        @foreach($conditions as $condition)
                            <option value="{{$condition->id}}"@if (!empty($product->condition->id))
                                {{($condition->id==$product->condition->id)? 'selected':'' }}
                                    @endif>{{$condition->status}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Repeat the above structure for other form fields -->

                <div class="form-group row">
                    @foreach ($attributes as $attribute)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="attribute_{{ $attribute->id }}">{{ $attribute->name }}</label>
                                <input type="text" class="form-control" name="attributes[{{ $attribute->id }}]"
                                       id="attribute_{{ $attribute->id }}"
                                       value="{{ $product->attributeValues->where('attribute_id', $attribute->id)->first()->value ?? '' }}">
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Continue with the rest of the form elements -->

                <button type="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-success" type="submit">Submit</button>

            </form>

            @push('scripts')
                <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
                <script type="text/javascript">
                    CKEDITOR.replace('description', {
                        filebrowserUploadUrl: "{{ route('ckeditor.image-upload', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form'
        });
                </script>
    @endpush
