
<template>
  <span class="toggle-like">
    <span class="like" v-on:click="likePost( item.id )" v-if="!liked && postLoadStatus == 2 && postLikeActionStatus != 1 && postUnlikeActionStatus != 1">
      	Like
    </span>
    <span class="un-like" v-on:click="unlikePost( item.id )" v-if="liked && postLoadStatus == 2 && postLikeActionStatus != 1 && postUnlikeActionStatus != 1">
  		Un-like
	</span>
	<span class="like-count">
      {{ item.likes_count }} likes
	</span>
  </span>
</template>

<style>

</style>

<script>
  export default {

    methods: {
        likePost( id ){
          this.$store.dispatch('likePost', {
            id: this.item.id
          });
        },
        unlikePost( id ){
		  this.$store.dispatch('unlikePost', {
		    id: this.item.id
		  });
		}
    },
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