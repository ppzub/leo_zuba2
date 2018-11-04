<template>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-default">
            <div class="card-header">Let's create new post</div>

            <div class="card-body">
              <form @submit.prevent="saveForm()" enctype="multipart/form-data">
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
                            <input type="file" @change="onImageChange" accept="image/*">
                        </div>
                        <div class="col-xs-12 form-group" v-if="post.image.length > 0">
                            <img class="preview" :src="post.image">
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
            onImageChange(event){
                var input = event.target;
                // Ensure that you have a file before attempting to read it
                if (input.files && input.files[0]) {
                    // create a new FileReader to read this image and convert to base64 format
                    var reader = new FileReader();
                    // Define a callback function to run, when FileReader finishes its job
                    reader.onload = (e) => {
                        // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                        // Read image as base64 and set to imageData
                        this.post.image = e.target.result;
                    }
                    // Start the reader job - read file as a data url (base64 format)
                reader.readAsDataURL(input.files[0]);
                }

            },
            saveForm() {
                var app = this;
                var newPost = app.post;

                axios.post('/posts', newPost)
                    .then(function (resp) {
                        app.$router.push({name: 'dashboard'});
                    })
                    .catch(function (resp) {
                        console.log(resp.data);
                        alert("Could not create your post");
                    });
            }
        }
    }


</script>
<style>
img.preview {
    width: 200px;
    background-color: white;
    border: 1px solid #DDD;
    padding: 5px;
}
</style>