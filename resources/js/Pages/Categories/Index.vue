<template>
    <div class="container row">
        <div class="col-3 p-3 bg-light">
            <custom-sidebar/>
        </div>
        <div class="col-9 pt-5">
            <div>
                <h1 class="fs-2 fw-bold bg-light p-4">
                    Add new category
                    <span>
                        <Link :href="route('categories.create')"
                              class="btn bg-primary text-white ms-3 fw-bold">
                            Add
                        </Link>
                    </span>
                </h1>
            </div>
            <div class="row py-2 bg-light m-3" v-for="category in categories">
                <div class="col-8">
                    <p class="fs-4 text-primary">
                        {{category.name}}
                    </p>
                </div>
                <div class="col-4 d-flex align-items-center justify-content-end">
                    <div class="">
                        <Link :href="route('categories.edit', category.id)"
                              class="btn bg-primary text-white me-3">
                            Edit
                        </Link>
                        <Link :href="route('categories.destroy', category.id)" method="DELETE"
                              class="btn bg-secondary text-white">
                            Delete
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CustomSidebar from "../../Components/CustomSidebar.vue";
export default {
    name: "Index",
    components: {CustomSidebar},
    props: {
        categories: Array,
    }
}
</script>

<style scoped>

</style>
