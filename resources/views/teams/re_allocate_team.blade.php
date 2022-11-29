  <!-- Re-Allocate Employees Modal to Team-->
  <div class="modal custom-modal fade" id="team_reallocation_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Re-allocation</h3>
                    <p>Select team to re-allocate</p>
                </div>
                    <form id="re_allocation_form" method="POST">
                        @csrf
                        <div class=" form-group">
                            <select class="form-control" name="new_team_id" id="">
                                <option value="" selected> </option>
                                @forelse ($teams as $team)
                                    <option value="{{$team->id}}">{{$team->name}}</option>
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

<!-- /Re-Allocate Employees Modal to Team-->
@push('scripts')
<script>
    $("body #re_allocation_btn").on('click',function(e){
        var employee_id = $(this).data('id');
        $("#team_reallocation_modal #employee_id_input").val(employee_id);
        $('#team_reallocation_modal #re_allocation_form').attr('action', '/teams/re_allocate_employee/'+employee_id);
    })
</script>
@endpush