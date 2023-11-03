<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row mb-5">
              <div class="col-lg-3">
                <div class="card position-sticky top-1">
                    @include('admins.student.profile.menu')
                </div>
              </div>
              <div class="col-lg-9 mt-lg-0">
               
                <div class="card widget-calendar" id="basic-info">
                  @include('admins.student.profile.profile')
                  <div class="card-header">
                    <h5>Absensi</h5>
                  </div>
                  <div class="card-body pt-0">
                    <div class="d-flex">
                      <div class="p text-sm font-weight-bold mb-0 widget-reports-day"></div>
                      <span>&nbsp;</span>
                      <div class="p text-sm font-weight-bold mb-1 widget-reports-year"></div>
                    </div>
                      <div data-toggle="widget-reports"></div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </main>

    @section('scripts')
        <script src="{{url('/custom/admin/student.js')}}" type="application/javascript" ></script>
        <script>
          $(document).ready(function(){
              var token = $('input[name="_token"]').val();
              var user_id = {{$id}};
             // var absences = [];
              if (document.querySelector('[data-toggle="widget-reports"]')) {
                var calendarEl = document.querySelector('[data-toggle="widget-reports"]');
                var today = new Date();
                var mYear = today.getFullYear();
                var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                var mDay = weekday[today.getDay()];

                var m = today.getMonth();
                var d = today.getDate();
                document.getElementsByClassName('widget-reports-year')[0].innerHTML = mYear;
                document.getElementsByClassName('widget-reports-day')[0].innerHTML = mDay;
                
                $.ajax({
                  headers: { 'X-CSRF-TOKEN': token },
                  type: 'POST',
                  url: '/admin/student/absences/data',
                  data : { user_id : user_id },
                  success: function (response) {
                    
                    var absences = response.data
                    console.log(response.data);
                    console.log(response);
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                      contentHeight: 'auto',
                      initialView: 'dayGridMonth',
                      selectable: true,
                      initialDate: '2022-10-01',
                      //editable: true,
                      //headerToolbar: false,
                      events: absences
                    });
                    calendar.render();
                  }
                });

                
              }
          });

           function get_absences(){
            var user_id = {{$id}};
            var token = $('input[name="_token"]').val();
              $.ajax({
                headers: { 'X-CSRF-TOKEN': token },
                type: 'POST',
                url: '/admin/student/absences/data',
                data : { user_id : user_id },
                success: function (response) {
                      absences = response.data
                      //console.log(absences)
                      return absences;
                }
              });
            }
        </script>
    @endsection
</x-app-layout>
