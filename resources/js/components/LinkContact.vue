<template>
  <div class="container mt-4">
    <h1 class="mb-4">Привязать контакт для сделки: {{ lead?.name }}</h1>
    <form @submit.prevent="linkContact">
      <div class="mb-3">
        <label for="first_name" class="form-label">Контакт:</label>
        <input
            type="text"
            id="first_name"
            v-model="contactData.first_name"
            class="form-control"
            placeholder="Введите имя контакта"
            required
        />
        <div v-if="errors.first_name" class="text-danger">
          {{ errors.first_name[0] }}
        </div>
      </div>

      <div class="mb-3">
        <label for="last_name" class="form-label">Фамилия:</label>
        <input
            type="text"
            id="last_name"
            v-model="contactData.last_name"
            class="form-control"
            placeholder="Введите фамилию контакта"
            required
        />
        <div v-if="errors.last_name" class="text-danger">
          {{ errors.last_name[0] }}
        </div>
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">Телефон:</label>
        <input
            type="text"
            id="phone"
            v-model="contactData.phone"
            class="form-control"
            placeholder="Введите номер телефона контакта"
            required
        />
        <div v-if="errors.phone" class="text-danger">
          {{ errors.phone[0] }}
        </div>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Описание:</label>
        <input
            type="text"
            id="description"
            v-model="contactData.description"
            class="form-control"
            placeholder="Описание"
        />
        <div v-if="errors.description" class="text-danger">
          {{ errors.description[0] }}
        </div>
      </div>

      <button type="submit" :disabled="isLoading" class="btn btn-primary">Привязать</button>
    </form>

    <div v-if="generalError" class="alert alert-danger mt-3">
      {{ generalError }}
    </div>
  </div>
</template>

<script>
import { leadApiService } from "../services/LeadApiService.js";

export default {
  name: "LinkContact",
  data() {
    return {
      lead: null,
      isLoading: false,
      contactData: {
        first_name: "",
        last_name: "",
        phone: "",
        description: "Контакт из формы",
      },
      errors: {},
      generalError: "",
    };
  },
  methods: {
    async linkContact() {
      this.errors = {};
      this.generalError = "";
      this.isLoading = true;
      try {
        await leadApiService.linkContact(this.$route.params.id, this.contactData);
        window.Swal.fire("Контакт успешно привязан!");
        this.contactData = { first_name: "", last_name: "", phone: "", description: "Контакт из формы" };
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.errors = error.response.data.errors || {};
        } else {
          this.generalError = "Произошла ошибка при привязке контакта.";
        }
      } finally {
        this.isLoading = false;
      }
    },
  },
  async mounted() {
    try {
      const response = await leadApiService.showLead(this.$route.params.id);
      this.lead = response.data;
    } catch (error) {
      alert("Не удалось загрузить данные сделки.");
    }
  },
};
</script>

<style scoped>

</style>
