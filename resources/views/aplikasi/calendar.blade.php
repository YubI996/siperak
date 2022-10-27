                @extends('admin::layouts.app')
                @section('custom-css')
                    <link rel="stylesheet" type="text/css" href="{{asset('admin/src/plugins/fullcalendar/fullcalendar.css')}}" />
                @endsection
                @section('item')
                    <a href="{{route('home2')}}">Home</a>
                @endsection
                @section('item-active', 'calendar')
                @section('content')
                    <div class="calendar-wrap">
						<div id="calendar"></div>
					</div>
					<!-- calendar modal -->
					<div id="modal-view-event" class="modal modal-top fade calendar-modal">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-body">
									<h4 class="h4">
										<span class="event-icon weight-400 mr-3"></span><span
											class="event-title"></span>
									</h4>
									<div class="event-body"></div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" data-dismiss="modal">
										Close
									</button>
								</div>
							</div>
						</div>
					</div>

					<div id="modal-view-event-add" class="modal modal-top fade calendar-modal">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<form id="add-event">
									<div class="modal-body">
										<h4 class="text-blue h4 mb-10">Add Event Detail</h4>
										<div class="form-group">
											<label>Event name</label>
											<input type="text" class="form-control" name="ename" />
										</div>
										<div class="form-group">
											<label>Event Date</label>
											<input type="text" class="datetimepicker form-control" name="edate" />
										</div>
										<div class="form-group">
											<label>Event Description</label>
											<textarea class="form-control" name="edesc"></textarea>
										</div>
										<div class="form-group">
											<label>Event Color</label>
											<select class="form-control" name="ecolor">
												<option value="fc-bg-default">fc-bg-default</option>
												<option value="fc-bg-blue">fc-bg-blue</option>
												<option value="fc-bg-lightgreen">
													fc-bg-lightgreen
												</option>
												<option value="fc-bg-pinkred">fc-bg-pinkred</option>
												<option value="fc-bg-deepskyblue">
													fc-bg-deepskyblue
												</option>
											</select>
										</div>
										<div class="form-group">
											<label>Event Icon</label>
											<select class="form-control" name="eicon">
												<option value="circle">circle</option>
												<option value="cog">cog</option>
												<option value="group">group</option>
												<option value="suitcase">suitcase</option>
												<option value="calendar">calendar</option>
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary">
											Save
										</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal">
											Close
										</button>
									</div>
								</form>
							</div>
						</div>
                    </div>
                @endsection
                @section('custom-scripts')
                    <script src="{{ asset('admin/src/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
	                <script src="{{ asset('admin/vendors/scripts/calendar-setting.js')}}"></script>
                @endsection