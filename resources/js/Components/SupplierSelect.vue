<template>
    <select
        v-model="selectedSupplier"
        @change="$emit('select', selectedSupplier)"
    >
        <option value="">Pilih Supplier</option>
        <option
            v-for="supplier in suppliers"
            :key="supplier.id"
            :value="supplier.id"
        >
            {{ supplier.name }} - {{ supplier.phone }}
        </option>
    </select>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const suppliers = ref([]);
const selectedSupplier = ref("");

onMounted(async () => {
    const response = await axios.get("/api/suppliers");
    suppliers.value = response.data;
});
</script>
