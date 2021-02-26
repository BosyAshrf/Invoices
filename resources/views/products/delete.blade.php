 <!-- Modal -->
 <div class="modal fade" id="delete{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Products</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('products.destroy',$product->id)}}" method="POST">
                {{ method_field('DELETE') }}
                @csrf
                <P>هل انت متاكد من عملية الحذف؟</P>
                <input type="text" class="form-control" value="{{ $product->product_name }}" readonly>

                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">OK</button>
                  </div>
               
            </form>
        </div>
        
      </div>
    </div>
  </div>