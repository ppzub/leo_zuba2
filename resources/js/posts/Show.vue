<template>
<div class="row">
    <div class="col-sm-12">

        <div class="card shadow p-3 mb-5 bg-white rounded">
          <h5 v-if="item" class="card-header">{{ item.title }}</h5>
          <div class="card-body">

            <div class="my-margin-bottom">
                <img v-if="item" :src="item.image" class="img-fluid rounded float-left my-margin">
                <div>
                    <div v-if="item" class="font-italic text-right">{{ item.date }}</div>
                    <p v-if="item" class="card-text" v-html="item.content"></p>
                </div>
            </div>
            <div class="embed-responsive embed-responsive-16by9 my-margin-bottom">
                <iframe v-if="item" class="embed-responsive-item" :src="item.video" allowfullscreen></iframe>
            </div>
            <div>
                <div v-if="item" class="font-italic font-weight-bold text-right">Автор статті: {{ item.author }}</div>
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
        item: {}
      }
    },

    mounted() {
        let app = this;
        axios.get('/posts/' + app.$route.params.id)
            .then(function (resp) {
                app.item = resp.data.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Could not load this post");
            });
    }
  }
</script>