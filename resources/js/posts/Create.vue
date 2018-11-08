<template>
<div class="row">
    <div class="col-sm-12">
        <div class="card shadow p-3 mb-5 bg-white rounded">
            <h5 class="card-header">Let's create new post</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-10 col-lg-8">
                        <form @submit.prevent="saveForm()" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" v-model="post.title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Content</label>
                                    <wysiwyg  v-model="post.content" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <input type="file" @change="onImageChange" accept="image/*">
                                </div>
                                <div class="form-group" v-if="post.image.length > 0">
                                    <img class="preview" :src="post.image">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">YouTube Video ID: https://www.youtube.com/watch?v=<span class="badge badge-dark">ThisIsYouId</span></label>
                                    <input type="text" v-model="post.video" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-dark">Create</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</template>

<style>
    img.preview {
        width: 200px;
        background-color: white;
        border: 1px solid #DDD;
        padding: 5px;
    }
</style>

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
                let app = this;
                let newPost = app.post;
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
