var vm = new Vue({
    el: '#CustomerController',

  data:{
   customers: []
 },

 methods:{
     fetchUser: function(){
          this.$http.get('api/customers').then(function(response){
                this.$set('customers', response.data);
          }, function(response){
              // error callback
          });
 },

 ready: function(){
        this.fetchUser();
        }
});