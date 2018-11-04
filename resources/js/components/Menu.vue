<template>
<div class="row">
  <div class="col-sm-12">
    <nav id="nav" class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <router-link :to="{name: 'home'}" class="nav-link">Home</router-link>
            </li>
            <!--UNLOGGED-->
            <li v-if="!$auth.check()" v-for="(route, key) in routes.unlogged" v-bind:key="route.path" class="nav-item">
                <router-link  :to="{ name : route.path }" :key="key" class="nav-link">
                    {{route.name}}
                </router-link>
            </li>
            <!--LOGGED USER-->
            <li v-if="$auth.check()" v-for="(route, key) in routes.user" v-bind:key="route.path" class="nav-item">
                <router-link  :to="{ name : route.path }" :key="key" class="nav-link">
                    {{route.name}}
                </router-link>
            </li>
          </ul>

        </div>
        <span v-if="$auth.check()" class="navbar-text text-white">Привіт {{$auth.user().name}}!!!</span>
        <ul class="navbar-nav mr-auto">
            <!--LOGOUT-->
            <li v-if="$auth.check()" class="nav-item">
                <a href="#" @click.prevent="$auth.logout()" class="nav-link">Logout</a>
            </li>
        </ul>
    </nav>
  </div>
</div>
</template>

<script>

  export default {
    data() {
      return {
        routes: {
          // UNLOGGED
          unlogged: [
            {
              name: 'Register',
              path: 'register'
            },
            {
              name: 'Login',
              path: 'login'
            }
          ],

          // LOGGED USER
          user: [
            {
              name: 'Адмін-панель',
              path: 'dashboard'
            },
            {
              name: 'Створити новий пост',
              path: 'postcreate'
            }
          ],
        }
      }
    }
  }
</script>
