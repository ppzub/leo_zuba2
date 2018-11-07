<template>
  <div class="container">
    <h4>Add Comment</h4>
    <form @submit.prevent="edit ? editComment(comment.id) : createComment()">
      <div class="input-group">
        <textarea name="body" v-model="comment.body" ref="textarea"  class="form-control"></textarea>
      </div>
        <div class="input-group">
          <button type="submit" class="btn btn-dark" v-show="!edit">Add Comment</button>
          <button type="submit" class="btn btn-dark" v-show="edit">Edit Comment</button>
        </div>
    </form>
    <h4>Comments</h4>
      <ul class="list-group">
        <li class="list-group-item" v-for="comment in comments">
          {{comment.body}}
          <a class="btn btn-primary" v-on:click=" showComment(comment.id)">Edit</a>
          <a class="btn btn-danger" v-on:click=" deleteComment(comment.id)">Delete</a>
        </li>
      </ul>
  </div>
</template>

<script>
  export default{
    data() {
      return {
        edit:false,
        comments:{},
        comment: {
          id:'',
          body: ''
        },
      }
    },


  mounted() {
    this.fetchComments();
  },

  methods: {
    fetchComments() {
      let c = this;
      axios.get('/post/' + this.$route.params.id + '/comments')
        .then(function (response){
          c.comments = response.data.data;
      });
    },

    createComment() {
      let c = this;
      axios.post('/post/' + this.$route.params.id + '/comments', c.comment)
        .then( function (response){
          c.comment.body = '';
          c.fetchComments();
      });
    },

    editComment(comment_id) {
      let c = this;
      axios.put('/post/' + this.$route.params.id + '/comments/' + comment_id, c.comment)
        .then( function (response){
          c.comment.body = '';
          c.comment.id = '';
          c.fetchComments();
          c.edit = false;
      });
    },

    deleteComment(comment_id) {
      let c = this;
      axios.delete('/post/' + this.$route.params.id + '/comments/' + comment_id)
        .then( function (response){
          c.comment.body = '';
          c.fetchComments();
      });
    },

    showComment(comment_id) {
      let c = this;
      for (var i = 0; i < c.comments.length; i++) {
        if (c.comments[i].id == comment_id) {
          c.comment.body = c.comments[i].body;
          c.comment.id = c.comments[i].id;
          c.edit = true;
        }
      }
    }
  }
}
</script>