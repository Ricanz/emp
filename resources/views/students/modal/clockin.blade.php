<div id="modal_clock_in" class="modal">
    <div class="modal-body sm">
        <div class="close md close-modal"></div>
        <div class="content-modal">
            <div class="modal-clock mtop-15 mbottom-20">
                <h4 class="fs-18 mbottom-30">Clock In</h4>
                <img width="80" class="mbottom-20" src="{{ asset('/guestAssets/img/clockin.svg') }}" alt="">
                <h5 class="fw-400" id="date"></h5>
                <h5 class="fw-400" id="time"></h5>
                <form id="clock_in_form" class="mtop-30">
                    @csrf
                    <input type="hidden" id="latitude_clockin" name="latitude_clockin" />
                    <input type="hidden" id="longitude_clockin"  name="longitude_clockin"/>
                    <button id="clock_in_button" class="btn-rounded primary clock-in m-auto">
                        <span>Clock In</span>
                        <img width="11" src="{{ asset('/guestAssets/img/check-blue.svg') }}" alt="">
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_clock_out" class="modal">
    <div class="modal-body sm">
        <div class="close md close-modal"></div>
        <div class="content-modal">
            <div class="modal-clock">
                <h4 class="fs-18 mbottom-30">Clock Out</h4>
                <img width="80" class="mbottom-20" src="{{ asset('/guestAssets/img/clockin.svg') }}" alt="">
                <h5 class="fw-400" id="getDate"></h5>
                <h5 class="fw-400" id="getTime"></h5>
                <form id="clock_out_form" class="mtop-30">
                    @csrf
                    <input type="hidden" id="latitude_clockout" name="latitude_clockout" />
                    <input type="hidden" id="longitude_clockout"  name="longitude_clockout"/>
                    <button id="clock_in_button" class="btn-rounded primary clock-in m-auto">
                        <span>Clock Out</span>
                        <img width="11" src="{{ asset('/guestAssets/img/check-blue.svg') }}" alt="">
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="{{url('/custom/guest/logbook.js')}}" type="application/javascript" ></script>
@endsection