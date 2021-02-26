		<!-- Basic modal -->
		<div class="modal" id="modaldemo8">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Add Products</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form action="{{ route('products.store') }}" method="POST">
                            {{ csrf_field() }}

                         <div class="form-group">
                             <label for="exampleInputEmail1">اسم المنتج :-</label>
                            <input type="text" class="form-control" id="product_name" name="product_name">
                         </div>

                         <div class="form-group">
                             <label for="exampleInputEmail1">اسم القسم :-</label>
                             <select name="section_id" id="section_id" class="form-control">
                                 <option value="" disabled selected>-- حدد القسم --</option>
                                 @foreach ($sections as $section)
                                 <option value="{{ $section->id}}">{{$section->section_name}}</option>
                                 @endforeach
                         
                        </select>
                            </div>

                         <div class="form-group">
                            <label for="exampleFormControlTextarea1">ملاحظات :-</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
					</div>
				</div>
			</div>
		