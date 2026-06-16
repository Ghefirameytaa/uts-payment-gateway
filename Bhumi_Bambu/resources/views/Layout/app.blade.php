<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <title>@yield('title','Bhumi Bambu Baturraden')</title>
</head>
<body>

  @include('partials.header')

  @if (session('success'))
      <div style="background-color: #d4edda; color: #155724; padding: 15px; margin: 20px auto; max-width: 1240px; border-radius: 8px; border: 1px solid #c3e6cb; text-align: center; font-weight: 500;">
          {{ session('success') }}
      </div>
  @endif

  @if (session('error'))
      <div style="background-color: #f8d7da; color: #721c24; padding: 15px; margin: 20px auto; max-width: 1240px; border-radius: 8px; border: 1px solid #f5c6cb; text-align: center; font-weight: 500;">
          {{ session('error') }}
      </div>
  @endif

  @yield('content')

  @include('partials.footer')

</body>
</html>