<template>
    <div class="container">
      <div class="form-group">
            <router-link :to="{ name : 'dashboard' }" class="btn btn-default">Back</router-link>
        </div>
        <div class="card card-default">
            <div class="card-header">Let's create new post</div>

            <div class="card-body">
              <form @submit.prevent="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Title</label>
                            <input type="text" v-model="post.title" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Content</label>
                            <textarea v-model="post.content" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Image</label>
                            <input type="text" v-model="post.image" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">YouTube Video Link</label>
                            <input type="text" v-model="post.video" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                post: {
                    title: '',
                    content: '',
                    user_id: this.$auth.user().id,
                    image: '',
                    video: '',
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newPost = app.post;

                axios.post('/posts', newPost)
                    .then(function (resp) {
                        app.$router.push({name: 'dashboard'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your post");
                    });
            }
        }
    }


</script>