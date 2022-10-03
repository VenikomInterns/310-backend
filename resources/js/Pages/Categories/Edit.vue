<template>
    <div class="container row">
        <div class="col-3 p-3 bg-light">
            <custom-sidebar/>
        </div>
        <div class="col-9 d-flex flex-column justify-content-center align-items-center bg-light">
            <div>
                <p class="fs-3 fw-bold text-primary">
                    Edit the name of the category
                </p>
            </div>
            <form @submit.prevent="submit">
                <label for="name" class="fw-bold fst-italic">
                    Name
                </label><br/>
                <input type="text" name="name" id="name" v-model="form.name">
                <button type="submit" class="btn bg-primary text-white rounded-3 ms-3">
                    Submit
                </button>
                <a onclick="history.back();return false;" class="btn btn-secondary text-white rounded-3 ms-3">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</template>

<script>
import CustomSidebar from "../../Components/CustomSidebar.vue";
export default {
    name: "Edit",
    components: {CustomSidebar},
    props: {
        category: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.category.name,
            })
        }
    },
    methods: {
        submit() {
            this.$inertia.put(route('categories.update', this.category), this.form);
        }
    }
}
</script>

<style scoped>

</style>
