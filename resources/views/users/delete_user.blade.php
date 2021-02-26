<!-- حذف المستخدم -->
 <div class="modal fade" id="delete_user{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف المستخدم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form action="{{ route('users.destroy',$user->id)}}" method="post">
                  {{method_field('DELETE')}}
                    {{ csrf_field() }}
            </div>
            <div class="modal-body">
                <p>هل انت متاكد من عملية الحذف ؟</p><br>
                <input type="hidden" name="user_id" id="user_id" value="">
                <input type="text" class="form-control" name="name" value="{{ $user->name  }}" readonly>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                <button type="submit" class="btn btn-danger">تاكيد</button>
            </div>
            </form>
        </div>
    </div>
  </div>


