<template>
<div class="row">
    <div class="col-sm-12">

        <div class="card shadow p-3 mb-5 bg-white rounded" v-if="postLoadStatus == 2 || ( postLoadStatus != 2 && ( postLikeActionStatus == 1 || postLikeActionStatus == 2 || postUnlikeActionStatus == 1 || postUnlikeActionStatus == 2 ) )">
          <h5 v-if="item" class="card-header">{{ item.title }}</h5>
          <div class="card-body">
            <toggle-like v-if="$auth.check()"></toggle-like>
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
            <comments></comments>
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

  import ToggleLike from '../components/ToggleLike';
  import Comments from '../components/Comments';
  export default {

    /*
      Defines the components used by the page.
    */
    components: {
      'toggle-like': ToggleLike,
      'comments': Comments
    },
    /*
      When created, load the post based on the ID in the
      route parameter.
    */

    created(){
      this.$store.dispatch('loadPost', {
        id: this.$route.params.id
      });
    },
    /*
      Defines what to watch in the component.
    */
    watch: {
      /*
        When the route changes, we clear the like and unlike
        status and load the new post.
      */
      '$route.params.id': function(){
        this.$store.dispatch('clearLikeAndUnlikeStatus');
        this.$store.dispatch('loadPost', {
          id: this.$route.params.id
        });
        },
    },
    /*
      Defines the computed variables on the post.
    */
    computed: {
      /*
        Determines if the post is liked or not.
      */
      liked(){
        return this.$store.getters.getPostLikedStatus;
      },
      /*
        Gets the like post action status.
      */
      postLikeActionStatus(){
        return this.$store.getters.getPostLikeActionStatus;
      },
      /*
        Gets the unlike post action status
      */
      postUnlikeActionStatus(){
        return this.$store.getters.getPostUnlikeActionStatus;
      },
      /*
        Grabs the post from the Vuex state.
      */
      item(){
        return this.$store.getters.getPost;
      },

      postLoadStatus(){
        return this.$store.getters.getPostLoadStatus;
      },
    }
  }
</script>
