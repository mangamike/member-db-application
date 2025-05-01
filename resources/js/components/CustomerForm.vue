<template>
    <div>
      <h1>{{ isEdit ? 'Edit Customer' : 'New Customer' }}</h1>
      <form @submit.prevent="saveCustomer">
        <div><label>Name: <input v-model="customer.name" required /></label></div>
        <div><label>Address 1: <input v-model="customer.address1" required /></label></div>
        <div><label>Address 2: <input v-model="customer.address2" /></label></div>
        <div><label>City: <input v-model="customer.city" required /></label></div>
        <div><label>State: <input v-model="customer.state" required /></label></div>
        <div><label>Zip: <input v-model="customer.zip" required /></label></div>
        <div><label>Phone: <input v-model="customer.phone" required /></label></div>
        <div><label>Email: <input type="email" v-model="customer.email" required /></label></div>
        <div>
          <label>Business Type:
            <select v-model="customer.business_type" required>
              <option>Corporation</option>
              <option>LLC</option>
              <option>Sole Proprietor</option>
              <option>Other</option>
            </select>
          </label>
        </div>
        <div>
          <label>Preferred Days:</label><br/>
          <label v-for="d in days" :key="d">
            <input type="checkbox" :value="d" v-model="customer.preferred_days" /> {{ d }}
          </label>
        </div>
        <button type="submit">Save</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRoute, useRouter } from 'vue-router';
  
  const route = useRoute();
  const router = useRouter();
  const isEdit = route.params.id !== undefined;
  const days = ['M', 'T', 'W', 'R', 'F'];
  
  const customer = ref({
    name: '', address1: '', address2: '', city: '', state: '',
    zip: '', phone: '', email: '', business_type: 'Corporation', preferred_days: []
  });
  
  onMounted(async () => {
    if (isEdit) {
      const { data } = await axios.get(`/api/customers/${route.params.id}`);
      customer.value = data;
    }
  });
  
  const saveCustomer = async () => {
    if (isEdit) {
      await axios.put(`/api/customers/${route.params.id}`, customer.value);
    } else {
      await axios.post('/api/customers', customer.value);
    }
    router.push('/');
  };
  </script>
  