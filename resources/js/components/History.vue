<template>
  <div class="container mt-4">
    <h1 class="mb-4">История</h1>
    <ul class="list-group">
      <template v-for="log in logs">
        <li class="list-group-item">
          {{log.text}}
          <span class="text-muted float-end">{{log.created_at}}</span>
        </li>
      </template>

    </ul>
  </div>
</template>

<script>
import {logApiService} from '../services/LogApiService.js'
export default {
  name: "History",
  data(){
    return {
      logs: [],
    }
  },
  async mounted(){
    const data = await logApiService.getLogs()
    this.logs = data.data
  }
};
</script>

<style scoped>

</style>
