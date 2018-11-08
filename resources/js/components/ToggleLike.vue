
<template >
  <div class="my-margin-bottom">
    <span v-on:click="likePost( item.id )" v-if="!liked && postLoadStatus == 2 && postLikeActionStatus != 1 && postUnlikeActionStatus != 1">
      	<i class="fas fa-thumbs-up my-cursor"></i>
    </span>
    <span v-on:click="unlikePost( item.id )" v-if="liked && postLoadStatus == 2 && postLikeActionStatus != 1 && postUnlikeActionStatus != 1">
  		<i class="fas fa-thumbs-down my-cursor" alt="Unlike"></i>
	</span>
	<span>
      &nbsp;{{ item.likes_count }} &nbsp;likes
	</span>
  </div>
</template>

<style>
  .my-cursor {
    cursor: pointer;
    font-size: 2rem;
  }
  .my-margin-bottom {
    margin-bottom: 10px;
  }
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