<script setup>
import Form from "@/Components/Form.vue";
import Results from "@/Components/Results.vue";
import {ref} from "vue";

const results = ref([]);
const paginationPage = ref(1);
const loading = ref(true);
const pagination = ref({
    page: 0,
    perPage: 0,
    total: 0,
})
const getResults = (data) => {
    results.value = data.data;
    pagination.value = data.pagination;
}
const setPaginationPage = (val) => {
    paginationPage.value = val;
}
const setLoading = (val) => {
    loading.value = !!val;
}
</script>
<template>
    <Form @get-results="getResults" :pagination-page="paginationPage" @set-loading="setLoading"></Form>
    <Results :results="results"
             :pagination="pagination"
             :loading="loading"
             @set-pagination-page="setPaginationPage"></Results>
</template>
