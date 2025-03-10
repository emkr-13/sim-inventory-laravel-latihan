<template>
    <AuthenticatedLayout>
        <Head title="Daftar Produk" />

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Daftar Produk
            </h2>
        </template>

        <div class="p-6 bg-white rounded shadow">
            <!-- Tombol Aksi -->
            <div class="mb-4 space-x-2">
                <button
                    @click="openAddModal"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                    Tambah Produk
                </button>
            </div>

            <!-- Modal Tambah Produk -->
            <ProductModal :isModalOpen="isAddModalOpen" :suppliers="suppliers" @close="isAddModalOpen = false" />

            <!-- Modal Edit Produk -->
            <ProductEditModal
                :isModalOpen="isEditModalOpen"
                :product="selectedProduct"
                :suppliers="suppliers"
                @close="closeEditModal"
            />

            <!-- Tabel Produk -->
            <table class="min-w-full border-collapse block md:table">
                <thead class="block md:table-header-group">
                    <tr class="border border-gray-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto md:relative">
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-gray-500 text-left block md:table-cell">
                            Nama Produk
                        </th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-gray-500 text-left block md:table-cell">
                            Supplier
                        </th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-gray-500 text-left block md:table-cell">
                            Stok
                        </th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-gray-500 text-left block md:table-cell">
                            Harga
                        </th>
                        <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-gray-500 text-left block md:table-cell">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="block md:table-row-group">
                    <tr v-for="product in products" :key="product.id" class="bg-gray-300 border border-gray-500 md:border-none block md:table-row">
                        <td class="p-2 md:border md:border-gray-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Nama Produk</span>
                            {{ product.name }}
                        </td>
                        <td class="p-2 md:border md:border-gray-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Supplier</span>
                            {{ product.supplier?.name || "Tidak ada supplier" }}
                        </td>
                        <td class="p-2 md:border md:border-gray-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Stok</span>
                            {{ product.stock }}
                        </td>
                        <td class="p-2 md:border md:border-gray-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Harga</span>
                            Rp {{ product.price.toLocaleString() }}
                        </td>
                        <td class="p-2 md:border md:border-gray-500 text-left block md:table-cell">
                            <span class="inline-block w-1/3 md:hidden font-bold">Aksi</span>
                            <button
                                @click="openEditModal(product)"
                                class="text-blue-500 hover:underline mr-2"
                            >
                                Edit
                            </button>
                            <button
                                @click="deleteProduct(product.id)"
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
import ProductModal from "@/Components/ProductModal.vue";
import ProductEditModal from "@/Components/ProductEditModal.vue";
import { ref } from "vue";

defineProps({
    products: Array,
    suppliers: Array,
});

const isAddModalOpen = ref(false);
const isEditModalOpen = ref(false);
const selectedProduct = ref(null);

const openAddModal = () => {
    isAddModalOpen.value = true;
};

const openEditModal = (product) => {
    selectedProduct.value = product; // Set produk yang dipilih
    isEditModalOpen.value = true;
};

const closeEditModal = () => {
    selectedProduct.value = null; // Reset produk yang dipilih
    isEditModalOpen.value = false;
};

const deleteProduct = (id) => {
    if (confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
        router.delete(route("products.destroy", id));
    }
};
</script>
