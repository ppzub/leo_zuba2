<template>
  <div class="container">
        <div id="main">
            <header id="header">
                <h1 class="text-center">

                        Блог Single-page Application

                </h1>
                <navigationMenu></navigationMenu>
            </header>
        </div>

        <div id="content">
            <router-view></router-view>
        </div>
  </div>
</template>

<script>
  import navigationMenu from './components/Menu.vue'
  export default {
    data() {
      return {
        //
      }
    },
    components: {
      navigationMenu
    }
  }
</script>

