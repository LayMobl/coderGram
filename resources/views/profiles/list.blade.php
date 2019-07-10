<div class="pt-2 text-center">
    <h2>New users you might like:</h2>
    <ul class="d-flex list-unstyled pt-3">
        @foreach($users as $user)
           <li>
               <a href="{{url('profile/' . $user->id)}}">
                   <img src="{{asset($user->profile->profileImage())}}" class="rounded-circle w-25">
               </a>
               <div>{{$user->profile->title}}</div>
           </li>
        @endforeach
    </ul>
</div>
