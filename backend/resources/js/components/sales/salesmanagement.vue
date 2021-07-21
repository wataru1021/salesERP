<template>
<div class="container">
    <div class="row top">
        <div class="list-group col-md-12 col-lg-6 m-auto">
            <div class="border border-primary rounded text-center mb-4">
                <a class="list-group-item list-group-item-action" :href="reportRegistrationUrl">
                    <h1 class="text-primary mb-0">
                        本日の日報登録
                    </h1>
                </a>
            </div>
            <div class="border border-primary rounded text-center mb-3">
                <a class="list-group-item list-group-item-action" :href="checkPastResultsUrl">
                    <h1 class="text-primary mb-0">
                        過去の成績<br v-if="screenWidth <= 425">を確認する
                    </h1>
                </a>
            </div>
        </div>
        <div class="button text-center col-md-12 col-lg-12">
            <a class="btn btn-link pt-0" :href="topPageUrl">
                <span class="text-primary">
                    TOPに戻る
                </span>
            </a>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            screenWidth: screen.width
        };
    },
    props: ["reportRegistrationUrl", "checkPastResultsUrl", "topPageUrl"]
};
</script>
