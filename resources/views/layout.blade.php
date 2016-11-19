<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
     <meta name="token" id="token" value="{{ csrf_token() }}">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>

    <div class="container">
      @yield('content')
    </div>

    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" charset="utf-8"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" charset="utf-8"></script>
    <!--<script src="https://unpkg.com/vue/dist/vue.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.js" charset="utf-8"></script>
    <!--<script src="https://unpkg.com/vue@1.0.2/dist/vue.js" charset="utf-8"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.min.js" charset="utf-8"></script>

    @yield('scripts')
  </body>
</html>