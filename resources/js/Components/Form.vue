<script setup>
import {onMounted, ref, watch} from "vue"

const emit = defineEmits(["getResults"]);
const rageFilters = ref({});
const maxPrice = ref(0);
const form = ref({
    bedrooms: '',
    bathrooms: '',
    storeys: '',
    garages: '',
    name: '',
    price: [0, 1000],
    page: 1,
});
const props = defineProps({
    paginationPage: Number
});
watch(
    () => props.paginationPage,
    (val) => {
        form.value.page = val;
    }
)
watch(
    () => form.value,
    (newValue, oldValue) => {
        submit();
    },
    {deep: true}
);
onMounted(() => {
    if (window.data) {
        if (window.data.rangeFilters) {
            rageFilters.value = window.data.rangeFilters;
        }
        if (window.data.maxPrice) {
            maxPrice.value = window.data.maxPrice;
            form.price = [0, maxPrice];
        }
    }
});
const submit = () => {
    axios.post('/search', form.value).then((response) => {
        if (response.data.data) {
            getResults(response.data);
        }
    });
}
const getResults = (items) => {
    emit('getResults', items);
}
const formatRangeValue = (val) => {
    return new Intl.NumberFormat("en-IN", {maximumSignificantDigits: 3}).format(parseInt(val) * 100);
}
</script>
<template>
    <el-form :model="form" label-width="auto" style="max-width: 600px">
        <el-form-item label="Price">
            <el-slider v-model="form.price" range show-stops :max="maxPrice" :format-tooltip="formatRangeValue"/>
        </el-form-item>
        <el-form-item label="Name">
            <el-input v-model="form.name"/>
        </el-form-item>
        <template v-for="(values, name) in rageFilters">
            <el-form-item label="Activity zone">
                <el-select v-model="form[name]" placeholder="please select">
                    <el-option label="---" value=""/>
                    <el-option v-for="value in values" :label="value" :value="value"/>
                </el-select>
            </el-form-item>
        </template>
    </el-form>
</template>
