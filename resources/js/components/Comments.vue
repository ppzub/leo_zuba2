<template>
  <div>
    <div class="row" v-if="$auth.check()">
      <div class="col-sm-6">
        <h4>Залиште коментар</h4>
        <form @submit.prevent="edit ? editComment(comment.id) : createComment()">
          <div class="form-group">
            <textarea name="body" v-model="comment.body" ref="textarea"  class="form-control"></textarea>
          </div>
            <div class="form-group">
              <button type="submit" class="btn btn-dark" v-show="!edit">Коментувати</button>
              <button type="submit" class="btn btn-dark" v-show="edit">Редагувати</button>
            </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-8">
        <h4>Коментарі:</h4>
        <ul class="list-group">
          <li class="list-group-item" v-for="(comment, index) in comments">
            <span class="font-italic">{{users[index].name}}:</span><br>
            {{comment.body}}
            <span v-if="$auth.user().id == users[index].id" class="float-right">
              <a href="#" v-on:click.prevent=" showComment(comment.id)"><i class="fas fa-highlighter my-font-size my-margin-left"></i></i></a>
              <a href="#" v-on:click.prevent=" deleteComment(comment.id)"><i class="fas fa-times my-font-size my-margin-left"></i></a>
            </span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style>
  .my-font-size {
    font-size: 2rem;
  }
  .my-margin-left {
    margin-left: 10px;
  }
</style>

<script>
  export default{
    data() {
      return {
        main: [],
        edit:false,
        users: [],
        comments:[],
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
          c.main = response.data.data;
          c.comments = [];
          c.users = [];
          for (var i = 0; i < c.main.length; i++) {
              c.comments.push({id: c.main[i].id, body: c.main[i].body});
              c.users.push({id: c.main[i].user_id, name: c.main[i].user_name});
            }
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