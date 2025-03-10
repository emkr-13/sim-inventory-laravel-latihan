<template>
    <div class="p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Daftar Supplier</h1>

        <!-- Tombol Aksi -->
        <div class="mb-4 space-x-2">
            <button @click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Tambah Supplier
            </button>
        </div>

        <!-- Modal -->
        <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">Tambah Supplier</h2>

                <!-- Form -->
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

                    <!-- Tombol Aksi -->
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

        <!-- Tabel Supplier -->
        <table class="min-w-full border-collapse block md:table">
            <thead class="block md:table-header-group">
                <tr class="border border-gray-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto md:relative">
                    <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-gray-500 text-left block md:table-cell">
                        Nama
                    </th>
                    <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-gray-500 text-left block md:table-cell">
                        Email
                    </th>
                    <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-gray-500 text-left block md:table-cell">
                        No. Telepon
                    </th>
                    <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-gray-500 text-left block md:table-cell">
                        Alamat
                    </th>
                    <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-gray-500 text-left block md:table-cell">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="block md:table-row-group">
                <tr v-for="supplier in suppliers" :key="supplier.id" class="bg-gray-300 border border-gray-500 md:border-none block md:table-row">
                    <td class="p-2 md:border md:border-gray-500 text-left block md:table-cell">
                        <span class="inline-block w-1/3 md:hidden font-bold">Nama</span>
                        {{ supplier.name }}
                    </td>
                    <td class="p-2 md:border md:border-gray-500 text-left block md:table-cell">
                        <span class="inline-block w-1/3 md:hidden font-bold">Email</span>
                        {{ supplier.email }}
                    </td>
                    <td class="p-2 md:border md:border-gray-500 text-left block md:table-cell">
                        <span class="inline-block w-1/3 md:hidden font-bold">No. Telepon</span>
                        {{ supplier.phone }}
                    </td>
                    <td class="p-2 md:border md:border-gray-500 text-left block md:table-cell">
                        <span class="inline-block w-1/3 md:hidden font-bold">Alamat</span>
                        {{ supplier.address }}
                    </td>
                    <td class="p-2 md:border md:border-gray-500 text-left block md:table-cell">
                        <span class="inline-block w-1/3 md:hidden font-bold">Aksi</span>
                        <Link :href="route('suppliers.edit', supplier.id)" class="text-blue-500 hover:underline mr-2">
                            Edit
                        </Link>
                        <button @click="deleteSupplier(supplier.id)" class="text-red-500 hover:underline">
                            Hapus
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

defineProps({
    suppliers: Array,
});

// State untuk modal
const isModalOpen = ref(false);

// Data form
const form = ref({
    name: '',
    email: '',
    phone: '',
    address: '',
});

// Buka modal
const openModal = () => {
    isModalOpen.value = true;
};

// Tutup modal
const closeModal = () => {
    isModalOpen.value = false;
    resetForm();
};

// Reset form
const resetForm = () => {
    form.value = {
        name: '',
        email: '',
        phone: '',
        address: '',
    };
};

// Submit form
const submitForm = () => {
    router.post('/suppliers', form.value, {
        onSuccess: () => {
            closeModal();
        },
    });
};

// Hapus supplier
const deleteSupplier = (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus supplier ini?')) {
        router.delete(route('suppliers.destroy', id));
    }
};
</script>
