<template>
<div class="row">
    <div class="col-sm-12">
        <div class="card shadow p-3 mb-5 bg-white rounded">
            <h5 class="card-header">Register page</h5>

            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error && !success">
                    <p v-if="error == 'registration_validation_error'">Помилки валідації, будь ласка, зверніть увагу на повідомлення:</p>
                    <p v-else>Помилка, не можливо зареєструватися на даний момент. Якщо проблема не зникне, зв'яжіться з адміністратором.</p>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-6 col-lg-4">
                        <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">

                            <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.username }">
                                <label for="username">Name</label>
                                <input type="text" id="username" class="form-control" v-model="username">
                                <span class="help-block" v-if="has_error && errors.username">{{ errors.username }}</span>
                            </div>

                            <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email">
                                <span class="help-block" v-if="has_error && errors.email">{{ errors.email }}</span>
                            </div>

                            <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="form-control" v-model="password">
                                <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>
                            </div>

                            <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                                <label for="password_confirmation">Confirmation Password</label>
                                <input type="password" id="password_confirmation" class="form-control" v-model="password_confirmation">
                            </div>

                            <button type="submit" class="btn btn-dark">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        has_error: false,
        error: '',
        errors: {},
        success: false
      }
    },

    methods: {
      register() {
        var app = this
        this.$auth.register({
          data: {
            name: app.username,
            email: app.email,
            password: app.password,
            password_confirmation: app.password_confirmation
          },
          success: function () {
            app.success = true
            this.$router.push({name: 'home', params: {successRegistrationRedirect: true}})
          },
          error: function (res) {
            console.log(res.response.data.errors)
            app.has_error = true
            app.error = res.response.data.error
            app.errors = res.response.data.errors || {}
          }
        })
      }
    }
  }
</script>
