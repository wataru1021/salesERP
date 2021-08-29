<template>
<div class="container">
    <div class="row top">
        <div class="list-group col-md-12 col-lg-6 m-auto">
            <div class="border btn border-primary rounded text-center btn-custom mb-4">
                <a class="list-group-item list-group-item-action" :href="salesManagementUrl">
                    <h1 class="custom-color mb-0">
                        営業管理
                    </h1>
                </a>
            </div>
            <div class="border btn border-primary rounded text-center btn-custom mb-4">
                <a class="list-group-item list-group-item-action" :href="addAppointmentUrl">
                    <h1 class="custom-color mb-0">
                        予定を追加する
                    </h1>
                </a>
            </div>
            <div class="border btn border-primary rounded text-center btn-custom ">
                <a class="list-group-item list-group-item-action" :href="appointmentsUrl">
                    <h1 class="custom-color mb-0">
                        アポイント管理
                    </h1>
                </a>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ["salesManagementUrl", "appointmentsUrl", "addAppointmentUrl"],
};
</script>
