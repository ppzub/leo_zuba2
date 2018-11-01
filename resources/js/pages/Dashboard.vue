<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Dashboard</div>

            <div class="card-body">

                <router-link  :to="{ name : 'postcreate' }">
                    Create new post
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>

  export default {
    data() {
      return {
        //
      }
    },
    components: {
      //
    }
  }
</script>