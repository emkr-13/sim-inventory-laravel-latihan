<template>
    <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Tambah Produk</h2>
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input
                        type="text"
                        id="name"
                        v-model="form.name"
                        required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea
                        id="description"
                        v-model="form.description"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    ></textarea>
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                    <input
                        type="number"
                        id="stock"
                        v-model="form.stock"
                        required
                        min="0"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input
                        type="number"
                        id="price"
                        v-model="form.price"
                        required
                        min="0"
                        step="0.01"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
                <div class="mb-4">
                    <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
                    <select
                        id="supplier_id"
                        v-model="form.supplier_id"
                        required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        <option value="" disabled>Pilih Supplier</option>
                        <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">
                            {{ supplier.name }}
                        </option>
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button
                        type="button"
                        @click="closeModal"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

defineProps({
    isModalOpen: Boolean,
    suppliers: Array,
});

const emit = defineEmits(["close"]);

const form = ref({
    name: "",
    description: "",
    stock: 0,
    price: 0,
    supplier_id: "",
});

const closeModal = () => {
    resetForm();
    emit("close");
};

const resetForm = () => {
    form.value = {
        name: "",
        description: "",
        stock: 0,
        price: 0,
        supplier_id: "",
    };
};

const submitForm = () => {
    router.post("/products", form.value, {
        onSuccess: () => {
            closeModal();
        },
    });
};
</script>
