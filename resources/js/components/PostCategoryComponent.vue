<template>
<div>
  <h1>{{ category.title }}</h1>
<post-list-default 
:key = "currentPage"
@getCurrentPage="getCurrentPage"
v-if="total > 0" 
:posts="posts" 
:pCurrentPage="currentPage"
:total="total"></post-list-default> </div>
  
</template>
<script>
export default {
    created(){
      this.getPosts();
    }, 
    methods: {
        postClick: function(p){
            this.postSeleted = p;
            $("#postModal").modal("show");
        },
        getPosts(){
            console.log("______" + "this.$route.params.category_id");

          fetch("api/post/" + this.$route.params.category_id+ "/category?page="+this.currentPage)
            .then(response => response.json())
            .then(json => {
             this.posts = json.data.posts.data;
             this.total = json.data.posts.last_page;
             this.category = json.data.category;
            
            });
    

          /*fetch('/api/post')
          .then(function(response){
            return response.json();
           
          })
          .then(function(json){
            this.posts = json.data.data;
            console.log(json.data.data[0].title);
          })*/
        },
       getCurrentPage: function(val){
      console.log("ESTE FUNCIONA Y EL OTRO NO CUANDO ESTE ERA COPIAR Y PEGAR DEL OTRO ");
     // console.log("Post list + current page:" + currentPage);
      this.currentPage = val
      this.getPosts();
    }
    },

 
    data: function () {
      return {
        postSelected: "",  
        posts:[],
        total:0,
        category:"",
        currentPage:1
      };
    }
}
</script>