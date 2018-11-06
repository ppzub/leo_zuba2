<template>
  <div class="container">
        <div id="main">
            <header id="header">
                <h1 class="text-center my-margin-top">

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

<style>
  .my-margin-top {
    margin-top: 30px;
  }
</style>
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

