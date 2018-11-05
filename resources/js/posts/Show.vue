<template>
<div class="row">
    <div class="col-sm-12">

        <div class="card shadow p-3 mb-5 bg-white rounded">
          <h5 v-if="post" class="card-header">{{ post.title }}</h5>
          <div class="card-body">

            <div class="my-margin-bottom">
                <img v-if="post" :src="post.image" class="img-fluid rounded float-left my-margin">
                <div>
                    <div v-if="post" class="font-italic text-right">{{ post.date }}</div>
                    <p v-if="post" class="card-text">{{ post.content }}</p>
                </div>
            </div>
            <div class="embed-responsive embed-responsive-16by9 my-margin-bottom">
                <iframe v-if="post" class="embed-responsive-item" :src="post.video" allowfullscreen></iframe>
            </div>
            <div>
                <div v-if="post" class="font-italic font-weight-bold text-right">Автор статті: {{ post.author }}</div>
            </div>
          </div>
        </div>
    </div>
</div>
</template>
<style>
    .my-margin {
        margin-bottom: 10px;
        margin-right: 30px;
    }
    .my-margin-bottom {
        margin-bottom: 20px;
    }
</style>
<script>

  export default {
    data() {
      return {
        post: {}
      }
    },

    mounted() {
        var app = this;
        axios.get('/posts/' + app.$route.params.id)
            .then(function (resp) {
                app.post = resp.data.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Could not load this post");
            });
    }
  }
</script>