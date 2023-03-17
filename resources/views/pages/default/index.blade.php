@extends('pages.layout.body')

@section('body')
<style>
    body {
        height: calc(100vh - 8em);
        padding: 4em;
        background-color: rgb(25, 25, 25);
    }

    .line-1 {
        color: rgba(255, 255, 255, .75);
        font-family: 'Anonymous Pro', monospace;
        position: relative;
        top: 50%;
        margin: 0 auto;
        text-align: center;
    }
</style>
<p class="line-1 anim-typewriter" id="messageArea"></p>

@endsection