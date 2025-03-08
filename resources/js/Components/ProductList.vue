<template>
    <div>
        <h1>Daftar Produk</h1>
        <Link :href="route('products.create')" class="button"
            >Tambah Produk</Link
        >
        <Link :href="route('products.trashed')" class="button"
            >Lihat Sampah</Link
        >
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Supplier</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.name }}</td>
                    <td>{{ product.supplier?.name }}</td>
                    <td>{{ product.stock }}</td>
                    <td>{{ product.price }}</td>
                    <td>
                        <Link :href="route('products.edit', product.id)"
                            >Edit</Link
                        >
                        <button @click="deleteProduct(product.id)">
                            Hapus
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

defineProps({
    products: Array,
});

const deleteProduct = (id) => {
    if (confirm("Apakah Anda yakin?")) {
        router.delete(route("products.destroy", id));
    }
};
</script>
