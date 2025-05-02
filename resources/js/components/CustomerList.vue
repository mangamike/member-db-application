<template>
  <div class="max-w-8xl mx-auto p-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6 ">
      <h1 class="text-3xl font-bold text-slate-700">DW Customer List</h1>
      <router-link
        to="/new"
        class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition"
      >
        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 4v16m8-8H4" />
        </svg>
        Add Customer
      </router-link>
    </div>

    <!-- Table or Empty State -->
    <div class="overflow-x-auto">
      <table
        v-if="customers.length"
        class="min-w-full bg-white border border-gray-200 rounded-lg shadow"
      >
        <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
          <tr>
            <th class="px-4 py-3 text-left">Name</th>
            <th class="px-4 py-3 text-left">Address</th>
            <th class="px-4 py-3 text-left">Email</th>
            <th class="px-4 py-3 text-left">Phone</th>
            <th class="px-4 py-3 text-left">Business Type</th>
            <th class="px-4 py-3 text-left">Prefered Days</th>
            <th class="px-4 py-3 text-left">Customer #</th>
            <th class="px-4 py-3 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="customer in customers"
            :key="customer.customer_id"
            class="border-t border-gray-200 hover:bg-gray-50 text-gray-700"
          >
            <td class="px-4 py-3">{{ customer.name }}</td>
            <td class="px-4 py-3">{{ customer.address1 }} {{ customer.address2 }} {{ customer.city }}, {{ customer.state }} {{ customer.zip }}</td>
            <td class="px-4 py-3" >{{ customer.email }}</td>
            <td class="px-4 py-3">{{ customer.phone }}</td>
            <td class="px-4 py-3">{{ customer.business_type }}</td>
            <td class="px-4 py-3">{{ customer.preferred_days.join(', ') }}</td>
            <td class="px-4 py-3">{{ customer.customer_id }}</td>
            <td class="px-4 py-3 space-x-2 flex items-center">
              <router-link
                :to="`/edit/${customer.id}`"
                class="inline-flex items-center text-blue-600 hover:underline"
              >
                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 20h9" />
                  <path d="M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4 12.5-12.5z" />
                </svg>
                Edit
              </router-link>
              <button
                @click="deleteCustomer(customer.id)"
                class="inline-flex items-center text-red-600 hover:underline"
              >
                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="3 6 5 6 21 6" />
                  <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h4a1 1 0 011 1v2" />
                  <line x1="10" y1="11" x2="10" y2="17" />
                  <line x1="14" y1="11" x2="14" y2="17" />
                </svg>
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Empty State -->
      <div
        v-else
        class="text-center text-gray-500 p-8 border border-dashed border-gray-300 rounded-lg"
      >
        <p class="text-lg font-medium">No customers found.</p>
        <p class="text-sm">Click <router-link to="/new" class="text-blue-600 hover:underline">here</router-link> to add one!</p>
      </div>
    </div>
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
  