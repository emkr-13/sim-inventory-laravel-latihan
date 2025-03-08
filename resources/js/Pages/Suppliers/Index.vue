<template>
    <div>
        <h1>Daftar Supplier</h1>
        <Link :href="route('suppliers.create')" class="button"
            >Tambah Supplier</Link
        >
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="supplier in suppliers" :key="supplier.id">
                    <td>{{ supplier.name }}</td>
                    <td>{{ supplier.email }}</td>
                    <td>{{ supplier.phone }}</td>
                    <td>{{ supplier.address }}</td>
                    <td>
                        <Link :href="route('suppliers.edit', supplier.id)"
                            >Edit</Link
                        >
                        <button @click="deleteSupplier(supplier.id)">
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
    suppliers: Array,
});

const deleteSupplier = (id) => {
    if (confirm("Apakah Anda yakin?")) {
        router.delete(route("suppliers.destroy", id));
    }
};
</script>
