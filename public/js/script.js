var vm = new Vue({
    el: '#CustomerController',

  data:{
   customers: [],
   message: "hello tricky!"
 },

    methods: {
      fetchUser: function(){
          this.$http.get('api/customers').then(function(response) {
              this.$set('customers', response.data )

          });
      }
    },

 ready: function(){
        this.fetchUser();
        }
});