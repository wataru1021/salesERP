<template>
<div class="container">
    <div class="row top">
        <div class="list-group col-md-12 col-lg-6 m-auto">
            <div class="border btn border-primary rounded text-center btn-custom">
                <a class="list-group-item list-group-item-action" :href="salesManagementUrl">
                    <h1 class="text-primary mb-0">
                        営業管理
                    </h1>
                </a>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ["salesManagementUrl"],
};
</script>
