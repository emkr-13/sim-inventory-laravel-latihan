<template>
    <div class="p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>
       
        <!-- Tombol Aksi -->
        <div class="mb-4 space-x-2">
            <button
                @click="openModal"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
            >
                Tambah Produk
            </button>
            <Link
                :href="route('products.trashed')"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
            >
                Lihat Sampah
            </Link>
        </div>

        <!-- Modal -->
        <div
            v-if="isModalOpen"
            class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50"
        >
            <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">Tambah Produk</h2>

                <!-- Form -->
                <form @submit.prevent="submitForm">
                    <div class="mb-4">
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700"
                            >Nama Produk</label
                        >
                        <input
                            type="text"
                            id="name"
                            v-model="form.name"
                            required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        />
                    </div>

                    <div class="mb-4">
                        <label
                            for="description"
                            class="block text-sm font-medium text-gray-700"
                            >Deskripsi</label
                        >
                        <textarea
                            id="description"
                            v-model="form.description"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        ></textarea>
                    </div>

                    <div class="mb-4">
                        <label
                            for="stock"
                            class="block text-sm font-medium text-gray-700"
                            >Stok</label
                        >
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
                        <label
                            for="price"
                            class="block text-sm font-medium text-gray-700"
                            >Harga</label
                        >
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
                        <label
                            for="supplier_id"
                            class="block text-sm font-medium text-gray-700"
                            >Supplier</label
                        >
                        <select
                            id="supplier_id"
                            v-model="form.supplier_id"
                            required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="" disabled>Pilih Supplier</option>
                            <option
                                v-for="supplier in suppliers"
                                :key="supplier.id"
                                :value="supplier.id"
                            >
                                {{ supplier.name }}
                            </option>
                        </select>
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

        <!-- Tabel Produk -->
        <table class="min-w-full border-collapse block md:table">
            <thead class="block md:table-header-group">
                <tr
                    class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto md:relative"
                >
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell"
                    >
                        Nama Produk
                    </th>
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell"
                    >
                        Supplier
                    </th>
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell"
                    >
                        Stok
                    </th>
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell"
                    >
                        Harga
                    </th>
                    <th
                        class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell"
                    >
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="block md:table-row-group">
                <tr
                    v-for="product in products"
                    :key="product.id"
                    class="bg-gray-300 border border-grey-500 md:border-none block md:table-row"
                >
                    <td
                        class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                    >
                        <span class="inline-block w-1/3 md:hidden font-bold"
                            >Nama Produk</span
                        >
                        {{ product.name }}
                    </td>
                    <td
                        class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                    >
                        <span class="inline-block w-1/3 md:hidden font-bold"
                            >Supplier</span
                        >
                        {{ product.supplier?.name || "Tidak ada supplier" }}
                    </td>
                    <td
                        class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                    >
                        <span class="inline-block w-1/3 md:hidden font-bold"
                            >Stok</span
                        >
                        {{ product.stock }}
                    </td>
                    <td
                        class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                    >
                        <span class="inline-block w-1/3 md:hidden font-bold"
                            >Harga</span
                        >
                        Rp {{ product.price.toLocaleString() }}
                    </td>
                    <td
                        class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                    >
                        <span class="inline-block w-1/3 md:hidden font-bold"
                            >Aksi</span
                        >
                        <Link
                            :href="route('products.edit', product.id)"
                            class="text-blue-500 hover:underline mr-2"
                        >
                            Edit
                        </Link>
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
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

defineProps({
    products: Array,
    suppliers: Array,
});

const isModalOpen = ref(false);

// Data form
const form = ref({
    name: "",
    description: "",
    stock: 0,
    price: 0,
    supplier_id: "",
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
        name: "",
        description: "",
        stock: 0,
        price: 0,
        supplier_id: "",
    };
};

// Submit form
const submitForm = () => {
    router.post("/products", form.value, {
        onSuccess: () => {
            closeModal();
        },
    });
};

// Hapus produk
const deleteProduct = (id) => {
    if (confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
        router.delete(route("products.destroy", id));
    }
};
</script>
