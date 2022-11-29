
        <!-- Re-Allocate Employees Modal to Dept-->
        <div class="modal custom-modal fade" id="department_reallocation_modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Re-allocation</h3>
                            <p>Select department to re-allocate employee</p>
                        </div>
                            <form id="employee_re_allocation_form" method="POST">
                                {{-- @method('PUT') --}}
                                @csrf
                                <div class=" form-group">
                                    <select class="form-control" name="new_dept_id" id="">
                                        <option value="" selected> </option>
                                        @forelse ($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @empty
                                            <option value="">No options! Contact Admin</option>
                                        @endforelse
                                    </select>
                                </div>
                                <input type="text" id="employee_id_input" name="employee_id" hidden>
                                <div class="submit-section">
                                    <button role='submit' class="btn btn-primary submit-btn">Save</button>
                                </div>
                            </form>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-6">
                            <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-warning cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /Re-Allocate Employees Modal to Dept-->
        @push('scripts')
        <script>
            $("body #re_allocation_btn").on('click',function(e){
                var employee_id = $(this).data('id');
                $("#department_reallocation_modal #employee_id_input").val(employee_id);
                $('#department_reallocation_modal #employee_re_allocation_form').attr('action', '/departments/re_allocate_employee/'+employee_id);
            })
        </script>
        @endpush