@extends('layout')
@section('content')

<div id="CustomerController">

  <table class="table table-hover table-striped">
    <thead>
      <th>Id</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th colspan="2"><button v-if="!active" class="btn btn-success center-block" @click.prevent="toggle">Modify</button>
        <button v-else class="btn btn-danger center-block" @click.prevent="toggle">Done</button></th>
      </thead>
      <tbody>
      <div class="input-group">
        <tr v-for="customer in customers">
          <td>@{{ customer.id }}</td>
          <td><input :value='customer.name' type='text' :disabled="disabled == 1 ? true : false"  class="form-control" v-el:@{{customer.name}} > </td>
          <td><input :value='customer.email' type='text' disabled class="form-control "></td>
          <td><input :value='customer.phone' type='text' disabled  class="form-control "></td>
          <td>
          <a href="#"   @click.prevent="editCustomer(customer)" v-show="active" ><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
         
          <td><a href="#"   @click.prevent="deleteCustomer(customer)" v-show="active"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a></td>


          
        </tr>
        <div>
      </tbody>
    </table>
    <div class="pull-right">
      <button v-show="active" class="btn btn-success" @click.prevent="editCustomer(customer)">Add New</button>

    </div>
  </div>

  @endsection
  @section('scripts')

  <script>
   //Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
   Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value'); 

    var vm = new Vue({
      el: '#CustomerController',

      data:{
       customers: [],
       active: false,
       disabled: 1,
       customer_id:'',
       customer: ''

     },

     methods: {
      fetchCustomer: function(){
        this.$http.get('api/customers').then(function(response) {
          this.$set('customers',response.data);
        },function(response){ 

        });

      },

      toggle: function () {
        this.active = !this.active;
      },

      deleteCustomer: function(customer){
        //ConfrimDelete=confrim("are you sure?????"); 
           ConfrimDelete=true; 
        if (ConfrimDelete) {
        this.$http.delete('api/customer/'+customer.id).then((response) => {
                    this.fetchCustomer();
           // toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
         });
      }
      },    

      editCustomer: function(customer){
       // this.edit=!this.edit; 
        //this.disabled=(this.disabled+1)%2;
        console.log(customer.name); 
        var name=customer.name
       console.log(this.$els.name);
       console.log(this.$el); 


      },

    },


    ready:function(){
      this.fetchCustomer();
    }



/*
mounted:functin(){
  this.$nextTick(function(){
    this.fetchCustomer(); 
  })

}

*/
});

</script>
@endsection