<select class="user_option" name="user_assign" style="height:29px">
    @foreach($user_assign as $key => $u)
        <option value="{{$u->id}}">{{$u->name}}</option>
    @endforeach
</select>
