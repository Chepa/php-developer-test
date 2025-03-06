<script setup>
import Form from "@/Components/Form.vue";
import Results from "@/Components/Results.vue";
import {ref} from "vue";

const results = ref([]);
const paginationPage = ref(1);
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
</script>
<template>
    <Form @get-results="getResults" :pagination-page="paginationPage"></Form>
    <Results v-if="results.length" :results="results" :pagination="pagination"
             @set-pagination-page="setPaginationPage"></Results>
</template>
