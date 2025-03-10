<template>
    <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Edit Supplier</h2>
            <form @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input
                        type="text"
                        id="name"
                        v-model="form.name"
                        required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        type="email"
                        id="email"
                        v-model="form.email"
                        required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                    <input
                        type="text"
                        id="phone"
                        v-model="form.phone"
                        required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea
                        id="address"
                        v-model="form.address"
                        required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    ></textarea>
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
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";

// Define props
const props = defineProps({
    isModalOpen: Boolean,
    supplier: Object, // Data supplier yang akan diedit
});

const emit = defineEmits(["close"]);

// Form data
const form = ref({
    name: "",
    email: "",
    phone: "",
    address: "",
});

// Watch untuk memperbarui form saat data supplier berubah
watch(
    () => props.supplier, // Gunakan props.supplier secara eksplisit
    (newSupplier) => {
        if (newSupplier) {
            form.value = { ...newSupplier }; // Salin data supplier ke form
        }
    },
    { immediate: true } // Jalankan watcher segera setelah komponen dimuat
);

// Tutup modal
const closeModal = () => {
    resetForm();
    emit("close");
};

// Reset form
const resetForm = () => {
    form.value = {
        name: "",
        email: "",
        phone: "",
        address: "",
    };
};

// Submit form
const submitForm = () => {
    router.put(`/suppliers/${form.value.id}`, form.value, {
        onSuccess: () => {
            closeModal();
        },
    });
};
</script>
