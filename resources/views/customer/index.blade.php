<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Index Customer</title>
    </head>
    <body>
        <div class = 'container'>
        <div id="app">
          <h1>Vue api index </h1>
          <example></example>
        </div>
          <hr>
            <h1>Customer  Index</h1>
         <table class="table table-striped table-bordered">
         	<thead>
         		<th>name</th><th>email</th><th>phone</th>

         	</thead>
         	<tbody>
         	@foreach($customers as $customer )
         		<tr>
         			<td>{{$customer->name}}</td>
         			<td>{{$customer->email}}</td>
         			<td>{{$customer->phone}}</td>
         		</tr>
         		@endforeach
         	</tbody>
         </table>
          {!! $customers->links()!!}
         </div>


            </body>


            </html>

