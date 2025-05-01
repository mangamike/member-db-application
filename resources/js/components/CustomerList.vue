<template>
    <div>
      <h1>Customers</h1>
      <router-link to="/new">Add Customer</router-link>
      <table border="1">
        <thead>
          <tr>
            <th>Name</th><th>Email</th><th>Phone</th><th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="customer in customers" :key="customer.customer_id">
            <td>{{ customer.name }}</td>
            <td>{{ customer.email }}</td>
            <td>{{ customer.phone }}</td>
            <td>
              <router-link :to="`/edit/${customer.id}`">Edit</router-link>
              <button @click="deleteCustomer(customer.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  
  const customers = ref([]);
  
  const fetchCustomers = async () => {
    const { data } = await axios.get('/api/customers');
    customers.value = data;
  };
  
  const deleteCustomer = async (id) => {
    if (confirm('Delete this customer?')) {
      await axios.delete(`/api/customers/${id}`);
      fetchCustomers();
    }
  };
  
  onMounted(fetchCustomers);
  </script>
  