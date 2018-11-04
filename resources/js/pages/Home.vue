<template>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-default">
            <div class="card-header">TESTING</div>

            <div class="card-body">
                  <div v-for="post in posts">
                    {{ post.title }}<br>
                </div>
                <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="fetchPosts()"></pagination>
            </div>
        </div>
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