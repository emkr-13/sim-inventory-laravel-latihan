<template>
    <AuthenticatedLayout>
        <Head title="Daftar Supplier" />

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Daftar Supplier</h2>
        </template>

        <div class="p-6 bg-white rounded shadow">
            <!-- Tombol Aksi -->
            <div class="mb-4 space-x-2">
                <button
                    @click="openModal"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                    Tambah Supplier
                </button>
            </div>

            <!-- Modal -->
            <SupplierModal :isModalOpen="isModalOpen" @close="isModalOpen = false" />

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
                            <Link
                                :href="route('suppliers.edit', supplier.id)"
                                class="text-blue-500 hover:underline mr-2"
                            >
                                Edit
                            </Link>
                            <button
                                @click="deleteSupplier(supplier.id)"
                                class="text-red-500 hover:underline"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import SupplierModal from "@/Components/SupplierModal.vue";
import { ref } from "vue";

defineProps({
    suppliers: Array,
});

const isModalOpen = ref(false);

const openModal = () => {
    isModalOpen.value = true;
};

const deleteSupplier = (id) => {
    if (confirm("Apakah Anda yakin ingin menghapus supplier ini?")) {
        router.delete(route("suppliers.destroy", id));
    }
};
</script>
