@extends('layouts.app')

@section('title', 'Faq')

@section('content')

<div id="faq" class="container-fluid">
    <h1 class="text-center">F.A.Q.</h1>
    <div class="container faq-content text-center">
        <p>Frequently Asked Questions</p>

        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Cras justo odio?
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Est lorem ipsum dolor sit amet. Magna eget est lorem ipsum dolor sit amet consectetur adipiscing. Quis vel eros donec ac odio. Non curabitur gravida arcu ac tortor. Lobortis elementum nibh tellus molestie nunc non blandit massa. Urna condimentum mattis pellentesque id nibh tortor id. Libero id faucibus nisl tincidunt eget. Tempus urna et pharetra pharetra massa massa ultricies mi quis. Pharetra pharetra massa massa ultricies mi quis hendrerit dolor magna. Id venenatis a condimentum vitae sapien.
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Dapibus ac facilisis in?
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Est lorem ipsum dolor sit amet. Magna eget est lorem ipsum dolor sit amet consectetur adipiscing. Quis vel eros donec ac odio. Non curabitur gravida arcu ac tortor. Lobortis elementum nibh tellus molestie nunc non blandit massa. Urna condimentum mattis pellentesque id nibh tortor id. Libero id faucibus nisl tincidunt eget. Tempus urna et pharetra pharetra massa massa ultricies mi quis. Pharetra pharetra massa massa ultricies mi quis hendrerit dolor magna. Id venenatis a condimentum vitae sapien.
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Morbi leo risus?
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Est lorem ipsum dolor sit amet. Magna eget est lorem ipsum dolor sit amet consectetur adipiscing. Quis vel eros donec ac odio. Non curabitur gravida arcu ac tortor. Lobortis elementum nibh tellus molestie nunc non blandit massa. Urna condimentum mattis pellentesque id nibh tortor id. Libero id faucibus nisl tincidunt eget. Tempus urna et pharetra pharetra massa massa ultricies mi quis. Pharetra pharetra massa massa ultricies mi quis hendrerit dolor magna. Id venenatis a condimentum vitae sapien.
                </div>
            </div>
        </div>
    </div>
    <ol class="list-group faq-questions">
    </ol>
</div>

@endsection
