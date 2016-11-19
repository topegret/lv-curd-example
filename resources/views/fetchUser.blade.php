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
        <button v-else class="btn btn-danger center-block" @click.prevent="toggle" id="done" >Done</button></th>
      </thead>
      <tbody>
      <div class="input-group">
        <tr v-for="customer in customers">
          <td>@{{ customer.id }}</td>
          <td><input :value='customer.name' type='text' disabled  class="form-control" v-model='customer.name' name="name":id="customer.id+'_name'" > </td>
          <td><input :value='customer.email' type='text' disabled class="form-control " v-model='customer.email' name="email":id="customer.id+'_email'"></td>
          <td><input :value='customer.phone' type='text' disabled  class="form-control " v-model='customer.phone' name="phone":id="customer.id+'_phone'"></td>
          <td>
          <a href="#"   @click.prevent="editCustomer(customer)" v-show="active" title="Edit"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true" :id="customer.id+'_edit'"></i></a>
          <a href="#"   @click.prevent="updateCustomer(customer)"  v-show="active"  id="update-save"  title="Save"><i class="fa fa-floppy-o fa-2x" aria-hidden="true" style="display:none; color:green" :id="customer.id+'_save'"></i></a>
         
          <td><button   @click.prevent="deleteCustomer(customer)" v-show="active"  title="Delete" id="trash" ><i class="fa fa-trash fa-lg" aria-hidden="true" style="color:red"></i></button></td>


          
        </tr>
        <tr v-if="addNew">
          <td></td>
          <td><input type="text" name="name" id="new_name" v-model="newCustomer.name" class="form-control" ></td>
          <td><input type="text" name="email" id="new_email" v-model="newCustomer.email" class="form-control" ></td>
          <td><input type="text" name="phone" id="new_phone"  v-model="newCustomer.phone" class="form-control"></td>

          <td colspan="2'"><button  class="btn btn-danger center-block"  @click.prevent="createCustomer(newCustomer)"   id="new-save" >Save</button></td>
          
        </tr>
        </div>
      </tbody>
    </table>
    <div class="pull-right">
      <button v-show="active" class="btn btn-success" @click.prevent="preAddNew()" id="add_new">Add New</button>

    </div>


   </div>

  @endsection
  @section('scripts')

  <script>
   //Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
   Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
   //Vue.http.options.root = '/root';
   //Vue.http.headers.common['X-CSRF-TOKEN'] = 'Basic YXBpOnBhc3N3b3Jk';
   //Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
  // Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value'); 
   var saved=0;

    var vm = new Vue({
      el: '#CustomerController',

      data:{
       customers: [],
       active: false,
       //disabled: 1,
       //customer_id:'',
       //customer: {'id':'', 'name':'','email':'','phone':''},
       
       addNew: false, 

       newCustomer: {'name':'','email':'','phone':''},
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
       
        //console.log(customer.name); 
        //console.log(document.getElementById(customer.id+'_name'));
        document.getElementById(customer.id+'_name').disabled=false;
         document.getElementById(customer.id+'_email').disabled=false;
          document.getElementById(customer.id+'_phone').disabled=false;
        $('#'+customer.id+'_edit').hide();
        $('#'+customer.id+'_save').show();
        document.getElementById('done').disabled=true; 
        document.getElementById('add_new').disabled=true;
        document.getElementById('trash').disable=true;
        //$('#done').preventDefault();
        //console.log(saved);
        saved++;
             

   

      },
       
       preAddNew: function(){
          this.addNew=true; 
          $('#add_new').hide(); 
          //var customer = {'name':'Ldfdt111', 'email':'tf11@qewe.com', 'phone':'787899770'};
             //console.log(customer);
            // this.$http.post('api/customer', customer);
              this.fetchCustomer(); 
            /* */
       },
       createCustomer: function(customer){
         
          //var customer = {'name':'Ldfdt111', 'email':'tf11@qewe.com', 'phone':'787899770'};
            // console.log(customer.name);
           this.$http.post('api/customer', customer);
           this.fetchCustomer(); 
           this.addNew=!this.addNew; 
            $('#add_new').show(); 
            this.newCustomer={name:'',email:'',phone:''};
            /* */
       },
        
      updateCustomer: function(customer){
         //console.log(document.getElementById(customer.id+'_name'));
          document.getElementById(customer.id+'_name').disabled= true;
          document.getElementById(customer.id+'_email').disabled= true;
          document.getElementById(customer.id+'_phone').disabled= true;
        $('#'+customer.id+'_save').hide();
        $('#'+customer.id+'_edit').show(); 
        saved--; 
        if(saved==0) {
         document.getElementById('done').disabled=false; 
         document.getElementById('add_new').disabled=false; 
         document.getElementById('trash').disable=false;
                    }

          console.log(customer.id);
          console.log(customer.name);
          console.log(customer.email);
          console.log(customer.phone); 

          //user={name:'Luther',email:'1@ht.com',phone:'8998998'}
           var user=customer; 
          // customer=this.newCustomer; 
          this.$http.patch('api/customer/'+user.id,user).then((response) => { 

           console.log ("this is user name  "+user.name);

           //this.$http.post('api/customer', user); 
           this.fetchCustomer();
            });
         /*
         updateTask: function(id) {
                this.$http.patch('api/task/' + id, this.task)
                this.task.body = ''
                this.edit = false
                this.fetchTaskList()
            },
         */
         // this.fetchCustomer();

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