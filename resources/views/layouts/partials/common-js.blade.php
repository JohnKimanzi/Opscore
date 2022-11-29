		<!-- jQuery -->
		<script src="{{asset('orange-theme/js/jquery-3.5.1.min.js')}}"></script>

		<!-- Bootstrap Core JS -->
        <script src="{{asset('orange-theme/js/popper.min.js')}}"></script>
        <script src="{{asset('orange-theme/js/bootstrap.min.js')}}"></script>

		<!-- Slimscroll JS -->
		<script src="{{asset('orange-theme/js/jquery.slimscroll.min.js')}}"></script>

		<!-- Chart JS -->
		@if(Route::is(['jobs-dashboard','user-dashboard']))

			<script src="{{asset('orange-theme/js/Chart.min.js')}}"></script>
			<script src="{{asset('orange-theme/js/line-chart.js')}}"></script>
		@endif

		@if(Route::is('dashboard'))
			<script src="{{asset('orange-theme/plugins/morris/morris.min.js')}}"></script>
			<script src="{{asset('orange-theme/plugins/raphael/raphael.min.js')}}"></script>
			<script src="{{asset('orange-theme/js/chart.js')}}"></script>
		@endif

		<!-- Select2 JS -->
		<script src="{{asset('orange-theme/js/select2.min.js')}}"></script>

		<script src="{{asset('orange-theme/js/jquery-ui.min.js')}}"></script>
		<script src="{{asset('orange-theme/js/jquery.ui.touch-punch.min.js')}}"></script>

		<!-- Datetimepicker JS -->
		<script src="{{asset('orange-theme/js/moment.min.js')}}"></script>
		<script src="{{asset('orange-theme/js/bootstrap-datetimepicker.min.js')}}"></script>

		<!-- Calendar JS -->
		{{-- <script src="{{asset('orange-theme/js/jquery-ui.min.js')}}"></script>  --}} {{--Replica--}}
        <script src="{{asset('orange-theme/js/fullcalendar.min.js')}}"></script>
        <script src="{{asset('orange-theme/js/jquery.fullcalendar.js')}}"></script>

		<!-- Multiselect JS -->
		<script src="{{asset('orange-theme/js/multiselect.min.js')}}"></script>

		<!-- Datatable JS -->
		{{-- <script src="{{asset('orange-theme/js/jquery.dataTables.min.js')}}"></script> --}}
		{{-- <script src="{{asset('orange-theme/js/dataTables.bootstrap4.min.js')}}"></script> --}}

		{{-- <script src="{{asset('orange-theme/js/push.min.js')}}"></script> --}}
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/autofill/2.3.9/js/dataTables.autoFill.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/fixedcolumns/4.0.1/js/dataTables.fixedColumns.min.js"></script>
        <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<!-- Summernote JS -->
		<script src="{{asset('orange-theme/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>


		<script src="{{asset('orange-theme/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>

		<!-- Task JS -->
		<script src="{{asset('orange-theme/js/task.js')}}"></script>

		<!-- Dropfiles JS
		<script src="{{asset('orange-theme/js/dropfiles.js')}}"></script> -->

		<!-- Custom JS -->
		<script src="{{asset('orange-theme/js/app.js')}}"></script>
		<script>
		 $(document).ready(function(){

        // Read value on page load
        $("#result b").html($("#customRange").val());

        // Read value on change
        $("#customRange").change(function(){
            $("#result b").html($(this).val());
        });
    });
		$(".header").stick_in_parent({

		});
		// This is for the sticky sidebar
		$(".stickyside").stick_in_parent({
			offset_top: 60
		});
		$('.stickyside a').click(function() {
			$('html, body').animate({
				scrollTop: $($(this).attr('href')).offset().top - 60
			}, 500);
			return false;
		});
		// This is auto select left sidebar
		// Cache selectors
		// Cache selectors
		var lastId,
			topMenu = $(".stickyside"),
			topMenuHeight = topMenu.outerHeight(),
			// All list items
			menuItems = topMenu.find("a"),
			// Anchors corresponding to menu items
			scrollItems = menuItems.map(function() {
				var item = $($(this).attr("href"));
				if (item.length) {
					return item;
				}
			});

		// Bind click handler to menu items


		// Bind to scroll
		$(window).scroll(function() {
			// Get container scroll position
			var fromTop = $(this).scrollTop() + topMenuHeight - 250;

			// Get id of current scroll item
			var cur = scrollItems.map(function() {
				if ($(this).offset().top < fromTop)
					return this;
			});
			// Get the id of the current element
			cur = cur[cur.length - 1];
			var id = cur && cur.length ? cur[0].id : "";

			if (lastId !== id) {
				lastId = id;
				// Set/remove active class
				menuItems
					.removeClass("active")
					.filter("[href='#" + id + "']").addClass("active");
			}
		});
		$(function () {
			$(document).on("click", '.btn-add-row', function () {
				var id = $(this).closest("table.table-review").attr('id');  // Id of particular table
				console.log(id);
				var div = $("<tr />");
				div.html(GetDynamicTextBox(id));
				$("#"+id+"_tbody").append(div);
			});
			$(document).on("click", "#comments_remove", function () {
				$(this).closest("tr").prev().find('td:last-child').html('<button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button>');
				$(this).closest("tr").remove();
			});
			function GetDynamicTextBox(table_id) {
				$('#comments_remove').remove();
				var rowsLength = document.getElementById(table_id).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length+1;
				return '<td>'+rowsLength+'</td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button></td>'
			}
		});
		$(function() {
			$('.alert').delay(500).fadeIn('normal', function() {
				$(this).delay(3500).fadeOut();
			});
		});
			$(function(){
				//check if session variable for notification is set
				var send_noti='{{Session::has('send_noti')}}';
				if(send_noti){
					Push.create("Check on your call backs!", {
						body: "You have scheduled call backs?",
						icon: '{{asset('orange-theme/img/notification.jpg')}}',
						timeout: 8000,
						onClick: function () {
							window.focus();
							this.close();
						}
					});
				}
				// unset session variable after successifuly displaying noti
				var unset_noti='{{Session::forget('send_noti')}}';
			});
		</script>
        {{-- <script src="{{asset('bootstrap/extensions/fixed-columns/bootstrap-table-fixed-columns.js')}}"></script> --}}
