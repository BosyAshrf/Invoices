 <!-- Modal -->
 <div class="modal fade" id="delete_file{{ $attachment->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Delete Attachments</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="{{ route('InvoicesDetails.destroy',$attachment->id)}}" method="POST">
                     {{ method_field('DELETE') }}
                     @csrf
                     <p class="text-center">
                        <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                     </p>
                     <input type="hidden" name="id_file" id="id_file" value="">
                     <input type="hidden" name="file_name" id="file_name" value="">
                     <input type="hidden" name="invoice_number" class="form-control"
                         value="{{ $attachment->invoice_number }}" readonly>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">OK</button>
             </div>

             </form>
         </div>

     </div>
 </div>
 </div>
