<a href="{{ url('profile/'.$user->iduser) }}">
    <div class="card user-card">
        <img src="{{ asset('img/profile_pic.png')}}" class="card-img-top" alt="Profile Picture">
        <div class="card-body">
            <h5 class="card-title text-center">{{$user->username}}</h5>
        </div>
    </div>
</a>