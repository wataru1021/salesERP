<template>
    <div class="container">
    <div class="list-group">
        <div class="border border-primary rounded text-center">
            <a class="list-group-item list-group-item-action" :href="salesManagementUrl">
                <h2 class="text-primary mb-0">
                    営業管理
                </h2>
            </a>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ["salesManagementUrl"],
};
</script>