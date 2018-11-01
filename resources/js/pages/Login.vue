<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Login page</div>

            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error">
                    <p>Помилка, не вдається з'єднатися з цими обліковими даними.</p>
                </div>
                <form autocomplete="off" @submit.prevent="login" method="post">

                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                        <span class="help-block" v-if="has_error && errors.email">{{ errors.email }}</span>
                    </div>

                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" v-model="password" required>
                        <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>
                    </div>
                    <button type="submit" class="btn btn-default">Login</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        email: null,
        password: null,
        has_error: false
      }
    },

    mounted() {
      //
    },

    methods: {
      login() {
        var app = this
        this.$auth.login({
          params: {
            email: app.email,
            password: app.password
          },
          success: function() {
            this.$router.push({name: 'dashboard'})
          },
          error: function() {
            app.has_error = true
          },
          rememberMe: true,
          fetchUser: true
        })
      }
    }
  }
</script>