<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

// Props untuk menerima data dari backend
defineProps({
    productCount: Number,
    supplierCount: Number,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- Header -->
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <!-- Konten Utama -->
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Statistik -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <!-- Jumlah Produk -->
                    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900">
                                Total Produk
                            </h3>
                            <p class="mt-2 text-3xl font-bold text-indigo-600">
                                {{ productCount }}
                            </p>
                            <Link
                                :href="route('products.index')"
                                class="mt-4 inline-block text-sm text-blue-500 hover:underline"
                            >
                                Lihat Produk →
                            </Link>
                        </div>
                    </div>

                    <!-- Jumlah Supplier -->
                    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900">
                                Total Supplier
                            </h3>
                            <p class="mt-2 text-3xl font-bold text-green-600">
                                {{ supplierCount }}
                            </p>
                            <Link
                                :href="route('suppliers.index')"
                                class="mt-4 inline-block text-sm text-blue-500 hover:underline"
                            >
                                Lihat Supplier →
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
