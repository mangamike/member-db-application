<template>
  <div class="max-w-lg mx-auto p-8 m-10 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">
      {{ isEdit ? 'Edit DW Customer' : 'New DW Customer' }}
    </h1>

    <form @submit.prevent="saveCustomer" class="space-y-4">
      <!-- Name -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Name</label>
        <input
          v-model="customer.name"
          :class="inputClass('name')"
        />
        <p v-if="errors.name" class="text-sm text-red-600 mt-1">{{ errors.name }}</p>
      </div>

      <!-- Address 1 -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Address 1</label>
        <input
          v-model="customer.address1"
          :class="inputClass('address1')"
        />
        <p v-if="errors.address1" class="text-sm text-red-600 mt-1">{{ errors.address1 }}</p>
      </div>

      <!-- Address 2 (optional) -->
      <div>
        <label class="block text-sm font-medium text-gray-700">
          Address 2 <span class="text-gray-500 text-sm">(optional)</span>
        </label>
        <input
          v-model="customer.address2"
          :class="inputClass('address2')"
        />
      </div>

      <!-- City + State -->
      <div class="flex gap-4">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-700">City</label>
          <input
            v-model="customer.city"
            :class="inputClass('city')"
          />
          <p v-if="errors.city" class="text-sm text-red-600 mt-1">{{ errors.city }}</p>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-700">State</label>
          <input
            v-model="customer.state"
            :class="inputClass('state')"
          />
          <p v-if="errors.state" class="text-sm text-red-600 mt-1">{{ errors.state }}</p>
        </div>
      </div>

      <!-- Zip + Phone -->
      <div class="flex gap-4">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-700">Zip</label>
          <input
            v-model="customer.zip"
            :class="inputClass('zip')"
          />
          <p v-if="errors.zip" class="text-sm text-red-600 mt-1">{{ errors.zip }}</p>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-700">Phone</label>
          <input
            v-model="customer.phone"
            :class="inputClass('phone')"
          />
          <p v-if="errors.phone" class="text-sm text-red-600 mt-1">{{ errors.phone }}</p>
        </div>
      </div>

      <!-- Email -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input
          type="email"
          v-model="customer.email"
          :class="inputClass('email')"
        />
        <p v-if="errors.email" class="text-sm text-red-600 mt-1">{{ errors.email }}</p>
      </div>

      <!-- Business Type -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Business Type</label>
        <select
          v-model="customer.business_type"
          :class="inputClass('business_type')"
        >
          <option class="text-gray-700">Corporation</option>
          <option class="text-gray-700">LLC</option>
          <option class="text-gray-700">Sole Proprietor</option>
          <option class="text-gray-700">Other</option>
        </select>
      </div>

      <!-- Preferred Days -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Preferred Days</label>
        <div class="flex flex-wrap gap-4">
          <label
            v-for="d in days"
            :key="d"
            class="inline-flex items-center space-x-2"
          >
            <input
              type="checkbox"
              :value="d"
              v-model="customer.preferred_days"
              class="rounded border-gray-300 text-blue-600 bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500"
            />
            <span class="text-gray-700">{{ d }}</span>
          </label>
        </div>
      </div>

      <!-- Submit -->
      <div class="pt-4 flex justify-end">
        <button
          type="submit"
          class="bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-blue-700 transition"
        >
          Save
        </button>
      </div>
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

const errors = ref({});

const inputClass = (field) => {
  return [
    'mt-1 w-full px-3 py-2 border rounded-md shadow-sm text-gray-700 bg-white focus:ring-blue-500 focus:border-blue-500',
    errors.value[field]
      ? 'border-red-500 focus:ring-red-500 focus:border-red-500'
      : 'border-gray-300',
  ].join(' ');
};

onMounted(async () => {
  if (isEdit) {
    const { data } = await axios.get(`/api/customers/${route.params.id}`);
    customer.value = data;
  }
});

const saveCustomer = async () => {
  errors.value = {}; // Reset errors

  if (!customer.value.name) errors.value.name = 'Name is required.';
  if (!customer.value.address1) errors.value.address1 = 'Address 1 is required.';
  if (!customer.value.city) errors.value.city = 'City is required.';
  if (!customer.value.state) errors.value.state = 'State is required.';
  if (!customer.value.zip) errors.value.zip = 'Zip is required.';
  if (!customer.value.phone) {
    errors.value.phone = 'Phone is required.';
  } else if (!validPhone(customer.value.phone)) {
    errors.value.phone = 'Phone must be 10 digits.';
  }
  if (!customer.value.email) {
    errors.value.email = 'Email is required.';
  } else if (!validEmail(customer.value.email)) {
    errors.value.email = 'Invalid email address.';
  }

  if (Object.keys(errors.value).length > 0) {
    return; // stop submission
  }

  if (isEdit) {
    await axios.put(`/api/customers/${route.params.id}`, customer.value);
  } else {
    await axios.post('/api/customers', customer.value);
  }
  router.push('/');
};

const validEmail = (email) => {
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regex.test(email);
};

const validPhone = (phone) => {
  const digitsOnly = phone.replace(/\D/g, '');
  return digitsOnly.length === 10;
};
</script>
