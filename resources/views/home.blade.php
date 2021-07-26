@extends('master')

@section('title',$page_title)


@section('content')
    <h1> Welcome </h1>
    <br>
    <h2>  
        Total Recylced Items :  {{ $recycled_total }}          
    <h2>
    <br>

    <br>
    
    @if (empty($current_user))

    <p> Login <p>
    <form action="/" method="post">
        <input type="text" name="username" placeholder="username">
        {{ csrf_field() }}
        <button type="submit">Submit</button>
    </form>
    @endif

    @if (! empty($current_user))

    <h3> Record Recycling </h3>
    <form action="/create" method="post">
        <input type="radio" id="paper" name="recycledItem" value="Paper">
        <label for="paper">Paper</label><br>
        <input type="radio" id="plastic_bottles" name="recycledItem" value="Plastic Bottles">
        <label for="plastic_bottles">Plastic Bottles</label><br>
        <input type="radio" id="metal_tin" name="recycledItem" value="Metal Tin">
        <label for="metal_tin">Metal Tin</label><br>
        {{ csrf_field() }}
        <input type='hidden' name='user_id' value="<?php echo $current_user->userid ?>"> 
        <button type="submit">Add Item </button>

    </form>
    <br>
    <h3> Recycled Items </h3>
    <p> {{ "Username " . $current_user->full_name }} </p>
    <ul style="list-style-type:none;">
    @foreach ($users_recycled_list as $items)
       <li> {{ $items->item_name . " " . $items->item_count }} </li>
    @endforeach
    </ul>
    @endif
@endsection