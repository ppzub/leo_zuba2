<template>
  <div class="row">
    <div class="col-sm-12">
        <div class="card shadow p-3 mb-5 bg-white rounded">
          <h5 class="card-header">Адмінка</h5>
          <div class="card-body">
            <div class="table-responsive-md">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Image</th>
                    <th scope="col">Video</th>
                    <th scope="col font-italic">ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="p, index in uposts">
                    <th scope="row">{{p.id}}</th>
                    <td>{{p.title}}</td>
                    <td><p v-html="p.content"></p></td>
                    <td><img :src="p.image" class="img-fluid rounded"></td>
                    <td>
                      <div>
                        <iframe width="150" height="85" :src="p.video"></iframe>
                      </div>
                    </td>
                    <td>
                      <router-link :to="{ name: 'postedit', params: { id: p.id }}">
                        <i class="fas fa-edit my-font-size my-margin-bottom"></i>
                      </router-link><br>
                      <a href="#" v-on:click="deletePost(p.id, index)">
                        <i class="fas fa-trash-alt my-font-size"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>


          </div>
        </div>
    </div>
  </div>
</template>

<style>
  .my-font-size {
    font-size: 2rem;
  }
  .my-margin-bottom {
    margin-bottom: 10px;
  }
</style>
<script>

  export default {
    data() {
      return {
        uposts: {}
      }
    },
  methods: {
              deletePost(id, index) {
                  if (confirm("Дійсно видалити цей пост?")) {
                      var app = this;
                      axios.delete('/posts/' + id)
                          .then(function (resp) {
                              app.uposts.splice(index, 1);
                          })
                          .catch(function (resp) {
                              alert("Could not delete company");
                          });
                  }
              }
            },
    mounted() {
        let app = this;
        axios.get('/auth/dashboard')
            .then(function (resp) {
                app.uposts = resp.data.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Could not load user's posts");
            });
    }
  }
</script>