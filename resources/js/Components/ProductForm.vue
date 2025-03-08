<template>
    <div>
        <h1>{{ isEdit ? "Edit Produk" : "Tambah Produk" }}</h1>
        <form @submit.prevent="submit">
            <div>
                <label>Nama Produk</label>
                <input v-model="form.name" type="text" required />
            </div>
            <div>
                <label>Deskripsi</label>
                <textarea v-model="form.description" />
            </div>
            <div>
                <label>Stok</label>
                <input
                    v-model.number="form.stock"
                    type="number"
                    min="0"
                    required
                />
            </div>
            <div>
                <label>Harga</label>
                <input
                    v-model.number="form.price"
                    type="number"
                    min="0"
                    required
                />
            </div>
            <div>
                <label>Supplier</label>
                <select v-model="form.supplier_id" required>
                    <option
                        v-for="supplier in suppliers"
                        :key="supplier.id"
                        :value="supplier.id"
                    >
                        {{ supplier.name }}
                    </option>
                </select>
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    product: Object,
    suppliers: Array,
});

const isEdit = !!props.product;
const form = useForm({
    name: props.product?.name || "",
    description: props.product?.description || "",
    stock: props.product?.stock || 0,
    price: props.product?.price || 0,
    supplier_id: props.product?.supplier_id || "",
});

const submit = () => {
    if (isEdit) {
        form.put(route("products.update", props.product.id));
    } else {
        form.post(route("products.store"));
    }
};
</script>
