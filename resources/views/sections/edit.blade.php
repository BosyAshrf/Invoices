
  <!-- Modal -->
  <div class="modal fade" id="edit{{ $section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Sections</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
			<form action="{{ route('sections.update',$section->id)}}" method="POST">
				{{ method_field('PATCH') }}
                @csrf
            
                <div class="row">
                    <div class="col-12">
                        <label for="">اسم القسم</label>
                        <input type="text" class="form-control @error('section_name') is-invalid @enderror" name="section_name" value="{{$section->section_name}}">
                    </div>
                
                    <div class="col-12">
                        <label for="">الوصف</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{$section->description}}">
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