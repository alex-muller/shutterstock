<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shutterstock</title>
</head>
<body>
<div id="app">
  <app></app>
</div>
<script>
  var shutterKey = '{{ $key }}';
  var shutterSecret = '{{ $secret }}';
</script>
<script src="/js/app.js"></script>
</body>
</html>
