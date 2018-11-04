<template>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-default">
            <div class="card-header">TESTING</div>

            <div class="card-body">
                  <div v-for="post in posts">
                    {{ post.title }}<br>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>

  export default {
    data() {
      return {
        posts: []
      }
    },
    mounted() {
            var app = this;
            axios.get('/posts')
                .then(function (resp) {
                    app.posts = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load posts");
                });
        }
  }
</script>