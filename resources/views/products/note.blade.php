<!-- Modal -->
<div class="modal fade" id="note{{ $product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit note Products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.update',$product->id)}}" method="POST">
                    {{ method_field('PATCH') }}
                    @csrf
  
                    <div class="row">
                        <div class="col-12">
                            <label for="">اسم المنتج</label>
                            <input type="text" class="form-control " value="{{ $product->product_name}}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="note" id="2" value="note">
                        </div>
                    </div>
  
                    <div class="row">
                        <div class="col-12">
                            <label for="">اسم القسم</label>
                            <select id="section_id" class="form-control"  readonly  >
                                <option value="" disabled selected>-- حدد القسم --</option>
                                @foreach ($sections as $section)
                                <option value="{{$section->id}}" disabled selected {{$section->id == $product->section_id ? 'selected' : ''}}>{{$section->section_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
  
  
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleFormControlTextarea1">ملاحظات :-</label>
                            <textarea class="form-control" id="description" name="description" rows="3">
                            {{ $section->description }}
                            </textarea>
  
                        </div>
                    </div>
  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
  
                </form>
            </div>
  
        </div>
    </div>
  </div>