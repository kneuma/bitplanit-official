@extends('layouts.app')

@section('content')
        <div class="jumbotron" >
            <div class="align-center">
                <img src="/imgs/default-avatar.png" style="width:200px;"/>
            </div>
            <br />
               <div class="container" >

                  <form action="/profile/{{ $user->id }}" method="POST" >
                      <input type="hidden" name="_method" value="PUT"/>
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Username</label>
                                <input class="form-control" type="text" name="username" value="{{ $user->username }}" placeholder="Change Your Username?"/>

                        </div><!---End of form-group--->

                        <div class="form-group">
                            <label>Date of Birth</label>

                                <input class="form-control" type="date" name="birthday" value="{{ $user->birthday }}" placeholder="Your Birthday"/>

                        </div><!---End of form-group--->

                        <div class="form-group">
                            <label>Location</label>

                                <input class="form-control" name="location" value="{{ $user->location }}" placeholder="Your Location"/>

                        </div><!---End of form group--->
                        <br />

                        <div class="form-group">
                            <label>Occupation</label>

                                <input class="form-control" name="occupation" value="{{ $user->occupation }}" placeholder="Your Occupation"/>

                        </div><!---End of formgroup--->
                        <br />

                        <div class="form-group">
                            <label>Website</label>

                                <input class="form-control" name="website" value="{{ $user->website }}" placeholder="Your Website"/>

                        </div><!---End of form group--->
                        <br />


                        <div class="form-group">
                           <label>Bio</label>
                           <textarea class="form-control" name="bio" placeholder="Write Your Bio"/>{{ $user->bio }}</textarea>

                       </div><!---End of form group--->

                     <div class="form-group">

                         <button class="btn btn-primary" type="submit">Save Profile Info</button>

                     </div><!---End of form group--->

                 </form>

             </div><!---End of container--->
         </div><!---End of jumbotron--->

@endsection
