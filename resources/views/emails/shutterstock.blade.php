<div>
  <h1>Hey, look at this photos</h1>
  <ul>
    @foreach($images as $image)
      <li><a href="{{ $image }}">{{ $image }}</a></li>
    @endforeach
  </ul>
</div>