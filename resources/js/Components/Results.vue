<script setup>
import {watch, computed, onMounted, ref} from "vue";
const props = defineProps({
    results: Array,
    pagination: Object
});
const emit = defineEmits(["setPaginationPage"]);
const currentPage = computed(() => props.pagination.page);
const page = ref(1);
onMounted(() => {
    page.value = currentPage.value;
});
watch(
    page,
    (newValue, oldValue) => {
        emit('setPaginationPage', newValue);
    },
);
</script>
<template>
    <p>Results:</p>
    <el-table :data="results" style="width: 100%">
        <el-table-column prop="name" label="Name" width="180"/>
        <el-table-column prop="price" label="Price" width="180"/>
        <el-table-column prop="bedrooms" label="Bedrooms" width="180"/>
        <el-table-column prop="bathrooms" label="Bathrooms" width="180"/>
        <el-table-column prop="storeys" label="Storeys" width="180"/>
        <el-table-column prop="garages" label="Garages" width="180"/>
    </el-table>
    <el-pagination
        v-model:current-page="page"
        :page-size="pagination.perPage"
        :pager-count="pagination.total"
        layout="prev, pager, next"
        :total="pagination.total"
    />
</template>
