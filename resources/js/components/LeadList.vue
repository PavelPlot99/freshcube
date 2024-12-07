<template>
  <div class="container mt-4">
    <h1 class="mb-4">Выбор сделки</h1>
    <table class="table table-striped">
      <thead>
      <tr>
        <th>Название</th>
        <th>Сумма</th>
        <th>Дата создания</th>
        <th>Контакты</th>
        <th>Действия</th>
      </tr>
      </thead>
      <tbody>
      <template v-for="lead in leads">
        <tr>
          <td>{{lead.name}}</td>
          <td>{{lead.price}} руб.</td>
          <td>{{lead.created_at}}</td>
          <td>{{ lead.contacts.map(contact => contact.name).join(', ') }}</td>
          <td>
            <button class="btn btn-primary btn-sm" @click="goToContactBinding(lead.id)" :disabled="lead.contacts.length > 0">Привязать контакт</button>
          </td>
        </tr>
      </template>
      </tbody>
    </table>
  </div>
</template>

<script>
import {leadApiService} from '../services/LeadApiService.js'
export default {
  name: "LeadsList",
  data(){
    return {
      leads: []
    }
  },
  methods: {
    goToContactBinding(leadId){
      this.$router.push(`/lead/${leadId}`);
    },
  },
  async mounted() {
    const data = await leadApiService.getLeads();
    this.leads = data.data
  }
};
</script>

<style scoped>

</style>
