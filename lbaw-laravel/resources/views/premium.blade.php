@extends ('layouts.app')

@section('title', 'Premium')

@section('content')

<?php use Carbon\Carbon; ?>

<script type="text/javascript">
    
    $(document).ready(function() {
        $("#premium-select .dropdown-item").click(function(){
            var selText = $(this).text();
            console.log(selText);
            $('#dropdownMenuButton').text(selText);
            $('#dropdownMenuButton').val(selText);
        });
        
        $('#buy-button').click(function(){
            var value = $('#dropdownMenuButton').val();

            return $.ajax({
                type: "POST",
                url: '{{ url("premium/buy") }}',
                dataType: 'JSON',
                data: { value: value, _token: '{{csrf_token()}}' },
                success: function (data) {
                    console.log(data);
                    
                },
                error: function (data, textStatus, errorThrown) {
                   console.log(data); 
                },
            });
        });
	});
    
</script>

<!-- home page -->
<div id="premium-page" class="container">
    <div class="card"> 
        <div class="card-header">
            <h5>Premium Service</h5>
        </div>
        <div class="card body">
            
            <div class="grid" style="padding:10px;">
                <div class="row text-center">
                    <div class="col-md">
                        Buy Premium
                    </div>
                    <div class="col-md">
                        
                        {{-- dropdown --}}
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Day
                            </button>
                            <div id="premium-select" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item">Month</a>
                                <a class="dropdown-item">Year</a>
                                <a class="dropdown-item">Day</a>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm">
                        <button class="btn btn-primary" id="buy-button">Buy</button>
                    </div>
                </div>
            </div>
            
            @if($user->premium)
            <?php
            foreach($user->premiumSignatures as $premiumSignature){
                $end = new DateTime($premiumSignature->startdate);
                $now = new DateTime(Carbon::now());
                date_add($end, date_interval_create_from_date_string($premiumSignature->duration));
                if($end >= $now){
                    $end = Carbon::parse($end->format('Y-m-d'));
                    $years = $end->diffInYears($now);
                    $days = $end->subYears($years)->diffInDays($now);
                    $hours = $end->subDays($days)->diffInHours($now);
                    $minutes = $end->subHours($hours)->diffInMinutes($now);
                    break;
                }
            } ?>
            
            <div class="premium">
                <span class="octicon octicon-star"></span>
                <strong>{{$years}}y {{$days}}d {{$hours}}h {{$minutes}}m</strong>
                <strong>Premium</strong>
            </div>
            
            @endif
        </div>
    </div>
</div>
@endsection
