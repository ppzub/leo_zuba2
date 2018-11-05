<template>
<div class="row">
    <div class="col-sm-12">

        <div v-for="post in posts" class="card shadow p-3 mb-5 bg-white rounded">
          <h5 class="card-header">{{ post.title }}</h5>
          <div class="card-body">
            <span class="font-italic">{{ post.date }}</span>
            <div class="row">
                <div class="col-sm-4">
                    <img :src="post.image" class="img-fluid rounded">
                </div>
                <div class="col-sm-8">
                    <p class="card-text">{{ post.content }}</p>
                </div>
            </div>
            <div class="float-right"><router-link :to="{ name: 'postshow', params: { id: post.id }}">Читати далі</router-link></div>
          </div>
        </div>
        <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="fetchPosts()"></pagination>
    </div>
</div>
</template>
<script>

  export default {
    data() {
      return {
        posts: {},
        pagination: {'current_page': 1}
      }
    },
    methods: {
        fetchPosts() {
            var app = this;
            axios.get('/posts?page=' + app.pagination.current_page)
                .then(function (resp) {
                    app.posts = resp.data.data;
                    app.pagination = resp.data.meta;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load posts");
                });
        }
    },
    mounted() {
        this.fetchPosts();
    }
  }
</script>